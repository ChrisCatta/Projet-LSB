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
  
   $sqlquery="SELECT D.ID_DV, D.REF_DV, D.ID_C, D.DATE_DV, CL.ID_C, CL.RAISSO_C 
              FROM DEVIS D, CLIENT CL
              WHERE D.ID_C=CL.ID_C
              order by D.ID_DV ASC";
   $result=mysqli_query($link,$sqlquery) or exit(mysql_error());
   panel_tab('panel-info','<img src="../images/SortieAjout.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;&nbsp;Listes des devis');
   echo '
   <table class="display">
   <tr class="info"> 
      <td><form name="formajout" action="SortieAjoutDevis.php" method="post"><input name="Sortieajoutdevis" type="image" src="../images/ajoutSortie.gif" width="25" heigth="25" title="Ajouter un devis"></form></td>
      
     
      <td></td>
      <td><strong>Identifiant</strong></td>
      <td><strong>Réference</strong></td>
      <td><strong>Date_devis</strong></td>
      <td><strong>Client</strong></td>

   </tr>';
   
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    
    echo '
       <tr>
            <td><form name="formModif" action="affichedevis.php" method="post"><div class="affiche"><input class="ajoute" name="ID_DV" type="submit"  value="'.$row['ID_DV'].'" title="Modifier un devis"></div></form></td>
           <td><form name="formsupprimer" action="Sortiesupprimerdevis.php" method="post"><div class="supprime"><input class="ajoute" name="ID_DV" type="submit"  value="'.$row['ID_DV'].'" title="Supprimer ce devis"></div></form></td>
           
           
           <td>'.$row['ID_DV'].'</td>
           <td>'.$row['REF_DV'].'</td>
           <td>'.$row['DATE_DV'].'</td>
           <td>'.$row['ID_C'].' - '.$row['RAISSO_C'].'</td>
           
       </tr>
    ';
   }
    ?> 
</table>
   
 
    <!--Div de la fonction panel_tab-->
    </div>
    </div>
    </div>
     <?php 
include('../modeles/pied.php'); ?>