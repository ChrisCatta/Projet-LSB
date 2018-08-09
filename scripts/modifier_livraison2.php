<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>

<!--div class="row">
  <div class="col-xs-offset-2 col-xs-8">
      <h3>Système de gestion des stages</h3>
      </div>
    </div>-->
    <div class="row">
      <div class="col-xs-2">
      

    <?php
   include('../scripts/connexionDB.php');
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
  
    include('../modeles/bar_menu.php'); 
    bar_entree(3);
    echo ' </div> ';
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
    echo '<div class="col-xs-8">';
   
    
        $sqlquery="update  LIV_BON set DATE_BONL='$_DATE_BONL', REF_LIV='$_REF_LIV',TYPE_LIV='$_TYPE_LIV' WHERE ID_BONL=$_ID_BONL";
     $result=mysqli_query($link,$sqlquery) or die('<p> <img src="../images/ERREUR.gif"><strong>Echec de l\'enregistrement</strong></p>');

     panel('panel-success','Enregistrement réussi','<p> <img src="../images/ok.PNG">La Livraison a été enregistré correctement.</p>');
    ?> 


</div>
</div>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>