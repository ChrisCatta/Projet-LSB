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
      <div class="col-xs-3">
      

    <?php
   include('../scripts/connexionDB.php');
    $retour=connexion();
    //$c=$retour[0];
   $link=$retour[0];
  
    include('../modeles/bar_menu.php'); 
    bar_tarif();
    echo ' </div> ';
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
   
    echo '<div class="col-xs-9">';

     $sqlquery="insert into TARIF (TARIF) values ( '$_TARIF')";
     $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur d\'enregistrement 1','<p> <img src="../images/ERREUR.gif"><strong>Echec de l\'enregistrement</strong></p>'));
     panel('panel-success','Ajout réussi','<p> <img src="../images/ok.PNG">La quantité  a été ajouté correctement.</p>');
     
 
   echo '</div>';
     
   
      
    ?> 



</div>
 </td>

  </tr>

  

</table>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>