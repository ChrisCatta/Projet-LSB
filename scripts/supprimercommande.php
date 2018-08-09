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
    bar_entree(1);
    echo ' </div> ';
    $ID_CO=$_POST['supprimercommande'];
    $sqlquery1="SELECT count(*) as 'nombre'
                from CONTENIR_CO 
                WHERE ID_CO=$ID_CO";
          $result1=mysqli_query($link,$sqlquery1);     
   $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
    echo '<div class="col-xs-9 well3">';
    $nombre=$row1['nombre'];
  if($nombre!=0)
  {
   $sqlquery3="DELETE from CONTENIR_CO WHERE ID_CO='$ID_CO'";
                   $result3=mysqli_query($link, $sqlquery3) ;
           $sqlquery="DELETE from COMMANDE WHERE ID_CO='$ID_CO'";
           $result=mysqli_query($link, $sqlquery) or die(panel('panel-danger','Erreur de Suppression ','<p> <img src="../images/erreur.png"/><strong>Echec de la Suppression</strong></p>'));
           panel('panel-success','Suppression réussite','<p> <img src="../images/ok.PNG">La Commande  a été Supprimé correctement.</p>');
          }
 else
  {
           $sqldel="DELETE from COMMANDE WHERE ID_CO='$ID_CO'";
           $res=mysqli_query($link, $sqldel) or die(panel('panel-danger','Erreur de Suppression ','<p> <img src="../images/erreur.png"/><strong>Echec de la Suppression</strong></p>'));
           panel('panel-success','Suppression réussite','<p> <img src="../images/ok.PNG">La Commande  a été Supprimé correctement.</p>');
     
  }
   
   echo '</div>';
     
   
      
    ?> 



</div>
<?php 
include('../modeles/pied.php'); ?>