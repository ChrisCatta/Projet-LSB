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
    bar_sortie(4);
    echo ' </div> ';
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
  
     
   echo '<div class="col-xs-8">';
   $date = date("Y-m-d", strtotime($_DATE_FA." +10 days"));
   
    $sqlquery="INSERT into FACTURE (ID_CO, DATE_FA, REF_FACT, DATE_ECHE, REGLER) values ($_ID_CO, '$_DATE_FA', '$_REF_FACT', '$date', 'NON')";
    
    $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur d\'enregistrement ','<p> <img src="../images/ERREUR.gif"><strong>Echec de l\'enregistrement</strong></p>'));
   
   panel('panel-success','Enregistrement réussi','<p> <img src="../images/ok.PNG">La Facture  a été enregistré correctement.</p>');
   echo '</div>';
      
   
    ?> 



</div>
 </td>

  </tr>

  

</table>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>