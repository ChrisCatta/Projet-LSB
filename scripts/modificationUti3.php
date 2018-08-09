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
    bar_administration(4);
    echo ' </div> ';
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
  //$sqlquery="update  UTILISATEUR  set NOM  = 'Ben' WHERE LOGIN='ANAS'";
    
     echo '<div class="col-xs-8">';
    $sqlquery="UPDATE  UTILISATEUR set LOGIN='$_LOGIN', NOM= '$_NOM', PRENOM='$_PRENOM', DATENAIS='$_DATENAIS', SEXE='$_SEXE', SERVICE='$_SERVICE', ADRESSE='$_ADRESSE', TEL1='$_TEL1', PW='$_PW' WHERE ID_USER='$_ID_USER'";
    $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur de Modification','<p> <img src="../images/ERREUR.gif"><strong>Echec de la Modification.</strong></p>'));
    panel('panel-success','Modification réussie','<p> <img src="../images/ok.PNG">L\'employé  <strong>'.$_PRENOM.' '.$_NOM.'</strong>  a été modifié correctement.</p>');

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