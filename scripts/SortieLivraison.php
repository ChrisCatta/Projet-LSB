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
    bar_sortie(3);
    echo ' </div> 

    <div class="col-xs-10 well3">';
  
   $sqlquery="SELECT L.ID_LIV, L.LIV_REF, L.DATE_LIV, C.ID_CO, CO.REF_CO, CL.ID_C, CL.RAISSO_C, SUM( C.QTE_CO * A.PRIX_U ) AS THT,  SUM( C.QTE_CO * A.PRIX_U )*(1+0.20) as 'TTC'
         FROM LIVRAISON L, COMMANDE CO, CONTENIR_CO C, ARTICLE A, CLIENT CL
         WHERE L.ID_CO = CO.ID_CO
AND CO.ID_C = CL.ID_C
AND CO.ID_CO = C.ID_CO
AND C.ID_A = A.ID_A
GROUP BY L.ID_LIV, L.LIV_REF, L.DATE_LIV, C.ID_CO, CO.REF_CO, CL.ID_C, CL.RAISSO_C";
   $result=mysqli_query($link,$sqlquery);
   panel_tab('panel-info',' <img src="../images/Sortielivraison.JPG" width="100" heigth="100" class="img-circle">&nbsp;&nbsp;&nbsp;&nbsp;Listes des Livraisons');
   echo '
   <table class="table table-bordered table-striped table-condensed">
   <tr class="info">
      <td><form name="formajout" action="SortieAjoutLivraison.php" method="post"><input name="SortieAjoutLivraison" type="image" src="../images/ajoutSortie.gif" width="25" heigth="25" title="Ajouter une Livraison"></form></td>
      <td></td>
      <td></td>
      
      <td><strong>Identifiant</strong></td>
      <td><strong>Livraison</strong></td>
      <td><strong>Date</strong></td>
      <td><strong>Commande</strong></td>
      <td><strong>CLient</strong></td>
      <td><strong>T.H.T</strong></td>
      <td><strong>T.T.C</strong></td>
   </tr>';
   
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    
    echo '
       <tr>
            <td><form name="AfficheDetail" action="SortieDetailLivraison.php" method="post"><input name="SortieDetailLivraison" type="image" src="../images/loupe.PNG" width="25" heigth="25" value="'.$row['ID_LIV'].'" title="Détail Livraison"></form></td>

           <td><form name="formsupprimer" action="SortieSupprimerLivraison.php" method="post"><input name="SortieSupprimerLivraison" type="image" src="../images/Sortiesup.PNG" width="25" heigth="25" value="'.$row['ID_LIV'].'" title="Supprimer cette Livraison"></form></td>
           
            <td><form name="formpdf" action="SortiePdf.php" method="post" target="_blank"><input name="pdfcommande" type="image" src="../images/pdf.PNG" width="25" heigth="25" value="'.$row['ID_LIV'].'" title="Afficher Le Bon de Livraison"></form></td>

          <td>'.$row['ID_LIV'].'</td>
           <td>'.$row['LIV_REF'].'</td>
           <td>'.$row['DATE_LIV'].'</td>
           <td>'.$row['ID_CO'].' - '.$row['REF_CO'].'</td>
           <td>'.$row['ID_C'].' '.$row['RAISSO_C'].'</td>
           <td>'.$row['THT'].'</td>
           <td>'.$row['TTC'].'</td>
       </tr>
    ';
   }
   echo'</table>
   
 
    <!--Div de la fonction panel_tab-->
    </div>
    </div>
    </div>';
     
     
   
      
   
    ?> 




 </td>

  </tr>

 
</table>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>