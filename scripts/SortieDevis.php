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
    bar_sortie(4);
    ?>
    </div> 

    <div class="col-xs-9">
  
<?php
   $sqlquery="SELECT * FROM DEVIS  ";

   panel_tab('panel-info',' <img src="../images/facture.gif" width="100" heigth="100" class="img-circle">&nbsp;&nbsp;&nbsp;&nbsp;Listes des Devis');
  ?>
   <table id="devis" class="display">
   <tr class="info">
      <td>
        <form name="formajout" action="SortieAjoutDevis.php" method="post"><input name="SortieDevis" type="image" src="../images/ajoutSortie.gif" width="25" heigth="25" title="Ajouter un devis"></form>
        </td>
      <td></td>
      <td><strong>Id</strong></td>
      <td><strong>Devis</strong></td>
      <td><strong>Date_Devis</strong></td>
      <td><strong>Client</strong></td>
      <td><strong>T.H.T</strong></td>
      <td><strong>T.T.C</strong></td>
   </tr>
   <?php
 if(  $result=mysqli_query($link,$sqlquery)){
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    $dv=$row['ID_DV'];
    $CL=$row['ID_C'];
       $sqlquery1="SELECT  CL.ID_C, CL.RAISSO_C  FROM  CLIENT CL WHERE CL.ID_C='$CL'";
          $result1=mysqli_query($link,$sqlquery1);
          $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);

       $sqlquery2="SELECT L.ID_DV, SUM(( L.QTE_DV *A.QTE)* A.PV_HT ) AS 'THT',  SUM(( (L.QTE_DV *A.QTE)* A.PV_HT )*(1+0.20) ) as 'TTC'  FROM  ARTICLE A, CONTENIR_DV L WHERE L.ID_DV='$dv' and A.ID_A=L.ID_A";
        if($result2=mysqli_query($link,$sqlquery2)){
          $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
        };
   ?>
       <tr>
            <td><form name="AfficheDetail" action="SortieDetailDevis.php" method="post"><div class="affiche"><input name="ID_DV" type="submit" class="ajoute" value="<?=$row['ID_DV']?>" title="Détail Devis"></div></form></td>
           <td><form name="formsupprimer" action="SortieSupprimerDevis.php" method="post"><div class="supprime"><input name="SortieSupprimerFacture" type="submit" class="ajoute" value="<?=$row['ID_DV']?>" title="Supprimer cette Facture"></div></form></td>

          <td><?=$row['ID_DV']?></td>
           <td><?=$row['REF_DV']?></td>
           <td><?=$row['DATE_DV']?></td>
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