<?php
// la classe de fonctions
require('../fpdf/fpdf.php');
//require('../fpdf/invoice.php');
// connexion base de données
$id_fa= 9 ;
 // connection a phpmyadmin
   $link=mysqli_connect('localhost','root','','projet');
    if(!$link) { die('<p>Connection Impossible : '.mysql_error().'</p>');}
    //connection a la base de données
    $db=mysqli_select_db($link,'projet');
    if(!$db) { die('<p>Impossible de se connecter à la base de données : '.mysql_error().'</p>');}


// classe étendue pour créer en-tête et pied de page

$pdf = new PDF( 'P', 'mm', 'A4' );
$pdf->AddPage();

// Arial gras 14
$pdf->SetFont('Arial','B',14);
// création du pdf
$pdf->SetAuthor('Un grand écrivain');
$pdf->SetTitle('Mon joli fichier');
$pdf->SetSubject('Un exemple de création de fichier PDF');
$pdf->SetCreator('fpdf_cybermonde_org');
$pdf->AliasNBPages();

// requête
 $sqlquery="SELECT F.ID_FA, A.ID_A, A.DESIGNATION, A.FAMILLE, C.QTE_CO, A.PRIX_U, C.QTE_CO * A.PRIX_U as 'MONTANT'
              FROM COMMANDE CO, ARTICLE A, CONTENIR_CO C, FACTURE F
              WHERE F.ID_FA=$id_fa AND CO.ID_CO=F.ID_CO AND C.ID_CO=CO.ID_CO AND A.ID_A=C.ID_A ";
      $result=mysqli_query($link,$sqlquery);

   //Initialize the 3 columns and the total
$column_code = "";
$column_name = "";
$column_price = "";
$total = 0;
// on boucle  
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
{
        $id = $row["ID_A"];
        $titre = $row["QTE_CO"];
        $description = $row["DESIGNATION"];
        // titre en gras
        $pdf->SetFont('Arial','B',10);
        $pdf->Write(5,$id);
        $pdf->SetFont('Arial','B',10);
        $pdf->Write(5,$titre);
        // description
        $pdf->SetFont('Arial','',10);
        $pdf->Write(3,$description);
        $pdf->Ln();
    }
// sortie du fichier
$pdf->Output('monfichier.pdf', 'I');
?>