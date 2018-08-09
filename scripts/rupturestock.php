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
    bar_stock(6);
   ?> 
   </div> 
    <div class="col-xs-9 well3">
  <?php
   $sqlquery="SELECT DISTINCT A.ID_A, A.DESIGNATION, A.FAMILLE, A.PRIX_U, A.QTE_STO, A.QTE_MIN, A.CHEMIN_IMG  FROM ARTICLE A WHERE  A.QTE_STO=0 OR A.QTE_STO IS NULL";
   $result=mysqli_query($link,$sqlquery);
   panel_tab('panel-default','<img src="../images/rupture.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;&nbsp;Listes des Articles en Rupture de Stock');
   ?>
   <table id="Stock" class="display" border="1" width="100%" >
   <thead>
   <tr class="danger">
      <th><strong>Identifiant</strong></th>
      <th><strong>Désignation</strong></th>
      <th><strong>Famille</strong></th>
      <th><strong>Prix_Uni</strong></th>
      <th><strong>Qte_Stock</strong></th>
      <th><strong>Qte_Seuil</strong></th>
      <th><strong>Image</strong></th>
   </tr>
   </thead>
   <?php
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    if($row['CHEMIN_IMG']== "NULL")
    {
      $row['CHEMIN_IMG']='../images/pasimage.PNG';
    }
?>
<tbody>
       <tr>
           <td><?=$row['ID_A']?></td>
           <td><?=$row['DESIGNATION']?></td>
           <td><?=$row['FAMILLE']?></td>
           <td><?=$row['PRIX_U']?></td>
           <td class="danger"><?=$row['QTE_STO']?></td>
           <td ><?=$row['QTE_MIN']?></td>
           <td><img src="<?=$row['CHEMIN_IMG']?>"  align="center"></td>
       </tr>
<?php
   }
?>
</table>
   
 
<!--Div de la fonction panel_tab-->
    </div>
    </div>
    </div>
 <script type="text/javascript">
                   $(document).ready(function(){
                  $('#Stock').DataTable();
                  });
                 </script> 
<?php 
include('../modeles/pied.php'); ?>