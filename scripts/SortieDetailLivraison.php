<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>
 <table width="1350" border="0" cellpadding="100" cellspacing="10"  bgcolor="#ABAD68">
  <tr >
    <td height="350" valign="top">
<!--div class="row">
  <div class="col-xs-offset-2 col-xs-8">
      <h3>Listes des Articles</h3>
      </div>
    </div-->
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

    <div class="col-xs-8 ">';
   $ID_LIV=$_POST['SortieDetailLivraison'];
   $sqlquery="select A.ID_A, A.DESIGNATION, A.FAMILLE, C.QTE_CO, A.PRIX_U, C.QTE_CO * A.PRIX_U as 'MONTANT'
              FROM COMMANDE CO, ARTICLE A, CONTENIR_CO C, LIVRAISON L
              WHERE L.ID_LIV=$ID_LIV AND L.ID_CO=CO.ID_CO AND CO.ID_CO=C.ID_CO AND C.ID_A=A.ID_A ";
     
   $result=mysqli_query($link,$sqlquery);

   $sqlquery1="select L.ID_LIV, L.LIV_REF,  CL.ID_C, CL.RAISSO_C
              FROM LIVRAISON L, COMMANDE CO, CLIENT CL
              WHERE L.ID_LIV=$ID_LIV AND L.ID_CO=CO.ID_CO AND  CO.ID_C=CL.ID_C";
   $result1=mysqli_query($sqlquery1);
   $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
   panel_tab_defaut('panel-info','<div class="row">
                                <div class="col-xs-12"> <h2 class="text-center"><img src="../images/Sortielivraison.JPG" width="100" heigth="100" class="img-circle">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Liste Des lignes de Livraison</strong></h2> </div>
                              </div>
                              <div class="row">
                                <div class=" col-xs-6 ">Livraison :  <em class="ligneCommande">'.$row1['ID_LIV'].' - '.$row1['LIV_REF'].'</em> </div>
                                <div class="col-xs-offset-2 col-xs-4">Client :  <em class="ligneCommande">'.$row1['ID_C'].' - '.$row1['RAISSO_C'].'</em> </div>

                              </div>'
                              );
   echo '
   <table class="table table-bordered table-striped table-condensed">
   <tr class="info">
     
     
      
      <td><strong>ID_Article</strong></td>
      <td><strong>Désignation</strong></td>
      <td><strong>Famille</strong></td>
      <td><strong>Quantité</strong></td>
      <td><strong>Prix Vente</strong></td>
      <td><strong>Montant</strong></td>

   </tr>';
   
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    
    echo '
       <tr>
          
           <td>'.$row['ID_A'].'</td>
           <td>'.$row['DESIGNATION'].'</td>
           <td>'.$row['FAMILLE'].'</td>
           <td>'.$row['QTE_CO'].'</td>
           <td>'.$row['PRIX_U'].'</td>
           <td>'.$row['MONTANT'].'</td>
       </tr>
    ';
   }
   echo'</table>
   
 
    <!--Div de la fonction panel_tab-->
    </div>
    <a href="../scripts/SortieLivraison.php"><input type="image" src="../images/retour2.PNG" width="70" heigth="70" title="Retour au Livraison"></a>
    </div>
    </div>';
     
     
   
      
   
    ?> 
   



 </td>

  </tr>

 

</table>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>