<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>
<!--div class="row">
  <div class="col-xs-offset-2 col-xs-8">
      <h3>Système de gestion des stages</h3>
      </div>
    </div-->
    <div class="row">
      <div class="col-xs-2">
      

    <?php
   include('../scripts/connexionDB.php');
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
  
    include('../modeles/bar_menu.php'); 
    bar_entree(1);
    echo ' </div> ';
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
  
     
   echo '<div class="col-xs-8">';
     $login=$_SESSION['LOGIN'];
    $sqlquery="insert into BON_COM (REFERENCE, LOGIN, ID_F, DATE_BONC) values ('$_REFERENCE','$login', $_ID_F, '$_DATE_BONC')";
    
    $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur d\'enregistrement ','<p> <img src=\"../images/ERREUR.gif\"><strong>Echec de l\'enregistrement</strong></p>'));
   
   panel('panel-success','Enregistrement réussi','<p> <img src="../images/ok.PNG">La Commande  a été enregistré correctement.</p>');
   echo '</div>';
      
   
    ?> 



</div>
 
<?php 
include('../modeles/pied.php'); ?>