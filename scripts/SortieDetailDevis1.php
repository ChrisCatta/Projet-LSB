  <?php 

ob_start();
?>
   <!DOCTYPE html>
        <html>
              <head>
              <meta charset="utf-8">
                <title>test Pdf</title>
                
           <link rel="stylesheet" type="text/css" href="../LSB.css">
<style>
               table.info td , table.info th{
                border: 1px solid #3a3a3a;
               }
               .facture{
                border: 1px solid #3a3a3a;
                margin-bottom: 20px;
                margin-top: 20px;
               }
               table{
            margin-bottom: 15px;
            border-collapse: collapse;
               }
            .adresse{
              border:1px solid black;
              border-radius:10px;
              width: 40%;
            }
            input {
              display: inline;
              white-space: nowrap;
              border: 1px solid #999;
            }
          input:before {
            content: attr(value);
          }
.footer {
    width: 780px;
    text-align: center;
    position: fixed;
  position: fixed; left: 0px; 
  bottom: 0px; 
  right: 0px; 
  height: 180px; 
}
.pied{
  font-size: 10px;
  color:black;
}
.pagenum:before {
    content: counter(page);
}
</style>
              </head>
        <body class="imp">
<?php
   include('../scripts/conn.php');
    $retour=connexion();
//$c=$retour[0];
$link=$retour[0];
?>
    <div class="row">
   <div class="col-xs-10">
    <?php
    if (isset($_POST['ID_DV'])){
   $ID_DV=$_POST['ID_DV'];
   $comment1=$_POST['comment1'];
   $comment2=$_POST['comment2'];
   $comment3=$_GET['comment3'];
   echo $_POST['ID_DV'];
 }
  if (isset($_GET['ID_DV'])){
   $ID_DV=$_GET['ID_DV'];
   $comment1=$_GET['comment1'];
   $comment2=$_GET['comment2'];
   $comment3=$_GET['comment3'];
 }
 $lettres=$_GET['lettres'];
 
    $sqlquery2="SELECT  L.ID_DV, sum((L.QTE_DV*A.QTE)*A.PV_HT) as 'THT', sum((L.QTE_DV*A.QTE)*A.PV_HT*(1+0.20)) as 'TTC', format(sum(A.VOL*L.QTE_DV),3,'fr_FR') as 'VOLDV'
               from CONTENIR_DV L, ARTICLE A
               where L.ID_DV='$ID_DV' AND A.ID_A=L.ID_A  ";
             $result2=mysqli_query($link,$sqlquery2);
             $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
             
   $sqlquery1="SELECT D.ID_DV, D.REF_DV,  D.ID_C, D.DATE_DV,  CL.ID_C, CL.RAISSO_C, CL.ADRESSE_C, CL.TEL_C, CL.EMAIL, DATE_FORMAT(D.DATE_DV, '%d/%m/%Y') AS date_fr
              FROM DEVIS D, CLIENT CL
              WHERE D.ID_DV='$ID_DV'  AND  CL.ID_C=D.ID_C";
   $result1=mysqli_query($link,$sqlquery1);
   $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);

             //The original date format.
          $original = $row1['DATE_DV'];
          list($year, $month, $day) = explode("-", $original);
           
          //Explode the string into an array.
          $exploded = explode("-", $original);
           
          //Reverse the order.
          $exploded = array_reverse($exploded);
           
          //Convert it back into a string.
          $newFormat = implode("/", $exploded);
