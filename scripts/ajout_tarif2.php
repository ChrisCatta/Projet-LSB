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
    bar_tarif();
    ?> 
    </div> 
    <div class="col-xs-8">
 <?php
   foreach($_POST as $key => $value)
     {
    $varname="_".$key;
    $$varname=$value;
   }
    
    $sqlquery="insert into TARIFS (TARIF,MONTANTHT,TVA) values ( '$_TARIF','$_MONTANTHT','$_TVA')";
     $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur d\'enregistrement 1','<p> <img src="../images/ERREUR.gif"><strong>Echec de l\'enregistrement</strong></p>'));
     panel('panel-success','Ajout réussi','<p> <img src="../images/ok.PNG">La quantité  a été ajouté correctement.</p>');
     ?>
    </div>
     
</div>
 </td>

  </tr>

  

</table>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>