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
    bar_client();
    echo ' </div> ';
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }      

 
    echo '<div class="col-xs-9">';
    $sqlquery="update  CLIENT set RAISSO_C= '$_RAISSO_C', TEL_C='$_TEL_C', NIF='$_NIF', STAT='$_STAT', CIF='$_CIF', RC='$_RC', EMAIL='$_EMAIL', ADRESSE_C='$_ADRESSE_C' , ADRESSE1_C='$_ADRESSE1_C' WHERE ID_C='$_ID_C'";
    $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur de Modification','<p> <img src="../images/ERREUR.gif"><strong>Echec de la Modification.</strong></p>'));
    panel('panel-success','Modification réussie','<p> <img src="../images/ok.PNG">L\'employé  <strong>'.$_RAISSO_C.'</strong>  a été modifié correctement.</p>');

     echo '</div>';
      
  
      
   
    ?> 



</div>
<?php 
include('../modeles/pied.php'); ?>