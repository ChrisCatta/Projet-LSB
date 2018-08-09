

<?php

include("../fpdf/fpdf.php");
////////////////////////////////////////////////// Class qui permet d'afficher un tableau en relation avec Mysql////////////////////////////////////////////////////////////////////////////////////
class PDF_MySQL_Table extends FPDF
{
var $ProcessingTable=false;
var $aCols=array();
var $TableX;
var $HeaderColor;
var $RowColors;
var $ColorIndex;

function Header()
{
    //Imprime l'en-tête du tableau si nécessaire
    if($this->ProcessingTable)
        $this->TableHeader();
}

function TableHeader()
{
    $this->SetFont('Arial','B',12);
    $this->SetX($this->TableX);
    $fill=!empty($this->HeaderColor);
    if($fill)
        $this->SetFillColor($this->HeaderColor[0],$this->HeaderColor[1],$this->HeaderColor[2]);
    foreach($this->aCols as $col)
        $this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
    $this->Ln();
}

function Row($data)
{
    $this->SetX($this->TableX);
    $ci=$this->ColorIndex;
    $fill=!empty($this->RowColors[$ci]);
    if($fill)
        $this->SetFillColor($this->RowColors[$ci][0],$this->RowColors[$ci][1],$this->RowColors[$ci][2]);
    foreach($this->aCols as $col)
        $this->Cell($col['w'],5,$data[$col['f']],1,0,$col['a'],$fill);
    $this->Ln();
    $this->ColorIndex=1-$ci;
}

function CalcWidths($width,$align)
{
    //Calcule les largeurs des colonnes
    $TableWidth=0;
    foreach($this->aCols as $i=>$col)
    {
        $w=$col['w'];
        if($w==-1)
            $w=$width/count($this->aCols);
        elseif(substr($w,-1)=='%')
            $w=$w/100*$width;
        $this->aCols[$i]['w']=$w;
        $TableWidth+=$w;
    }
    //Calcule l'abscisse du tableau
    if($align=='C')
        $this->TableX=max(($this->w-$TableWidth)/2,0);
    elseif($align=='R')
        $this->TableX=max($this->w-$this->rMargin-$TableWidth,0);
    else
        $this->TableX=$this->lMargin;
}

function AddCol($field=-1,$width=-1,$caption='',$align='L')
{
    //Ajoute une colonne au tableau
    if($field==-1)
        $field=count($this->aCols);
    $this->aCols[]=array('f'=>$field,'c'=>$caption,'w'=>$width,'a'=>$align);
}

function Table($query,$prop=array())
{
    //Exécute la requête
    $res=mysqli_query($query) or die('Erreur: '.mysql_error()."<BR>Requête: $query");
    //Ajoute toutes les colonnes si aucune n'a été définie
    if(count($this->aCols)==0)
    {
        $nb=mysql_num_fields($res);
        for($i=0;$i<$nb;$i++)
            $this->AddCol();
    }
    //Détermine les noms des colonnes si non spécifiés
    foreach($this->aCols as $i=>$col)
    {
        if($col['c']=='')
        {
            if(is_string($col['f']))
                $this->aCols[$i]['c']=ucfirst($col['f']);
            else
                $this->aCols[$i]['c']=ucfirst(mysql_field_name($res,$col['f']));
        }
    }
    //Traite les propriétés
    if(!isset($prop['width']))
        $prop['width']=0;
    if($prop['width']==0)
        $prop['width']=$this->w-$this->lMargin-$this->rMargin;
    if(!isset($prop['align']))
        $prop['align']='C';
    if(!isset($prop['padding']))
        $prop['padding']=$this->cMargin;
    $cMargin=$this->cMargin;
    $this->cMargin=$prop['padding'];
    if(!isset($prop['HeaderColor']))
        $prop['HeaderColor']=array();
    $this->HeaderColor=$prop['HeaderColor'];
    if(!isset($prop['color1']))
        $prop['color1']=array();
    if(!isset($prop['color2']))
        $prop['color2']=array();
    $this->RowColors=array($prop['color1'],$prop['color2']);
    //Calcule les largeurs des colonnes
    $this->CalcWidths($prop['width'],$prop['align']);
    //Imprime l'en-tête
    $this->TableHeader();
    //Imprime les lignes
    $this->SetFont('Arial','',11);
    $this->ColorIndex=0;
    $this->ProcessingTable=true;
    while($row=mysqli_fetch_array($res))
        $this->Row($row);
    $this->ProcessingTable=false;
    $this->cMargin=$cMargin;
    $this->aCols=array();
}



}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class PDF extends PDF_MySQL_Table
{
// En-tête
function Header()
{
    // Logo
   
    // Police Arial gras 15
    $this->SetFont('Times','B',15);
    // Décalage à droite
     $this->Image('../images/repro.PNG',10,7,190);
      //$this->Image('../images/logoFin.PNG',70,7,140);
    $this->Cell(80);
    // Titre
   // $this->Cell(30,10,'Titre',1,0,'C');
    // Saut de ligne
    $this->Ln(80);
}

// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Arial italique 8
    $this->SetFont('Times','B',8);
    // Couleur du texte en gris
    $this->SetTextColor(128);
    // Numéro de page
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}
function TitreChapitre($libelle)
{
    // Arial 12
    $this->SetFont('Times','IB',20);
    // Couleur de fond
    $this->SetFillColor(200,220,255);
    // Titre
    $this->Cell(0,12," $libelle",0,1,'L',true);
    // Saut de ligne
    $this->Ln(0);
}


