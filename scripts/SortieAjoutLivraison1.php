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
    </div-->
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
    
    $sqlquery="insert into LIVRAISON (ID_CO, DATE_LIV, LIV_REF) values ($_ID_CO, '$_DATE_LIV', '$_LIV_REF')";
    
    $result=mysqli_query($sqlquery) or die(panel('panel-danger','Erreur d\'enregistrement ','<p> <img src=\"../images/ERREUR.gif\"><strong>Echec de l\'enregistrement</strong></p>'));
   
   panel('panel-success','Enregistrement réussi','<p> <img src="../images/ok.PNG">La Livraison  a été enregistré correctement.</p>');
   echo '</div>';
      
   
    ?> 



</div>
 </td>

  </tr>

  

</table>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>