<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>
 <table width="1350" border="0" cellpadding="100" cellspacing="10"  bgcolor="#ABAD68">
  <tr >
    <td height="350" valign="top">
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
    bar_sortie(2);
    echo ' </div> ';
    $ID_A=$_POST['supprimerLigneCommande'];
    $ID_CO=$_POST['ID_CO'];
    $sqlquery1="select count(*) as 'nombre'
                from LIVRAISON 
                WHERE ID_CO=$ID_CO";
          $result1=mysqli_query($sqlquery1);     
   $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
    echo '<div class="col-xs-8">';
    $nombre=$row1['nombre'];
  if($nombre!=0)
  {
   
     panel('panel-info','Suppression Impossible','<p> <img src="../images/info.PNG" width="100" heigth="100">La ligne de commande ne peut pas être Supprimer Elle concerne '.$nombre.' livraisons.</p><p>Vous devez supprimer ces livraisons pour supprimer cette ligne de commande');
  }
  else
  {
    
     $sqlquery="delete from CONTENIR_CO WHERE ID_CO=$ID_CO AND ID_A=$ID_A";
     $result=mysqli_query($sqlquery) or die(panel('panel-danger','Erreur de Suppression ','<p> <img src="../images/ERREUR.gif"><strong>Echec de la Suppression</strong></p>'));
     panel('panel-success','Suppression réussite','<p> <img src="../images/ok.PNG">La ligne de commande  a été Supprimé correctement.</p>');
  }
   
   echo '</div>';
     
   
      
    ?> 



</div>
 </td>

  </tr>

  

</table>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>