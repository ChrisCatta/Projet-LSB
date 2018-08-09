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
   if($c==1)
   {
    include('../modeles/bar_menu.php'); 
    bar_administration(2);
    echo ' </div> ';
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
   echo '<div class="col-xs-8">';
     $sqlquery="INSERT into UTILISATEUR (LOGIN, NOM, PRENOM, DATENAIS, SEXE, SERVICE, ADRESSE, TEL1, PW) values ('$_LOGIN', '$_NOM', '$_PRENOM', '$_DATENAIS', '$_SEXE', '$_SERVICE', '$_ADRESSE', '$_TEL1', '$_PW')";
    
     $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur d\'enregistrement','<p> <img src="../images/ERREUR.gif"><strong>Echec de l\'enregistrement</strong></p>'));
   
   panel('panel-success','Enregistrement réussi','<p> <img src="../images/ok.PNG"> L\'employé  <strong>'.$_PRENOM.' '.$_NOM.'</strong>  a été enregistré correctement.</p>');
   echo '</div>';
   }
      
   
    ?> 



</div>
 </td>

  </tr>

  

</table>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>