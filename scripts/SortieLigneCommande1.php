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
    bar_sortie(2);
    
    
    echo ' </div> 

    <div class="col-xs-10 well3 ">';
   $ID_CO=$_POST['ID_CO'];
   $sqlquery="SELECT A.ID_A, A.DESIGNATION, A.FAMILLE, C.QTE_CO, A.PRIX_U, C.QTE_CO * A.PRIX_U as 'MONTANT'
              FROM COMMANDE L, ARTICLE A, CONTENIR_CO C
              WHERE L.ID_CO=$ID_CO AND L.ID_CO=C.ID_CO AND C.ID_A=A.ID_A ";
     

   $sqlquery1="SELECT CO.ID_CO, CO.REF_CO,  CL.ID_C, CL.RAISSO_C
              FROM COMMANDE CO, CLIENT CL
              WHERE CO.ID_CO=$ID_CO AND CO.ID_C=CL.ID_C";
   $result1=mysqli_query($link,$sqlquery1);
   $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
   panel_tab_defaut('panel-info','<div class="row">
                                <div class="col-xs-12"> <h2 class="text-center"><strong><img src="../images/SortieAjout.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;&nbsp;Liste Des lignes de Commande</strong></h2> </div>
                              </div>
                              <div class="row">
                                <div class=" col-xs-6 ">Commande :  <em class="ligneCommande">'.$row1['ID_CO'].' - '.$row1['REF_CO'].'</em> </div>
                                <div class="col-xs-offset-2 col-xs-4">Client :  <em class="ligneCommande">'.$row1['ID_C'].' - '.$row1['RAISSO_C'].'</em> </div>

                              </div>'
                              );
   echo '
   <table class="display">
   <tr class="info">
      <td><form name="formajout" action="ligneCommande1.php" method="post"><input name="ajoutLigneCommande" onclick="chargerListeCommType(1) " type="image" src="../images/ajoutSortie.gif" width="25" heigth="25" title="Ajouter une Ligne Commande" value="'.$row1['ID_CO'].'"></form></td>
      
     
      
      <td><strong>ID_Article</strong></td>
      <td><strong>Désignation</strong></td>
      <td><strong>Famille</strong></td>
      <td><strong>Quantité</strong></td>
      <td><strong>Prix Vente</strong></td>
      <td><strong>Montant</strong></td>

   </tr>';
   
   if($result=mysqli_query($link,$sqlquery)){
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
  
   {
    
    echo '
       <tr>
           <td><form name="formsupprimer" action="SortieSupprimerLigneCommande.php" method="post"><input name="supprimerLigneCommande" type="image" src="../images/Sortiesup.PNG" width="25" heigth="25" value="'.$row['ID_A'].'" title="Supprimer cette Ligne de Commande"><input type="hidden" name="ID_CO" value="'.$row1['ID_CO'].'" ></form></td>
           
           <td>'.$row['ID_A'].'</td>
           <td>'.$row['DESIGNATION'].'</td>
           <td>'.$row['FAMILLE'].'</td>
           <td>'.$row['QTE_CO'].'</td>
           <td>'.$row['PRIX_U'].'</td>
           <td>'.$row['MONTANT'].'</td>
       </tr>
    ';
     }
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