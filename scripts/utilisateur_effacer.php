<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>
    <div class="row">
      <div class="col-xs-2">
      

    <?php
   include('../scripts/connexionDB.php');
    $retour=connexion();
//$c=$retour[0];
$link=$retour[0];
   if($c==1)
   {
    include('../modeles/bar_menu.php'); 
    bar_administration(3);
    echo ' </div> ';
  if(isset($_POST['supprimerUti'])){
  $_supprimerUti=$_POST['supprimerUti'];
     echo '<div class="col-xs-8 well3">';
  
     $sqlquery="DELETE from UTILISATEUR WHERE LOGIN='$_supprimerUti'";
    $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur de Suppression','<p> <img src="../images/ERREUR.gif"><strong>Echec de la Suppression.</strong></p>'));
    panel('panel-success','Suppression réussie','<p> <img src="../images/ok.PNG">L\'employé  a été supprimer correctement.</p>');
     }
     echo '</div>';
   }
      ?> 
    </div>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>