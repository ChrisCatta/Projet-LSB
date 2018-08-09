  <?php 

ob_start();
?>
   <!DOCTYPE html>
        <html>
              <head>
              <meta charset="utf-8">
                <title>test Pdf</title>
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
            margin-bottom: 50px;
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
    width: 100%;
    text-align: center;
    position: fixed;
  position: fixed; left: 0px; 
  bottom: 0px; 
  right: 0px; 
  height: 80px; 
}
.pied{
  font-size: 10px;
}
.pagenum:before {
    content: counter(page);
}
</style>
              </head>
        <body>
<?php
       include('../scripts/conn.php');
          $retour=connexion();
          //$c=$retour[0];
          $link=$retour[0];  
?>
  
   <div class="col-xs-10 well3 ">
    <?php
    if (isset($_POST['ID_CO'])){
   $ID_CO=$_POST['ID_CO'];
   $comment1=$_POST['comment1'];
   $comment2=$_POST['comment2'];
 }
  if (isset($_GET['ID_CO'])){
   $ID_CO=$_GET['ID_CO'];
   $comment1=$_GET['comment1'];
   $comment2=$_GET['comment2'];
 }
 $lettres=$_GET['lettres'];

   $sqlquery="SELECT A.ID_A, A.DESIGNATION, A.FAMILLE, A.LONGUEUR, A.LARGEUR, A.EPAISSEUR, A.PV_HT,   A.QTE, A.UNITE, C.QTE_CO, C.QTE_CO * A.QTE * A.PV_HT as 'MONTANT'
              FROM COMMANDE CO, ARTICLE A, CONTENIR_CO C
              WHERE CO.ID_CO='$ID_CO' AND C.ID_CO=CO.ID_CO AND A.ID_A=C.ID_A ";
     $result=mysqli_query($link,$sqlquery);
   $sqlquery2="SELECT  CO.ID_CO,  sum(C.QTE_CO*A.QTE*A.PV_HT) as 'THT', sum(C.QTE_CO*A.QTE*A.PV_HT)*(1+0.20) as 'TTC', sum(C.QTE_CO) as TOTAL, sum(C.QTE_CO*A.QTE) as volume
               from CONTENIR_CO C, ARTICLE A, COMMANDE CO
               where Co.ID_CO='$ID_CO' AND A.ID_A=C.ID_A";
               $result2=mysqli_query($link,$sqlquery2);
               $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
   $sqlquery1="SELECT CO.ID_CO, CO.REF_CO,  CL.ID_C, CL.RAISSO_C,  CL.ADRESSE_C, CL.TEL_C, CL.EMAIL, CO.ID_C,  CO.DATE_CO
              FROM  COMMANDE CO, CLIENT CL
              WHERE CO.ID_CO='$ID_CO' AND  CL.ID_C=CO.ID_C";
   $result1=mysqli_query($link,$sqlquery1);
   $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
   //The original date format.
$original = $row1['DATE_CO'];
 
//Explode the string into an array.
$exploded = explode("-", $original);
 
//Reverse the order.
$exploded = array_reverse($exploded);
 
