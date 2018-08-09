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
   if($c==1)
   {
    include('../modeles/bar_menu.php'); 
    bar_administration(1);
?>
  
       </div> 
            <div class="col-xs-9 well3">
                  <?php
                   $sqlquery="SELECT * FROM UTILISATEUR ORDER BY NOM";
                   $result=mysqli_query($link,$sqlquery);
                   panel_tab('panel-info','<img src="../images/utilisateur.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;Listes des Utilisateurs');
                   ?>
                   <table class="display">
                   <tr class="info">
                   <td></td>
                      <td><strong>NOM</strong></td>
                      <td><strong>PRENOM</strong></td>
                      <td><strong>DATE_DE_NAISSANCE</strong></td>
                      <td><strong>SEXE</strong></td>
                      <td><strong>ADRESSE</strong></td>
                      <td><strong>SERVICE</strong></td>
                   </tr>
                   <?php
                   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                   {
                    echo '
                       <tr>
                       <td><form name="afficher" action="modificationUti2.php" method="post"><div class="affiche"><input name="modifUti" type="submit" class="ajoute" value="'.$row['ID_USER'].'" title="Détail Article"></div></form></td>
                           <td>'.$row['NOM'].'</td>
                           <td>'.$row['PRENOM'].'</td>
                           <td>'.$row['DATENAIS'].'</td>
                           <td>'.$row['SEXE'].'</td>
                           <td>'.$row['ADRESSE'].'</td>
                           <td>'.$row['SERVICE'].'</td>
                       </tr>
                    ';
                   }
               ?>
               </table>
                   
                 
                <!-- div de la fonction panel_tab -->
                    </div>
                    </div>
                     
                    <?php 
                   }
                    ?> 
                    </div>
<?php 
include('../modeles/pied.php'); ?>