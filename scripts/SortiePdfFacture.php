<?php     


require('../fpdf/invoice.php');

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 // connection a phpmyadmin
   $link=mysqli_connect('localhost','root','123','projet');
    if(!$link) { die('<p>Connection Impossible : '.mysql_error().'</p>');}
    //connection a la base de données
    $db=mysqli_select_db($link,'projet');
    if(!$db) { die('<p>Impossible de se connecter à la base de données : '.mysql_error().'</p>');}
    // prendre le login 
    // 
   $ID_FA=$_POST['pdfcommande'];
    $sqlquery="SELECT F.ID_FA, A.ID_A, A.DESIGNATION, A.FAMILLE, C.QTE_CO, A.PRIX_U, C.QTE_CO * A.PRIX_U as 'MONTANT'
              FROM COMMANDE CO, ARTICLE A, CONTENIR_CO C, FACTURE F
              WHERE F.ID_FA='$ID_FA' AND CO.ID_CO=F.ID_CO AND C.ID_CO=CO.ID_CO AND A.ID_A=C.ID_A ";
      $result=mysqli_query($link,$sqlquery);

   $sqlquery2="SELECT  F.ID_FA,  sum(C.QTE_CO*A.PRIX_U) as 'THT', sum(C.QTE_CO*A.PRIX_U)*(1+0.20) as 'TTC'
               from CONTENIR_CO C, ARTICLE A, FACTURE F
               where F.ID_FA='$ID_FA' AND A.ID_A=C.ID_A";
               $result2=mysqli_query($link,$sqlquery2);
               $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
   $sqlquery1="SELECT F.ID_FA, F.REF_FACT, F.DATE_FA, F.DATE_ECHE, CL.ID_C, CL.RAISSO_C, CL.ADRESSE_C, CO.ID_C, CO.ID_CO
              FROM FACTURE F, COMMANDE CO, CLIENT CL
              WHERE F.ID_FA='$ID_FA' AND CO.ID_CO=F.ID_CO AND  CL.ID_C=CO.ID_C";
   $result1=mysqli_query($link,$sqlquery1);
   $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->addSociete( "Les Scieries du Betsileo",
                  "Zorozorono \n" .
                  "FIANARANTSOA\n"."Tel :  05 37 73 41 21\n"."Fax  :  05 37 73 54 73");
//$pdf->fact_dev( "Devis ", "TEMPO" );

$pdf->temporaire( "Facture Numero ".$id_fa );
$pdf->addDate(  $row1['DATE_FA']);
$pdf->addClient( $row1['ID_C']);
$pdf->addPageNumber("1");
$pdf->addClientAdresse( $row1['ADRESSE_C']);
$pdf->addReglement( $row1['RAISSO_C']);
$pdf->addEcheance( $row1['DATE_ECHE']);
$pdf->addNumTVA( $row1['REF_FACT']);
//$pdf->addReference("Devis ... du ....");
$cols=array( "REFERENCE"    => 23,
             "DESIGNATION"  => 75,
             "QUANTITE"     => 22,
             "PRIX U"      => 26,
             "MONTANT" => 30,
             "TVA"          => 14 );
$pdf->addCols( $cols);
$cols=array( "REFERENCE"    => "L",
             "DESIGNATION"  => "C",
             "QUANTITE"     => "C",
             "PRIX U"      => "C",
             "MONTANT" => "C",
             "TVA"          => "C" );
$pdf->addLineFormat($cols);
$pdf->addLineFormat($cols);

$y    = 109;
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
{
$line = array( "REFERENCE"    => $row['ID_A'],
               "DESIGNATION"  => $row['DESIGNATION'],
               "QUANTITE"     => $row['QTE_CO'],
               "PRIX U"      => $row['PRIX_U'],
               "MONTANT" => $row['MONTANT'],
               "TVA"          => "20%" );
$size = $pdf->addLine($y,$line);
$y   += $size + 2;
}
//$pdf->addCadreTVAs();
        
// invoice = array( "px_unit" => value,
//                  "qte"     => qte,
//                  "tva"     => code_tva );
// tab_tva = array( "1"       => 19.6,
//                  "2"       => 5.5, ... );
// params  = array( "RemiseGlobale" => [0|1],
//                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
//                      "remise"         => value,     // {montant de la remise}
//                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
//                  "FraisPort"     => [0|1],
//                      "portTTC"        => value,     // montant des frais de ports TTC
//                                                     // par defaut la TVA = 19.6 %
//                      "portHT"         => value,     // montant des frais de ports HT
//                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
//                  "AccompteExige" => [0|1],
//                      "accompte"         => value    // montant de l'acompte (TTC)
//                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
//                  "Remarque" => "texte"              // texte
/*$tot_prods = array( array ( "px_unit" => 600, "qte" => 1, "tva" => 1 ),
                    array ( "px_unit" =>  10, "qte" => 1, "tva" => 1 ));
$tab_tva = array( "1"       => 19.6,
                  "2"       => 5.5);
$params  = array( "RemiseGlobale" => 1,
                      "remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
                      "remise"         => 0,       // {montant de la remise}
                      "remise_percent" => 10,      // {pourcentage de remise sur ce montant de TVA}
                  "FraisPort"     => 1,
                      "portTTC"        => 10,      // montant des frais de ports TTC
                                                   // par defaut la TVA = 19.6 %
                      "portHT"         => 0,       // montant des frais de ports HT
                      "portTVA"        => 19.6,    // valeur de la TVA a appliquer sur le montant HT
                  "AccompteExige" => 1,
                      "accompte"         => 0,     // montant de l'acompte (TTC)
                      "accompte_percent" => 15,    // pourcentage d'acompte (TTC)
                  "Remarque" => "Avec un acompte, svp..." );

$pdf->addTVAs( $params, $tab_tva, $tot_prods);*/
//$pdf->addCadreEurosFrancs();
$prop=array('HeaderColor'=>array(255,255,255),
            'color1'=>array(255,255,255),
            'color2'=>array(255,255,255),

            'padding'=>2);
$sqlquery2="SELECT SUM( C.QTE_CO * A.PRIX_U ) AS 'Montant Hors Taxe',  SUM( C.QTE_CO * A.PRIX_U )*(1+0.20) as 'Montant tous Taxes Comprises'
         FROM FACTURE F, COMMANDE CO, CONTENIR_CO C, ARTICLE A, CLIENT CL
         WHERE F.ID_FA=$id_fa and F.ID_CO = CO.ID_CO
AND CO.ID_C = CL.ID_C
AND CO.ID_CO = C.ID_CO
AND C.ID_A = A.ID_A
GROUP BY F.ID_FA, F.REF_FACT, F.DATE_FA, F.DATE_ECHE, CO.ID_CO, CO.REF_CO, CL.ID_C, CL.RAISSO_C";
$pdf->ln(140);
/*$pdf->Table($sqlquery2,$prop);*/
$pdf->Output(Test.pdf);
?>