function AjouterChapitre($titre)
{
   
    $this->TitreChapitre($titre);
   
}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*ob_end_clean();
$id_bonc=$_POST['pdfcommande'];
 // connection a phpmyadmin
    $link=mysql_connect('localhost','root','driss_bouchra');
    if(!$link) { die('<p>Connection Impossible : '.mysql_error().'</p>');}
    //connection a la base de données
    $db=mysql_select_db('projet',$link);
    if(!$db) { die('<p>Impossible de se connecter à la base de données : '.mysql_error().'</p>');}
$sqlquery="select B.ID_BONC, B.REFERENCE
           FROM BON_COM B
           WHERE B.ID_BONC=$id_bonc";
$result=mysqli_query($link,$sqlquery);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$PDF = new phpToPDF();
$PDF->AddPage();
$PDF->SetXY(1,2);
$PDF->SetFont("Arial","B",16);
$PDF->Text(20,10,'Bon de Commande Num :'.$row['REFERENCE'].'');
//$PDF->Text(40,10,'REFERENCE  :'.$row['REFERENCE'].'');
//$PDF->Write(10, "\nCeci est un texte multilignes \nEt voici la deuxième ligne");

$PDF->Cell(80);
//Texte centré dans une cellule 20*10 mm encadrée et retour à la ligne
//$PDF->Cell(60,20,'Titre',1,1,'C');
$PDF->Output();*/
// Instanciation de la classe dérivée
$pdf=new PDF();

$id_bonc=$_POST['pdfcommande'];
 // connection a phpmyadmin
    $link=mysql_connect('localhost','root','driss_bouchra');
    if(!$link) { die('<p>Connection Impossible : '.mysql_error().'</p>');}
    //connection a la base de données
    $db=mysql_select_db('projet',$link);
    if(!$db) { die('<p>Impossible de se connecter à la base de données : '.mysql_error().'</p>');}



$pdf->AddPage();
$sqlquery1="select B.REFERENCE, B.DATE_BONC, U.NOM, U.PRENOM, F.RAISSOCF, F.ADRESSE_F from BON_COM B, FOURNISSEUR F, UTILISATEUR U WHERE B.ID_BONC=$id_bonc and B.ID_F=F.ID_F AND B.LOGIN=U.LOGIN";
$result=mysqli_query($sqlquery1);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$pdf->AjouterChapitre(' BON DE COMMANDE                                       Le '.$row['DATE_BONC']);
$pdf->SetFont('Times','I',16); 
$pdf->Cell(102,10,'Numero    : '.$id_bonc,0,1);
$pdf->Cell(102,10,'Reference : '.$row['REFERENCE'],0,1);
$pdf->AjouterChapitre('FOURNISSEUR');
$pdf->SetFont('Times','I',12);
$pdf->Cell(102,10,'RAISON SOCIALE : '.$row['RAISSOCF'],0,1);
$pdf->Cell(103,10,'ADRESSE             : '.$row['ADRESSE_F'],0,1);
$pdf->AjouterChapitre('RESPONSABLE DE LA COMMANDE ');
$pdf->SetFont('Times','I',12);
$pdf->Cell(102,10,'NOM ET PRENOM    :  '.$row['NOM'].' '.$row['PRENOM'],0,1);
$pdf->Cell(103,10,'ADRESSE SOCIETE  :   13, rue d\' Ouihrane, Hassan RABAT',0,1);
$pdf->Cell(103,10,'Tel                :   05 37 73 41 21',0,1);
$pdf->Cell(103,10,'Fax               :   05 37 73 54 73',0,1);
$pdf->ln(10);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Premier tableau : imprime toutes les colonnes de la requête
$prop=array('HeaderColor'=>array(192,192,192),
            'color1'=>array(210,245,255),
            'color2'=>array(135,206,250),
            'padding'=>2);
$sqlquery="select distinct A.ID_A as 'IDENTIFIANT', A.DESIGNATION, C.QTE_BON as 'QUANTITE', A.PRIX_U - (A.PRIX_U* 0.2) AS 'PRIX', C.QTE_BON*(A.PRIX_U - (A.PRIX_U* 0.2)) as 'MONTANT' from ARTICLE A, CONTENIR_BON C  WHERE C.ID_BONC=$id_bonc and C.ID_A=A.ID_A";
$pdf->Table($sqlquery,$prop);

//Second tableau : définit 3 colonnes
$pdf->ln(5);
$sqlquery2="select sum(C.QTE_BON* (A.PRIX_U - (A.PRIX_U* 0.2))) as 'MONTANT HORS TAXE', sum(C.QTE_BON*(A.PRIX_U - (A.PRIX_U* 0.2)))*(1+0.20) as 'MONTANT TOUS TAXES COMPRISES' from ARTICLE A, CONTENIR_BON C  WHERE C.ID_BONC=$id_bonc and C.ID_A=A.ID_A";
$pdf->Table($sqlquery2,$prop);
$pdf->Output();

?>
