
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
    bar_client(1);
   ?>
   </div> 
    <div class="col-xs-9 well3">
  <?php
   $sqlquery="SELECT *  FROM CLIENT ";
   $result=mysqli_query($link,$sqlquery);
   panel_tab('panel-info','<img src="../images/listeClient.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;&nbsp;Listes des Clients');
   ?>
   <table id="Client" class="display" border="1" width="100%" >
     <thead>
       <tr >
          <th><strong>Modif</strong></th>
          <th><strong>Supp</strong></th>
          <th><strong>Id</strong></th>
          <th><strong>Nom </strong></th>
          <th><strong>Adresse</strong></th>
          <th><strong>Tél.</strong></th>
          <th><strong>NIF.</strong></th>
          <th><strong>STAT.</strong></th>
          <th><strong>E-mail</strong></th>
       </tr>
     </thead>
      <tbody>
   <?php
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
   ?>
         <tr>
          <td><form name="formafficher" action="modification_client1.php" method="post"><div class="affiche"><input name="ID_C" type="submit" class="ajoute" value=<?=$row['ID_C']?>" title="Détail Article"></div></form></td>
           <td><form name="formsupprimer" action="client_effacer.php" method="post"><div class="supprime"><input name="supprimerclient" type="submit" class="ajoute" value="<?=$row['ID_C']?>" title="Supprimer CLient"></div></form></td>
             <td><?=$row['ID_C']?></td>
             <td><?=$row['RAISSO_C']?></td>
             <td><?=$row['ADRESSE_C']?></td>
             <td><?=$row['TEL_C']?></td>
             <td><?=$row['NIF']?></td>
             <td><?=$row['STAT']?></td>
             <td><?=$row['EMAIL']?></td>
         </tr>
    <?php
   }
 ?>
       </tbody>
 </table>
     <script type="text/javascript">
        $(document).ready(function(){
        $('#Client').DataTable();
         });
      </script>   
   
    <!-- div de la fonction panel_tab -->
    </div>
    </div>
    </div>
 
<?php 
include('../modeles/pied.php'); ?>