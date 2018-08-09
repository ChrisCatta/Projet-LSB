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
    bar_sortie();
    echo ' </div> 

    <div class="col-xs-9 well3 ">';
  
   $sqlquery="SELECT C.ID_CO, C.REF_CO, C.DATE_CO, CL.ID_C, CL.RAISSO_C 
              FROM COMMANDE C, CLIENT CL
              WHERE C.ID_C=CL.ID_C
              order by ID_CO ASC";
   $result=mysqli_query($link,$sqlquery);
   panel_tab('panel-info','<img src="../images/SortieAjout.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;&nbsp;Listes des Commandes');
   ?>
   <table class="well3">
   <tr class="info"> 
      <td><form name="formajout" action="SortieAjoutCommande.php" method="post"><input name="Sortieajoutcommande" type="image" src="../images/ajoutSortie.gif" width="25" heigth="25" title="Ajouter une Commande"></form></td>
      
     
      <td></td>
      <td><strong>Identifiant</strong></td>
      <td><strong>Réference</strong></td>
      <td><strong>Date_commande</strong></td>
      <td><strong>Client</strong></td>

   </tr>
   <?php
   
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    
   ?>
       <tr>
            <td><form name="formModif" action="affichecommande.php" method="post"><div class="affiche"><input class="ajoute" name="ID_CO" type="submit"  value="<?=$row['ID_CO']?>" title="Modifier une Commande"></div></form></td>
           <td><form name="formsupprimer" action="Sortiesupprimercommande.php" method="post"><div class="supprime"><input class="ajoute" name="ID_CO" type="submit"  value="<?=$row['ID_CO']?>" title="Supprimer cette Commande"></div></form></td>
           
           
           <td><?=$row['ID_CO']?></td>
           <td><?=$row['REF_CO']?></td>
           <td><?=$row['DATE_CO']?></td>
           <td><?=$row['ID_C'].' - '.$row['RAISSO_C']?></td>
           
       </tr>
    <?php
   }
   ?>
   </table>
   </div>
</div>
</div>
<?php 
include('../modeles/pied.php'); ?>