//Convert it back into a string.
$newFormat = implode("/", $exploded);

   ?>
                    <table class="display" width="100%">
                    <tr>
                        <td class="adresse">
                             <p><img src="../images/logo-lsb.png" width="200px" ></p>
                          <div class="pied">   tél : +261 20 75 522 44 / 032 03 421 03<br>
                             Mail : lsb@moov.mg<br>
                              B.P. 1140 <br>301-Fianarantsoa <br>Madagascar</div>
                        </td>
                        <td width="60%"><p style="text-align: right; top:0px;">Fianarantsoa le : <?php echo $newFormat;?></p><br>
                          <h2 style="text-align: center;"><strong>Facture</strong></h2>
                        </td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td width="60%">&nbsp;</td>
                    </tr>                    
                    <tr>
                      <td style="text-align: left;">
                       Facture N°:  <em class="ligneCommande"><?=$row1['ID_CO']?><br>Intitulé :<?=$row1['REF_CO']?> </em>
                       </td> 
                       <td  width="60%" style="text-align: right;">
                       Nom client  :<em class="ligneCommande"><?=$row1['RAISSO_C']?><br><?=$row1['ADRESSE_C']?><br><?=$row1['TEL_C']?><br><?=$row1['EMAIL']?></em>
                      </td>
                     </tr>
                     </table>
                    
                         <table class="info" width="100%">
                            <thead>
                               <tr class="info">
                                  <th><strong>Produits</strong></th>
                                  <th><strong>Famille</strong></th>
                                  <th><strong>Unité</strong></th>
                                  <th><strong>Qté/U</strong></th>
                                  <th><strong>Qté</strong></th>
                                  <th><strong>Qté Tot</strong></th>
                                   <th><strong>Px U</strong></th>
                                  <th><strong>Montant</strong></th>
                                </tr>
                         </thead>
                               <?php
                                $MONTANT =0;
                               while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                               {
                                 ?>
                                 <tbody>
                                   <tr>
                                       <td><?=$row['DESIGNATION']?></td>
                                       <td><?=$row['FAMILLE']?></td>
                                       <td><?=$row['UNITE']?></td>
                                       <td><?=$row['QTE']?></td>
                                       <td><?=$row['QTE_CO']?></td>
                                       <td><?=$row['QTE']*$row['QTE_CO']?></td>
                                       <td style="text-align:right"><?php echo number_format($row['PV_HT'],0,',',' ')." Ar"?></td>
                                       <td style="text-align:right"><?php echo number_format($row['MONTANT'],0,',',' ')." Ar"?></td>
                                   </tr>
                              <?php 
                              $MONTANT =$MONTANT+$row['MONTANT'];
                     }
                     $MONTANTTTC=$MONTANT*1.2;
                    ?>
          <tr>
              <td colspan="4" class="success"><strong>Total</strong></td>
              <td style="text-align:right"><strong><?php echo $row2['TOTAL']?></strong></td>
              <td style="text-align:right"><strong><?php echo $row2['volume']?></strong></td>
              <td ></td>
              <td style="text-align:right"><strong><?php echo number_format($MONTANT,0,',',' ')." Ar"?></strong></td>
          </tr>
          <tr>
                <td colspan="7" class="success"><strong>Montant TVA</strong></td>
                <td style="text-align:right"><strong><?php echo number_format($MONTANTTTC-$MONTANT,0,',',' ')." Ar"?></strong></td>
          </tr>
          <tr>
              <td colspan="7" class="success"><strong>Montant TTC</strong></td>
              <td style="text-align:right"><strong><?php echo number_format($MONTANTTTC,0,',',' ')." Ar"?></strong></td>
          </tr>
         
           </tbody>
       </table>
       <div >Le montant de la présente facture est arreté a la somme de : <h4><?=$lettres?> Ariary (<?php echo number_format($MONTANTTTC,0,',',' ')." Ar"?> )</h4></div>
       <div> <?=$comment1?></div> 
       <div> <?=$comment2?></div> 
       <div width="70%" style="text-align: center; ">Signature </div>
 </div>
  <div class=" footer" >
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
<script type="text/javascript">
 
var res, plus, diz, s, un, mil, mil2, ent, deci, centi, pl, pl2, conj;
 
var t=["","Un","Deux","Trois","Quatre","Cinq","Six","Sept","Huit","Neuf"];
var t2=["Dix","Onze","Douze","Treize","Quatorze","Quinze","Seize","Dix-sept","Dix-huit","Dix-neuf"];
var t3=["","","Vingt","Trente","Quarante","Cinquante","Soixante","Soixante","Quatre-vingt","Quatre-vingt"];
 
 
 
window.onload=calcule
 
function calcule(){
  document.getElementById("t").onmouseover=function(){
    document.getElementById("lettres").value=trans(this.value)
  }
}
 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// traitement des deux parties du nombre;
