<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>
    <div class="row ">
      <div class="col-xs-3">
    <?php
   include('../scripts/connexionDB.php');
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
    
    include('../modeles/bar_menu.php'); 
    bar_entree(3);
    ?>
    </div> 

    <div class="col-xs-9 well3">
      <?php
   $ID_BONL=$_POST['afficheLivraison'];
   $sqlquery2="select  sum(C.QTE_BON_L) as QTETOT
               from CONTENIR_BON_L C 
               where C.ID_BONL=$ID_BONL";
               
               $result2=mysqli_query($link,$sqlquery2);
               $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
               
   $sqlquery="SELECT A.ID_A, A.DESIGNATION, A.FAMILLE,A.TYPE,  C.ID_A, C.ID_BONL, C.ID_LIGNE, C.QTE_BON_L, L.ID_BONL
              FROM  ARTICLE A, CONTENIR_BON_L C, LIV_BON L
              WHERE C.ID_BONL='$ID_BONL' AND  L.ID_BONL='$ID_BONL' AND A.ID_A=C.ID_A order by DESIGNATION ASC";
     
   $result=mysqli_query($link,$sqlquery);


    $sqlquery1="SELECT L.ID_BONL, L.REF_LIV, L.DATE_BONL
              FROM  LIV_BON L
              WHERE L.ID_BONL='$ID_BONL' ";
     
   $result1=mysqli_query($link,$sqlquery1);
   $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
  panel_tab_defaut('panel-success','<div class="row">')?>
                                <div class="col-xs-12"> <h2 class="text-center"><strong><img src="../images/ajoutcommande.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;&nbsp;Liste Des Lignes de Livraison</strong></h2> </div>
                              </div>
                              <div class="row">
                                  <div class=" col-xs-8 ">Livraison :  <em class="ligneCommande"><?=$row1['ID_BONL']?>- <?=$row1['REF_LIV']?></em> </div>
                                  <div class=" col-xs-4 ">Date :  <em class="ligneCommande"><?=$row1['DATE_BONL']?></em> </div>
                              </div>

   <table>
   <tr class="success">
      <td><form name="formajout" action="ligneLivraison1.php" method="post"><div class="plus" ><input name="ID_BONL" type="submit" class="ajoute" title="Ajouter une Ligne de Livraison" value="<?=$row1['ID_BONL']?>"></div></form></td>
    
      
        <th><strong>Id Ligne</strong></th>
        <th><strong>Id Bon</strong></th>
      <th><strong>ID_Article</strong></th>
      <th><strong>Désignation</strong></th>
      <th><strong>Quantité</strong></th>
     </tr>
   <?php
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    
 ?>
       <tr>
           <!--td><form name="formafficher" action="afficheLivraison.php" method="post"><div class="affiche"><input name="afficheLivraison" type="submit" class="ajoute" value="'.$row['ID_A'].'" title="Détail Livraison"></div></form></td-->

           <td><form name="formsupprimer" action="supprimerLigneLivraison.php" method="post"><div class="supprime"><input type="hidden" name="ID_BONL" value="<?=$row1['ID_BONL']?>"><input name="ID_LIGNE" type="submit" class="ajoute" value="<?=$row['ID_LIGNE']?>" title="Supprimer Livraison"></div></form></td>
           
           <td> <input  class="chiffre" name="ID_LIGNE[]" maxlength="10" value="<?php echo $row['ID_LIGNE']?>"></td>
           <td> <input  class="chiffre" name="ID_BONL" maxlength="10" value="<?php echo $row['ID_BONL']?>" disabled="disabled"></td>
            <td> <input  class="chiffre" name="ID_A" maxlength="30" value="<?php echo $row['ID_A']?>" disabled="disabled"></td>
           <td> <input  name="DESIGNATION" maxlength="30" value="<?=$row['DESIGNATION']?>" disabled="disabled"></td>
           <td><input id="spinner" type="spinner" name="QTE_BON_L[]" class="ui-spinner chiffre" value="<?php echo $row['QTE_BON_L']?>"></td>
         
          
       </tr>
   <?php
   }
  ?>
          <tr>
              <td colspan="5" class="success"><strong>Quantité piece</strong></td>
              <td ><strong><?php echo $row2['QTETOT']?></strong></td>
          </tr>
   </table>
         <div class="row"> 
            <div class="col-xs-offset-10 col-xs-2">
   <button type="submit" name="Submit" value="Valider" class=" btn btn-primary">Valider</button> 
    </div>
    </div>
 
    <!--Div de la fonction panel_tab-->
    </div>
    </div>
    </div>

<?php 
include('../modeles/pied.php'); ?>