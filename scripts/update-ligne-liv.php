 <?php 
session_start();
 include('../modeles/enteteAdmin.php'); ?>
    <div class="row well3">
      <div class="col-xs-3">
      

    <?php
   include('../scripts/connexionDB.php');
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
  
    include('../modeles/bar_menu.php'); 
    bar_entree();
    ?>
     </div> 
   <div class="col-xs-9 well3">
   <?php
	$LIGNES=$_POST['ID_LIGNE'];
	$QTES= $_POST['AJOUT_QTE'];
  echo $LIGNES;
  echo $QTES;
        	$sql = "UPDATE contenir_bon_l SET QTE_BON_L='$QTES' WHERE ID_LIGNE='$LIGNES'";
  	 $result=mysqli_query($link,$sql)  or die(panel('panel-danger','Erreur de Mise à jour ','<p> <img src="../images/ERREUR.gif"><strong>Echec de la Mise à jour</strong></p>'));
     panel('panel-success','Mise à jour  réussie','<p> <img src="../images/ok.PNG">Les lignes de livraison ont bien été mise à jour.</p>');
        
?>