function decint(n){
 
  switch(n.length){
    case 1 : return dix(n);
    case 2 : return dix(n);
    case 3 : return cent(n.charAt(0)) + " " + decint(n.substring(1));
    default: mil=n.substring(0,n.length-3);
      if(mil.length<4){
        un= (mil==1) ? "" : decint(mil);
        return un + mille(mil)+ " " + decint(n.substring(mil.length));
      }
      else{ 
        mil2=mil.substring(0,mil.length-3);
        return decint(mil2) + million(mil2) + " " + decint(n.substring(mil2.length));
      }
  }
}
 
 
 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// traitement des nombres entre 0 et 99, pour chaque tranche de 3 chiffres;
function dix(n){
  if(n<10){
    return t[parseInt(n)]
  }
  else if(n>9 && n<20){
    return t2[n.charAt(1)]
  }
  else {
    plus= n.charAt(1)==0 && n.charAt(0)!=7 && n.charAt(0)!=9 ? "" : (n.charAt(1)==1 && n.charAt(0)<8) ? " et " : "-";
    diz= n.charAt(0)==7 || n.charAt(0)==9 ? t2[n.charAt(1)] : t[n.charAt(1)];
    s= n==80 ? "s" : "";
 
    return t3[n.charAt(0)] + s + plus + diz;
  }
}
 
 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// traitement des mots "cent", "mille" et "million"
function cent(n){
return n>1 ? t[n]+ " Cent" : (n==1) ? " Cent" : "";
}
 
function mille(n){
return n>=1 ? " Mille" : "";
}
 
function million(n){
return n>=1 ? " Millions" : " Million";
}
 
 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// conversion du nombre
function trans(n){
 
  // vérification de la valeur saisie
  if(!/^\d+[.,]?\d*$/.test(n)){
    return "L'expression entrée n'est pas un nombre."
  }
 
  // séparation entier + décimales
  n=n.replace(/(^0+)|(\.0+$)/g,"");
  n=n.replace(/([.,]\d{2})\d+/,"$1");
  n1=n.replace(/[,.]\d*/,"");
  n2= n1!=n ? n.replace(/\d*[,.]/,"") : false;
 
  // variables de mise en forme
  ent= !n1 ? "" : decint(n1);
  deci= !n2 ? "" : decint(n2);
  if(!n1 && !n2){
    return  "Entrez une valeur non nulle!"
  }
  conj= !n2 || !n1 ? "" : "  et ";
  euro= !n1 ? "" : !/[23456789]00$/.test(n1) ? " Ariary" : " ";
  centi= !n2 ? "" : " centime";
  pl=  n1>1 ? "" : "";
  pl2= n2>1 ? "s" : "";
 
  // expression complète en toutes lettres
  return (" " + ent + euro + pl + conj + deci + centi + pl2).replace(/\s+/g," ").replace("cent s E","cents E") ;
 
}
 
</script>
<?php 

// instantiate and use the dompdf class
//put this on the bottom of the php
require_once '../dompdf/autoload.inc.php';
use Dompdf\Options;
// reference the Dompdf namespace
use Dompdf\Dompdf;

$dompdf = new Dompdf();
$HtmlCode= ob_get_contents(); 
ob_end_clean();

$dompdf->loadHtml($HtmlCode);
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'Portrait');
$dompdf->render();
//$output = $dompdf->output();
//file_put_contents('facture'.$row1['ID_FA'].'.html',$HtmlCode);

//$html = file_get_contents('facture'.$row1['ID_FA'].'.html');


// Render the HTML as PDF
//echo $dompdf->output_html();
/*$dompdf->render();
$f;
$l;
//if(headers_sent($f,$l))
/*{
    echo $f,'<br/>',$l,'<br/>';
    die('now detect line');
}*/
// Output the generated PDF (1 = download and 0 = preview)
$dompdf->stream("Facture N° :".$row1['ID_CO'],array("Attachment"=>0));
?>

</body>
</html>