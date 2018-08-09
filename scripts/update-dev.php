 <?php 
session_start();
    include('../modeles/enteteAdmin.php');?>
    <div class="row ">
      <div class="col-xs-3">
        <?php
   include('../scripts/connexionDB.php');
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
if (isset($_POST['Submit'])){
//print_r($_POST);
    //how many ids came through in the $_POST array?
   	$id_count = count($_POST['ID_DV_LIGNE']);
	$LIGNES=$_POST['ID_DV_LIGNE'];
	$QTES= $_POST['QTE_DV'];
	$LONG= $_POST['LONGUEUR'];
      
	/*$LONG2= $_POST['TEMP'];
        $FAM=$_POST['ID_FAMILLE'];
    //this runs once for each id we have*/
    for ($i=0; $i<$id_count; $i++){
        
        $postrabot=isset($_POST['RABOT'][$i]);
        $postsec=isset($_POST['SEC']);
        if(isset($_POST['RABOT'][$i])){
        $rabot=1;
        }
        else{
            $rabot=0;
        }
        if(isset($_POST['SEC'][$i])){
        $sec=1;
        }
        else{
            $sec=0;
        }
        
        	$sql = "UPDATE contenir_dv SET QTE_DV=$QTES[$i], RABOT=$rabot, SEC=$sec WHERE ID_DV_LIGNE=$LIGNES[$i]";
          
          //}
  	 $result=mysqli_query($link,$sql)  or die(panel('panel-danger','Erreur de Mise à jour ','<p> <img src="../images/ERREUR.gif"><strong>Echec de la Mise à jour</strong></p>'));
         
        }
    include('../modeles/bar_menu.php'); 
    bar_sortie(); 
  
    ?>
     </div> 
   <div class="col-xs-9 well3">
   <?php
     panel('panel-success','Mise à jour  réussie','<p> <img src="../images/ok.PNG">Les lignes de devis ont bien été mise à jour.</p>');
}
?>
</div>
</div>