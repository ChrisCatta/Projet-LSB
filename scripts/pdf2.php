<?php
require('mysql_table.php');

class PDF extends PDF_MySQL_Table
{
function Header()
{
    //Title
    $this->SetFont('Arial','',18);
    $this->Cell(0,6,'World populations',0,1,'C');
    $this->Ln(10);
    //Ensure table header is output
    parent::Header();
}
}

    $id_fa= 9 ;
//Connect to database
$link=mysqli_connect('localhost','root','','projet');
    if(!$link) { die('<p>Connection Impossible : '.mysql_error().'</p>');}
    //connection a la base de données
    $db=mysqli_select_db($link,'projet');
    if(!$db) { die('<p>Impossible de se connecter à la base de données : '.mysql_error().'</p>');}

$pdf=new PDF();
$pdf->AddPage();
//First table: put all columns automatically
$pdf->Table("SELECT F.ID_FA, A.ID_A, A.DESIGNATION, A.FAMILLE, C.QTE_CO, A.PRIX_U, C.QTE_CO * A.PRIX_U as 'MONTANT' FROM COMMANDE CO, ARTICLE A, CONTENIR_CO C, FACTURE F
              WHERE F.ID_FA=$id_fa AND CO.ID_CO=F.ID_CO AND C.ID_CO=CO.ID_CO AND A.ID_A=C.ID_A");
$pdf->AddPage();
//Second table: specify 3 columns
$pdf->AddCol('ID_A',20,'','art');
$pdf->AddCol('DESIGNATION',40,'Designation');
$pdf->AddCol('QTE_CO',40,'Qte Com','R');
$prop=array('HeaderColor'=>array(255,150,100),
            'color1'=>array(210,245,255),
            'color2'=>array(255,255,210),
            'padding'=>2);
$pdf->Table("SELECT F.ID_FA, A.ID_A, A.DESIGNATION, A.FAMILLE, C.QTE_CO, A.PRIX_U, C.QTE_CO * A.PRIX_U as 'MONTANT'
              FROM COMMANDE CO, ARTICLE A, CONTENIR_CO C, FACTURE F
              WHERE F.ID_FA=$id_fa AND CO.ID_CO=F.ID_CO AND C.ID_CO=CO.ID_CO AND A.ID_A=C.ID_A",$prop);
$pdf->Output();
?>