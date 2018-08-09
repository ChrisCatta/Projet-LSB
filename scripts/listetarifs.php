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
    <div class="col-xs-9 well3">
  <?php
   $sqlquery="SELECT *  FROM TARIFS  order by ID_TARIF";
   $result=mysqli_query($link,$sqlquery);
   panel_tab('panel-info','<img src="../images/google-seo-ranking2.PNG" class="img-circle" width="100" height="100">&nbsp;&nbsp;&nbsp;Listes des Tarifs');
   ?>
   
   <div class="row"> 
   <table class="info" border="1" >
   <thead>
   <tr >
      <th><form name="formajout" action="ajout_tarif1.php" method="post"><div class="plus"><input name="ajoutTarif" type="image" class="ajoute" title="Ajouter Tarif" ></div></form></th>
      <th><strong>Supp</strong></th>
      <th><strong>Id</strong></th>
      <th><strong>Tarif </strong></th>
      <th><strong>Montant</strong></th>
      <th><strong>TVA.</strong></th>
   </tr>
   </thead>
   <?php
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    ?>
    <tbody>
       <tr>
        <td><form name="formafficher" action="modification_tarif1.php" method="post"><div class="affiche"><input name="ID_TARIF" type="submit" class="ajoute" value="<?=$row['ID_TARIF']?>" title="Détail tarif"></div></form></td>
        <td><form name="formsupprimer" action="tarif_effacer.php" method="post"><div class="supprime"><input name="supprimertarif" type="submit" class="ajoute" value="<?=$row['ID_TARIF']?>" title="Supprimer Tarif"></div></form></td>
           <td><?php echo $row['ID_TARIF']?></td>
           <td><?php echo $row['TARIF']?></td>
           <td><?php echo number_format($row['MONTANTHT'],2,',',' ') ?></td>
           <td><?php echo $row['TVA']?></td>
       </tr>
       </tbody>
    <?php
   }
 ?>
</table>
   
    <!-- div de la fonction panel_tab -->
    </div>
    
   <div class="row"> 
     <div class="form-group">
       
    <form name="MAJtArt" method="POST" action="update-art.php">
        <div class="col-xs-offset-10 col-xs-2">
        <button type="submit" name="Submit" value="Valider" class=" btn btn-primary">Valider</button> 
        </div>
        </form>
    </div>
    </div>
     
<?php 
include('../modeles/pied.php'); ?>