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
    bar_tarif();
    echo ' </div> ';
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }      

 
    echo '<div class="col-xs-9">';
    $sqlquery="update  TARIFS set  TARIF='$_Tarif', MONTANTHT='$_MONTANTHT', TVA='$_TVA' WHERE ID_TARIF='$_ID_TARIF'";
    $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur de Modification','<p> <img src="../images/ERREUR.gif"><strong>Echec de la Modification.</strong></p>'));
    panel('panel-success','Modification réussie','<p> <img src="../images/ok.PNG">Le Tarif  <strong>'.$_Tarif.'</strong>  a été modifié correctement.</p>');

     echo '</div>';
      
  
     
   
    ?> 



</div>
<?php 
include('../modeles/pied.php'); ?>