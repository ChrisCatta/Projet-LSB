<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>

    <div class="row">
      <div class="col-xs-2">
      

    <?php
   include('../scripts/connexionDB.php');
    $retour=connexion();
//$c=$retour[0];
$link=$retour[0];
  
    include('../modeles/bar_menu.php'); 
    bar_sortie(3);
    echo ' </div> ';
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
  
     
   echo '<div class="col-xs-8">';
    
    $sqlquery="DELETE from contenir_bon_l where ID_LIGNE=$_ID_LIGNE";
    
    $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur de Suppression ','<p> <img src=\"../images/ERREUR.gif\"><strong>Echec de la Suppression</strong></p>'));
   
   panel('panel-success','Suppression réussite','<p> <img src="../images/ok.PNG">La Livraison  a été Supprimé correctement.</p>');
   echo '</div>';
      
   
    ?> 



</div>
 </td>

  </tr>

  

</table>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>