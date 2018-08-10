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
    bar_client(2);
    echo ' </div> ';
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
    
    echo '<div class="col-xs-9 well3">';
    $sqlquery="insert into CLIENT (RAISSO_C, ADRESSE_C, ADRESSE1_C, TEL_C, NIF, STAT, EMAIL) values ('$_RAISSO_C', '$_ADRESSE_C', '$_ADRESSE1_C', '$_TEL_C', '$_NIF',  '$_STAT', '$_EMAIL')";
    
    $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur d\'enregistrement','<p> <img src="../images/ERREUR.gif"><strong>Echec de l\'enregistrement</strong></p>'));
   
   panel('panel-success','Enregistrement réussi','<p> <img src="../images/ok.PNG">Le Client <strong>'.$_RAISSO_C.'</strong>  a été enregistré correctement.</p>');
   echo '</div>';
     
   
      
    ?> 



</div>
 </td>

  </tr>

  

</table>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>