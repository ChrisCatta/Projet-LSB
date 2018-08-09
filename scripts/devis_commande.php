 <?php 
session_start();
 include('../modeles/enteteAdmin.php'); ?>
    <div class="row ">
      <div class="col-xs-3">
      

    <?php
   include('../scripts/connexionDB.php');
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
  
    include('../modeles/bar_menu.php'); 
    bar_sortie();
    ?>
     </div> 
   <div class="col-xs-9 well3">
   <?php
if (isset($_POST['Submit'])){
	$ID_DV= $_POST['ID_DV'];
  $req="SELECT * FROM DEVIS WHERE ID_DV='$ID_DV'";
  $result=mysqli_query($link,$req)  or die();
  $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
  $req1="SELECT MAX(ID_CO) AS total FROM COMMANDE";
  $result1=mysqli_query($link,$req1)  or die();
  $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
  $nombre=$row1['total'];
  $nombre=$nombre+1;
  $date=$row['DATE_DV'];
  $ref=$row['REF_DV'];
  $cl=$row['ID_C'];
  $log=$row['LOGIN'];
  $req2="INSERT INTO COMMANDE SET ID_CO='$nombre', REF_CO='$ref', DATE_CO='$date', ID_C='$cl', LOGIN='$log'";
  $reult2=mysqli_query($link,$req2)  or die(panel('panel-danger','Erreur de Mise à jour ','<p> <img src="../images/ERREUR.gif"><strong>Echec de la Mise à jour</strong></p>'));
  
  
  $req4="SELECT MAX(ID_CO_LIGNE) AS total FROM CONTENIR_CO";
  $result4=mysqli_query($link,$req4)  or die();
  $row4=mysqli_fetch_array($result4,MYSQLI_ASSOC);
  $nombreL=$row4['total'];
  $nombreL=$nombreL+1;
  
  $req3="SELECT * FROM CONTENIR_DV WHERE ID_DV='$ID_DV'";
   $res3 = mysqli_query($link,$req3) or exit(mysql_error());
            $rows = array();
            while($row3=mysqli_fetch_array($res3)){
              $rows[] = $row3;
              }
              foreach($rows as $row3){
    
  $art=$row3['ID_A'];
  $qte=$row3['QTE_DV'];          
                
                
                
  $req4="INSERT INTO CONTENIR_CO SET ID_CO='$nombre', ID_CO_LIGNE='$nombreL', QTE_CO='$qte', ID_A='$art' ";
  $reult4=mysqli_query($link,$req4)  or die(panel('panel-danger','Erreur de Mise à jour ','<p> <img src="../images/ERREUR.gif"><strong>Echec de la Mise à jour  des lignes</strong></p>'));
  $nombreL++ ;
    }
}
//print_r($_POST);
    /*how many ids came through in the $_POST array?
   	$id_count = count($_POST['ID_DV_LIGNE']);
	$LIGNES=$_POST['ID_DV_LIGNE'];
	$QTES= $_POST['QTE_DV'];
    //this runs once for each id we have
    for ($i=0; $i<$id_count; $i++){
        	$sql = "UPDATE contenir_dv SET QTE_DV=$QTES[$i] WHERE ID_DV_LIGNE=$LIGNES[$i]";
  	 $result=mysqli_query($link,$sql)  or die(panel('panel-danger','Erreur de Mise à jour ','<p> <img src="../images/ERREUR.gif"><strong>Echec de la Mise à jour</strong></p>'));}*/
     panel('panel-success','Mise à jour  réussie','<p> <img src="../images/ok.PNG">Le devis a bien été passé en commande.</p>');
?>