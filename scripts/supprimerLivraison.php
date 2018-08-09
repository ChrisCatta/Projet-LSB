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
    bar_entree(3);
    echo ' </div> ';
    $ID_BONL=$_POST['supprimerLivraison'];
    $sqlquery1="SELECT count(*) as 'nombre'
                from CONTENIR_BON_L 
                WHERE ID_BONL=$ID_BONL";
          $result1=mysqli_query($link,$sqlquery1);     
   $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
    echo '<div class="col-xs-9">';
    $nombre=$row1['nombre'];
  if($nombre!=0)
  {
   $sqlquery3="DELETE from CONTENIR_BON_L WHERE ID_BONL='$ID_BONL'";
                   $result3=mysqli_query($link, $sqlquery3) ;
           $sqlquery="DELETE from LIV_BON WHERE ID_BONL=$ID_BONL";
           $result=mysqli_query($link, $sqlquery) or die(panel('panel-danger','Erreur de Suppression ','<p> <img src="../images/erreur.png"/><strong>Echec de la Suppression</strong></p>'));
           panel('panel-success','Suppression réussite','<p> <img src="../images/ok.PNG">La livraison  a été Supprimée correctement.</p>');
          }
 else
  {
           $sqldel="DELETE from LIV_BON WHERE ID_BONL=$ID_BONL";
           $res=mysqli_query($link, $sqldel) or die(panel('panel-danger','Erreur de Suppression ','<p> <img src="../images/erreur.png"/><strong>Echec de la Suppression</strong></p>'));
           panel('panel-success','Suppression réussite','<p> <img src="../images/ok.PNG">La Commande  a été Supprimé correctement.</p>');
  }
   
   echo '</div>';
     
   
      
    ?> 



</div>
<?php 
include('../modeles/pied.php'); ?>