<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>
    <div class="row">
      <div class="col-xs-3">
      

    <?php
   include('../scripts/connexionDB.php');
    $retour=connexion();
//$c=$retour[0];
$link=$retour[0];
   
    include('../modeles/bar_menu.php'); 
    bar_sortie(0);
   ?>
       </div> 
<div class="col-xs-9 well3" >
   <table class="info" border="1">
     <thead>  
         <tr class="info">
           <td></td>
    <?php 
      $type=1;
  $req0="SELECT DISTINCT EPAISSEUR AS ep FROM ARTICLE WHERE  LONGUEUR<'4.5'  AND LARGEUR>1 AND LARGEUR<200 AND ID_TYPE=1 OR ID_TYPE=4 ORDER BY EPAISSEUR" ;
  $res0 = mysqli_query($link,$req0) or exit(mysql_error());
 while( $row0=mysqli_fetch_array($res0)){
            $ep=$row0['ep'];
    echo '<td>'.$ep.'</td>';
    }
    echo '</tr>';
  $req="SELECT DISTINCT  LARGEUR as larg FROM ARTICLE WHERE  LONGUEUR<'4.5'  AND LARGEUR>1 AND LARGEUR<200 AND ID_TYPE=1 OR ID_TYPE=4 ORDER BY LARGEUR" ;
  $res = mysqli_query($link,$req) or exit(mysql_error());
  $rows = array();
       while($row=mysqli_fetch_array($res)){
          $rows[] = $row;
          //}
          //foreach($rows as $row){
            //$ep=$row['ep'];
            $larg=$row['larg'];
           /* $idtarif=$row['idtarif'];
            $req1="SELECT * FROM TARIFS WHERE ID_TARIF='$idtarif'";
            $res1 = mysqli_query($link,$req1) or exit(mysql_error());
           $row1=mysqli_fetch_array($res1);
           $tarif=$row1['MONTANTHT'];*/
           echo '<tr><td>'.$larg.'</td></tr>';
           //echo $larg.'-'.$ep.'-'.$tarif.'<br>';
           echo '<pre>';
           print_r($larg);
           echo '</pre>';
            }
    ?> 
    </table>
</div>
</div>
<?php 
include('../modeles/pied.php'); ?>