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
    bar_fournisseur(1);
    ?>
    </div> 
    <div class="col-xs-9 well3">
  <?php
   $sqlquery="select *  FROM FOURNISSEUR ";
   $result=mysqli_query($link,$sqlquery);
   panel_tab('panel-info','<img src="../images/listeFournisseur.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;Listes des Fournisseurs');
   ?>
  <table class="display" border="1" width="100%">
    <thead>
     <tr>
        <th><strong>Modif</strong></th>
        <th><strong>Supp</strong></th>
        <th><strong>Identifiant</strong></th>
        <th><strong>Raison sociale / Nom </strong></th>
        <th><strong>Adresse</strong></th>
        <th><strong>Tél.</strong></th>
        <th><strong>E-mail</strong></th>
        <th><strong>NIF</strong></th>
        <th><strong>STAT</strong></th>
        <th><strong>CIN</strong></th>
     </tr>
     </thead>
  <?php   
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    ?>
    <tbody>
       <tr>
        <td><form name="formafficher" action="modificationFour1.php" method="post"><div class="affiche"><input name="ID_F" type="submit" class="ajoute" value=<?=$row['ID_F']?>" title="Détail Fournisseur"></div></form></td>
         <td><form name="formsupprimer" action="fournisseur_effacer.php" method="post"><div class="supprime"><input name="supprimerfournisseur" type="submit" class="ajoute" value="<?=$row['ID_F']?>" title="Supprimer Fournisseur"></div></form></td>
           <td><?=$row['ID_F']?></td>
           <td><?=$row['RAISSO_F']?></td>
           <td><?=$row['ADRESSE_F']?></td>
           <td><?=$row['TEL_F']?></td>
           <td><?=$row['EMAIL_F']?></td>
           <td><?=$row['NIF_F']?></td>
           <td><?=$row['STAT_F']?></td>
           <td><?=$row['CIN']?></td>
       </tr>
       </tbody>
    <?php
   }
 ?>
 </table>
   
 
     <!-- div de la fonction panel_tab -->
    </div>
    </div>
    </div>
     
     
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>