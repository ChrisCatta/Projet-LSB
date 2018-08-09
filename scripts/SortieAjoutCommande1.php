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
  
    $sqlquery="insert into COMMANDE ( REF_CO, LOGIN, ID_C, DATE_CO) values ('$_REF_CO','$login', $_ID_C, '$_DATE_CO')";
    
    $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur d\'enregistrement ','<p> <img src=\"../images/ERREUR.gif\"><strong>Echec de l\'enregistrement</strong></p>'));
   
   panel('panel-success','Enregistrement réussi','<p> <img src="../images/ok.PNG">La Commande  a été enregistré correctement.</p>');
   echo '</div>';
    ?> 
</div>
<?php 
include('../modeles/pied.php'); ?>