?>

      <table class="display" >
        <tr>
            <td class="adresse">
                 <p><img src="../images/logo-lsb.png" width="200px" ></p>
              <div class="">   tél : +261 20 75 522 44 / 032 03 421 03<br>
                 Mail : lsb@moov.mg<br>
                  B.P. 1140 <br>301-Fianarantsoa <br>Madagascar</div>
            </td>
            <td width="60%"><p style="text-align: right; top:0px;">Fianarantsoa le : <?php echo $newFormat;?></p><br>
              <h2 style="text-align: center;"><strong>Devis</strong></h2>
            </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="60%">&nbsp;</td>
        </tr>                    
        <tr>
          <td style="text-align: left;">
           Devis N°:  <em class="ligneCommande"><?php echo $row1['REF_DV'].'/'.$year?> </em>
           </td> 
           <td  width="60%" style="text-align: right;">
           Nom client  :<em class="ligneCommande"><?=$row1['RAISSO_C']?><br><?=$row1['ADRESSE_C']?><br><?=$row1['TEL_C']?><br><?=$row1['EMAIL']?></em>
          </td>
         </tr>
       </table>
  <?php
     $req="select *  FROM UNITE ";
            $res = mysqli_query($link,$req) or exit(mysql_error());
            $rows = array();
            while($ligne=mysqli_fetch_array($res)){
              $rows[] = $ligne;
              }
              foreach($rows as $ligne){
             $unite=$ligne['UNITE'];
               
   $sqlquery="SELECT  A.UNITE, A.QTE, A.VOL, A.ID_A, A.DESIGNATION,A.LONGUEUR, A.LARGEUR, A.UNITE, A.EPAISSEUR, A.DIAMETRE, A.PV_HT, A.FAMILLE, A.TYPE,  L.ID_DV, L.ID_A, L.ID_DV_LIGNE, L.QTE_DV, (L.QTE_DV*A.QTE)*A.PV_HT as 'MONTANT'
              FROM  ARTICLE A, CONTENIR_DV L
              WHERE  L.ID_DV='$ID_DV' AND A.ID_A=L.ID_A AND A.UNITE='$unite'
              ORDER BY A.DESIGNATION ASC";
     
   $result=mysqli_query($link,$sqlquery);
   $nombre=mysqli_num_rows($result);
   if($nombre!=0)
     {
     if($unite=="M3")
       {
   ?>
                    
 <table class="info" >
       <thead>
             <tr class="info">
                <th><strong>Désignation</strong></th>
                <th><strong>Long</strong></th>
                <th><strong>Larg</strong></th>
                <th><strong>Ep</strong></th>
                <th><strong>Quantité</strong></th>
                <th><strong>M3</strong></th>
                <th><strong>Prix_Vente</strong></th>
                <th><strong>Montant</strong></th>
             </tr>
       </thead>
  <tbody>
   <?php
   $MONTANT =0;
    $VOLUME=0;
      while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
 ?>
       <tr>     
           <td> <?php echo $row['DESIGNATION']?></td>
           <td><?php echo $row['LONGUEUR']?></td>
           <td><?php echo $row['LARGEUR']?></td>
           <td><?php echo $row['EPAISSEUR']?></td>
           <td><?php echo $row['QTE_DV']?></td>
           <td style="text-align:right"> <?php echo number_format($row['QTE']*$row['QTE_DV'],3,',',' ')?></td>
           <td style="text-align:right"><?php echo $row['PV_HT']?></td>
           <td style="text-align:right"><?php echo number_format($row['MONTANT'],0,',',' ')?></td>
       </tr>
       <tr>
  <?php
  $MONTANT =$MONTANT+$row['MONTANT'];
  $VOLUME=$VOLUME+$row['QTE']*$row['QTE_DV'];
   }
  $MONTANTTTC=$MONTANT*1.2;
   
   /* $sqlquery3="SELECT  A.UNITE, sum((L.QTE_DV*A.QTE)*A.PV_HT) as 'THT', sum((L.QTE_DV*A.QTE)*A.PV_HT*(1+0.20)) as 'TTC', sum(A.VOL*L.QTE_DV) as 'VOLDV'
               from CONTENIR_DV L, ARTICLE A
               where L.ID_DV='$ID_DV' AND A.ID_A=L.ID_A AND A.UNITE='$unite'";
    if($result3=mysqli_query($link,$sqlquery3)){
    $row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
     }*/
?>
              <td colspan="5" class="success"><strong>VOLUME ET Total HT</strong></td>
              <td class="" style="text-align:right"><strong><?php echo number_format($VOLUME,2,',',' ') ?></strong></td>
              <td></td>
              <td class="" style="text-align:right"><strong><?php echo number_format($MONTANT,0,',',' ')." Ar"?></strong></td>
          </tr>
         </tbody>
      </table>
   <?php
     }
  elseif($unite=="M2")
       {
   ?>
            <table class="info" border="1" >
              <!--<tr>
                <td width="20%"><strong><?=$row['UNITE']?></strong></td>
              </tr>-->
            <thead>  
   <tr class="success">
      <th><strong>Désignation</strong></th>
      <th><strong>Long</strong></th>
      <th><strong>Larg</strong></th>
      <th><strong>Ep</strong></th>
      <th><strong>Quantité</strong></th>
      <th><strong>M2</strong></th>
      <th><strong>M3</strong></th>
      <th><strong>Prix_Vente</strong></th>
      <th><strong>Montant</strong></th>
     </tr>
     </thead>
   <?php
    $VOLUME=0;
    $SURFACE=0;
      while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
 ?>
       <tr>
           <td> <?php echo $row['DESIGNATION']?></td>
           <td><?php echo $row['LONGUEUR']?></td>
           <td><?php echo $row['LARGEUR']?></td>
           <td><?php echo $row['EPAISSEUR']?></td>
           <td><?php echo $row['QTE_DV']?></td>
           <td style="text-align:right"> <?php echo number_format($row['QTE']*$row['QTE_DV'],3,',',' ')?></td>
           <td style="text-align:right"> <?php echo number_format($row['VOL']*$row['QTE_DV'],3,',',' ')?></td>
           <td style="text-align:right"><?php echo $row['PV_HT']?></td>
           <td style="text-align:right"><?php echo number_format($row['MONTANT'],0,',',' ')?></td>
       </tr>
       <tr>
   <?php
     $VOLUME=$VOLUME+$row['VOL']*$row['QTE_DV'];
     $SURFACE=$SURFACE+$row['QTE']*$row['QTE_DV'];
       }
    $sqlquery3="SELECT  A.UNITE, sum((L.QTE_DV*A.QTE)*A.PV_HT) as 'THT', sum((L.QTE_DV*A.QTE)*A.PV_HT*(1+0.20)) as 'TTC', sum(A.VOL*L.QTE_DV) as 'VOLDV'
               from CONTENIR_DV L, ARTICLE A
               where L.ID_DV='$ID_DV' AND A.ID_A=L.ID_A AND A.UNITE='$unite'";
    if($result3=mysqli_query($link,$sqlquery3)){
    $row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
     }
     ?>
              <td colspan="5" class="success"><strong>Volume et Montant hors Taxe</strong></td>
              <td class="" style="text-align:right"><strong><?php echo number_format($SURFACE,2,',',' ')?></strong></td>
              <td class="" style="text-align:right"><strong><?php echo number_format($VOLUME,2,',',' ')?></strong></td>
              <td></td>
              <td class="" style="text-align:right"><strong><?php echo number_format($row3['THT'],0,',',' ')?></strong></td>
          </tr>
         </table>
   <?php
       }
     elseif($unite=="ML")
       {
   ?>
            <table class="info" border="1" >
              <!--<tr>
                <td width="20%"><strong><?=$row['UNITE']?></strong></td>
              </tr>-->
            <thead>  
   <tr class="success">
      <th width="200px"><strong>Désignation</strong></th>
      <th width="55px"><strong>Long</strong></th>
      <th width="55px"><strong>Diam</strong></th>
      <th width="60px"><strong>Quantité</strong></th>
      <th width="50px"><strong>ML</strong></th>
      <th width="50px"><strong>M3</strong></th>
      <th width="100px"><strong>Prix_Vente</strong></th>
      <th width="100px"><strong>Montant</strong></th>
     </tr>
     </thead>
   <?php
    $VOLUME=0;
    $QUANTITE=0;
      while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
       {
    ?>
       <tr>
           
           <td> <?php echo $row['DESIGNATION']?></td>
           <td><?php echo $row['LONGUEUR']?></td>
           <td><?php echo $row['DIAMETRE']?></td>
           <td><?php echo $row['QTE_DV']?></td>
           <td style="text-align:right"> <?php echo number_format($row['QTE']*$row['QTE_DV'],0,',',' ')?></td>
           <td style="text-align:right"> <?php echo number_format($row['VOL']*$row['QTE_DV'],3,',',' ')?></td>
           <td style="text-align:right"><?php echo $row['PV_HT']?></td>
           <td style="text-align:right"><?php echo number_format($row['MONTANT'],0,',',' ')?></td>
       </tr>
       <tr>
   <?php
     $VOLUME=$VOLUME+$row['VOL']*$row['QTE_DV'];
     $QUANTITE=$QUANTITE+$row['QTE']*$row['QTE_DV'];
       }
       
    $sqlquery3="SELECT  A.UNITE, sum((L.QTE_DV*A.QTE)*A.PV_HT) as 'THT', sum((L.QTE_DV*A.QTE)*A.PV_HT*(1+0.20)) as 'TTC', sum(A.VOL*L.QTE_DV) as 'VOLDV', sum(A.QTE*L.QTE_DV) as 'QTEDV'
               from CONTENIR_DV L, ARTICLE A
               where L.ID_DV='$ID_DV' AND A.ID_A=L.ID_A AND A.UNITE='$unite'";
    if($result3=mysqli_query($link,$sqlquery3)){
    $row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
     }
     ?>
              <td colspan="5" class="success"><strong>Volume et Montant hors Taxe</strong></td>
              <td class="" style="text-align:right"><strong><?php echo number_format($QUANTITE,0,',',' ')?></strong></td>
              <td class="" style="text-align:right"><strong><?php echo number_format($VOLUME,2,',',' ')?></strong>
              <td class="" style="text-align:right"><strong><?php echo number_format($row3['THT'],0,',',' ')?></strong></td>
          </tr>
         </table>
       <?php
          }
       }
     }
   ?>
   <table class="info" border="1" >
          <tr>
              <td colspan="8" class="success"><strong>Volume et Montant hors Taxe</strong></td>
              <td width="70px"style="text-align:right"><strong><?php echo $row2['VOLDV']?></strong></td>
              <td width="100px">&nbsp;</td>
              <td style="text-align:right"><strong><?php echo number_format($row2['THT'],0,',',' ')?></strong></td>
          </tr>
          <tr>
                <td colspan="10" class="success"><strong>Montant TVA</strong></td>
                <td style="text-align:right"><strong><?php echo number_format($row2['TTC']-$row2['THT'],0,',',' ')?></strong></td>
          </tr>
          <tr>
              <td colspan="10" class="success"><strong>Montant TTC</strong></td>
              <td style="text-align:right"><strong><?php echo number_format($row2['TTC'],0,',',' ')?></strong></td>
          </tr>
         
     </table>
       <div >Le montant du présent devis est arreté a la somme de : <h4><?=$lettres?> (<?php echo number_format($row2['TTC'],0,',',' ') ?>Ar)</h4></div>
       <div> <?=$comment1?></div> 
       <div> <?=$comment2?></div> 
       <div> <?=$comment3?></div> 
       <div width="70%" style="text-align: center; ">Signature </div>
 </div>
 </div>
 <div class="row">
  <div class="footer" >
     <h4 style="text-align: center">Les scieries du Betsileo SURL</h4>
    <p  class="pied " >Statistique : 16101 21 1998 0 00030 - 
        NIF : 2000024240 - 
        RC : 2012 B 00010 - 
        CIF : 0060660/DGI-E du 29/05/2017<br>
        Comptes banquaires :<br>
        Fianarantsoa BNI N° : 00005 00052 473 313 7 010 0 15 - 
        Antananarivo BNI N° : 00005 00001 473 313 7 010 0 04<br>
        Skype : lesscieriesdubetsileo<br>
      <a  href="http://scieries-madagascar.com/">Site internet : http://scieries-madagascar.com/</a><br>
      <a  href="https://www.facebook.com/scieries.madagascar/timeline">Facebook : https://www.facebook.com/scieries.madagascar/timeline</a><br>
    </p>
  </div>  
  </div> 
   <script type="text/javascript" src="../jquery/js/jquery-3.2.1.min.js"></script>
                 <script type="text/javascript"  src="../jquery/js/jquery-ui.js"></script>
                 <script type="text/javascript"  src="../jquery/js/jspdf.js"></script>
                 <script  type="text/javascript" src="../jquery/js/pdfFromHTML.js"></script>
                 <script type="text/javascript"  src="../DataTables/jquery.dataTables.min.js"></script>
           <script type="text/javascript" src="../bootstrap/dist/js/bootstrap.min.js"></script>
           <script type="text/javascript" src="../bootstrap/dist/js/bootstrap-select.js"></script>
                 <script type="text/javascript" src="test-ajax.js"></script>
                <script> $(document).ready(function() {
  $('.selectpicker').selectpicker();
});
</script>

</body>
</html>
<?php 

// instantiate and use the dompdf class
//put this on the bottom of the php
require_once '../dompdf/autoload.inc.php';
use Dompdf\Options;
// reference the Dompdf namespace
use Dompdf\Dompdf;

$HtmlCode= ob_get_contents();
/*file_get_contents('../SortieDetailDevis.php');*/
ob_end_clean();

/*$dompdf->loadHtml($HtmlCode);*/
// (Optional) Setup the paper size and orientation
/*$dompdf->setPaper('A4', 'Portrait');
$dompdf->render();
$output = $dompdf->output();*/
file_put_contents('devis'.$row1['ID_DV'].'.html',$HtmlCode);

$html = file_get_contents('devis'.$row1['ID_DV'].'.html');

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
// Render the HTML as PDF
echo $dompdf->output_html();
$dompdf->setPaper('A4', 'Portrait');
$dompdf->render();
/*$f;
$l;
//if(headers_sent($f,$l))
/*{
    echo $f,'<br/>',$l,'<br/>';
    die('now detect line');
}*/
// Output the generated PDF (1 = download and 0 = preview)
//$dompdf->stream("Devis N° :".$row1['ID_DV'],array("Attachment"=>0));
?>
