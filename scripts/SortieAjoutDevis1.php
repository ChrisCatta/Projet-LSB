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
    bar_sortie(1);
    echo ' </div> ';
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
  
     
   echo '<div class="col-xs-9 well3">';
     $login=$_SESSION['LOGIN'];
  
    $sqlquery="INSERT into DEVIS (REF_DV, LOGIN, ID_C, DATE_DV) values ('$_REF_DV','$login', $_ID_C, '$_DATE_DV')";
    
    $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur d\'enregistrement ','<p> <img src=\"../images/ERREUR.gif\"><strong>Echec de l\'enregistrement</strong></p>'));
   
   panel('panel-success','Enregistrement réussi','<p> <img src="../images/ok.PNG">Le devis  a été enregistré correctement.</p>');
   echo '</div>';
    ?> 
</div>
<?php 
include('../modeles/pied.php'); ?>