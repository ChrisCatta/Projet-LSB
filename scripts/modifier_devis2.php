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
    bar_sortie();
    echo ' </div> ';
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
    echo '<div class="col-xs-9">';
   
    
        $sqlquery="update  DEVIS set DATE_DV='$_DATE_DV', REF_DV='$_REF_DV' WHERE ID_CO=$_ID_DV";
     $result=mysqli_query($link,$sqlquery) or die('<p> <img src="../images/ERREUR.gif"><strong>Echec de l\'enregistrement</strong></p>');

     panel('panel-success','Enregistrement réussi','<p> <img src="../images/ok.PNG">La commande a été enregistré correctement.</p>');
    ?> 


</div>
</div>
<?php 
include('../modeles/pied.php'); ?>