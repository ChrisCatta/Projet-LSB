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
    bar_entree();
    echo ' </div> 
    <div class="col-xs-9 well3">';
   $sqlquery="select  * FROM  LIV_BON ";
     
   $result=mysqli_query($link,$sqlquery);


   
   panel_tab_defaut('panel-success','<div class="row ">
                                <div class="col-xs-12 "> <h2 class="text-center"><strong><img src="../images/ajoutcommande.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;&nbspListe Des Livraisons</strong></h2> </div>
                              </div>
                              '
                              );
   echo '
   <table class="well3">
   <tr >
      <td><form name="formajout" action="ajoutLivraison.php" method="post"><div class="plus"><input name="ajoutLivraison" type="image" class="ajoute" title="Ajouter Livraison" ></div></form></td>
      <td></td>

      
      <td><strong>ID_Liv</strong></td>
      <td><strong>Réference</strong></td>
      <td><strong>Date_Liv</strong></td>
      <td><strong>Type_Liv</strong></td>
      <td><strong>Solde</strong></td>
     
   </tr>';
   
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    
    echo '
       <tr>
           <td><form name="formafficher" action="afficheLivraison.php" method="post"><div class="affiche"><input name="afficheLivraison" type="submit" class="ajoute" value="'.$row['ID_BONL'].'" title="Détail Livraison"></div></form></td>

           <td><form name="formsupprimer" action="supprimerLivraison.php" method="post"><div class="supprime"><input name="supprimerLivraison" type="submit" class="ajoute" value="'.$row['ID_BONL'].'" title="Supprimer Livraison"></div></form></td>
           
           
           <td>'.$row['ID_BONL'].'</td>
           <td>'.$row['REF_LIV'].'</td>
           <td>'.$row['DATE_BONL'].'</td>
           <td>'.$row['TYPE_LIV'].'</td>
           <td>'.$row['SOLDE'].'</td>
           
       </tr>
    ';
   }
   echo'</table>
   
 
        <!--Div de la fonction panel_tab-->
        </div>
    </div>
    </div>';
     
     
   
      
   
    ?> 



<?php 
include('../modeles/pied.php'); ?>