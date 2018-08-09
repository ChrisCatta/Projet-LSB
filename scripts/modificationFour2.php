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
   if($c==1)
   {
    include('../modeles/bar_menu.php'); 
    bar_fournisseur(4);
    echo ' </div> ';
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }                                      
  //$sqlquery="update  UTILISATEUR  set NOM  = 'Ben' WHERE LOGIN='ANAS'";
   
    
        
    

    echo '<div class="col-xs-9">';
    $sqlquery="update  FOURNISSEUR set RAISSO_F= '$_RAISSO_F', TEL_F='$_TEL_F',CIN='$_CIN', EMAIL_F='$_EMAIL_F',NIF_F='$_NIF_F', STAT_F='$_STAT_F', ADRESSE_F='$_ADRESSE_F' WHERE ID_F='$_ID_F'";
    $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur de Modification','<p> <img src="../images/ERREUR.gif"><strong>Echec de la Modification.</strong></p>'));
    panel('panel-success','Modification réussie','<p> <img src="../images/ok.PNG">Le Fournisseur  <strong>'.$_RAISSO_F.'</strong>  a été modifié correctement.</p>');

     echo '</div>';

   }
      
   
    ?> 



</div>
<?php 
include('../modeles/pied.php'); ?>