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
  ?> 
  </div> 

    <div class="col-xs-9">
  
<?php
   $sqlquery="SELECT * FROM COMMANDE ";
   panel_tab('panel-info',' <img src="../images/facture.gif" width="100" heigth="100" class="img-circle">&nbsp;&nbsp;&nbsp;&nbsp;Listes des Factures');
   ?>
   <table id="facture" class="display">
   <tr class="info">
      <td><form name="formajout" action="SortieAjoutFacture.php" method="post"><input name="SortieFacture" type="image" src="../images/ajoutSortie.gif" width="25" heigth="25" title="Ajouter une Facture"></form></td>
      <td></td>
      <td><strong>Facture</strong></td>
      <td><strong>Date_Facture</strong></td>
      <td><strong>Commande</strong></td>
      <td><strong>Client</strong></td>
      <td><strong>T.H.T</strong></td>
      <td><strong>T.T.C</strong></td>
   </tr>
   <?php
 if(  $result=mysqli_query($link,$sqlquery)){
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
      $co=$row['ID_CO'];
      $CL=$row['ID_C'];
       $sqlquery1="SELECT  ID_C, RAISSO_C  FROM  CLIENT WHERE ID_C='$CL'";
      $result1=mysqli_query($link,$sqlquery1);
      $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);

       $sqlquery2="SELECT  SUM(( L.QTE_CO*A.QTE) * A.PV_HT ) AS THT,  SUM(( L.QTE_CO*A.QTE) * A.PRIX_U )*(1+0.20) as 'TTC'  FROM  ARTICLE A, CONTENIR_CO L WHERE L.ID_CO=$co AND A.ID_A=L.ID_A";
      $result2=mysqli_query($link,$sqlquery2);
      $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
  ?>
       <tr>
            <td><form name="AfficheDetail" action="SortieDetailFacture.php" method="post"><div class="affiche"><input name="ID_FA" type="submit" class="ajoute" value="<?=$row['ID_CO']?>" title="Détail Facture"></div></form></td>
           <td><form name="formsupprimer" action="SortieSupprimerFacture.php" method="post"><div class="supprime"><input name="SortieSupprimerFacture" type="submit" class="ajoute" value="<?=$row['ID_CO']?>" title="Supprimer cette Facture"></div></form></td>
           
            <!--<td><form name="formpdf" action="SortieDetailFacture1.php" method="post" target="_blank"><div class="facture"><input name="ID_FA" type="submit" class="ajoute" value="<?=$row['ID_CO']?>" title="Afficher La Facture"></div></form></td>-->
           <td><?=$row['REF_CO']?></td>
           <td><?=$row['DATE_CO']?></td>
           <td><?=$row['ID_CO']?> - <?=$row['REF_CO']?></td>
           <td><?=$row1['ID_C']?> - <?=$row1['RAISSO_C']?></td>
           <td style="text-align:right"><?php echo number_format($row2['THT'],2,',',' ')?></td>
           <td style="text-align:right"><?php echo number_format($row2['TTC'],2,',',' ')?></td>
       </tr>
<?php
  }
   }
?>
</table>
   
 
    <!--Div de la fonction panel_tab-->
    </div>
    </div>
    </div>
<?php 
include('../modeles/pied.php'); ?>