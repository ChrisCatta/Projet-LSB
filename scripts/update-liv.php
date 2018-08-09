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
if (isset($_POST['Submit'])){
//print_r($_POST);
    //how many ids came through in the $_POST array?
   	$id_count = count($_POST['ID_LIGNE']);
	$LIGNES=$_POST['ID_LIGNE'];
	$QTES= $_POST['QTE_BON_L'];
    //this runs once for each id we have
    for ($i=0; $i<$id_count; $i++){
        	$sql = "UPDATE contenir_bon_l SET QTE_BON_L=$QTES[$i] WHERE ID_LIGNE=$LIGNES[$i]";
  	 $result=mysqli_query($link,$sql)  or die(panel('panel-danger','Erreur de Mise à jour ','<p> <img src="../images/ERREUR.gif"><strong>Echec de la Mise à jour</strong></p>'));
     panel('panel-success','Mise à jour  réussie','<p> <img src="../images/ok.PNG">Les lignes de livraison ont bien été mise à jour.</p>');}
        
	
}
?>