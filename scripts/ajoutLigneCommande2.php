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
    bar_entree(2);
    echo ' </div> ';
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
   
    echo '<div class="col-xs-8">';
  if($_NEW_OLD==1)
  {
   
     $sqlquery="insert into CONTENIR_BON values ($_ID_BONC, $_ID_A, $_QTE_BON)";
     $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur d\'enregistrement ','<p> <img src="../images/ERREUR.gif"><strong>Echec de l\'enregistrement</strong></p>'));

     panel('panel-success','Enregistrement réussi','<p> <img src="../images/ok.PNG">La Ligne de Commande a été enregistré correctement.</p>');
  }
  else
  {
     $sqlquery="update CONTENIR_BON set QTE_BON= QTE_BON + $_QTE_BON WHERE ID_A = $_ID_A AND ID_BONC=$_ID_BONC";
     $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur d\'Ajout ','<p> <img src="../images/ERREUR.gif"><strong>Echec de l\'Ajout</strong></p>'));
     panel('panel-success','Ajout réussi','<p> <img src="../images/ok.PNG">La quantité  a été ajouté correctement.</p>');
  }
   
   echo '</div>';
     
   
      
    ?> 



</div>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>