   <?php require_once('conn.php');
    
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
    ?>
  <?php
                    if(isset($_GET['idBL']))
                    {
                    $idbl=$_GET['idBL'];
               }
               else{
                echo ("rien trouve");
               }
                    $req= "SELECT L.ID_LIGNE, L.ID_BONL, L.ID_A, L.QTE_BON_L, A.ID_A, A.DESIGNATION FROM contenir_bon_l  L, ARTICLE A WHERE ID_BONL='$idbl' AND A.ID_A=L.ID_A order by A.DESIGNATION ASC";
                    $res = mysqli_query($link,$req) or exit(mysql_error());
                    
                     $req2="SELECT ID_BONL, SUM(QTE_BON_L) AS QTE_ENTREE from contenir_bon_l where ID_BONL='$idbl'";
                      $res2=mysqli_query($link,$req2);
                     $row2=mysqli_fetch_array($res2,MYSQLI_ASSOC);
          ?>

                 <table id="ligne-livraison" border="1"> 
                                <thead>
                                 <tr>
                                    <th><strong>supp</strong></th>
                                    <th><strong>Id Ligne</strong></th>
                                    <th><strong>Id Bon</strong></th>
                                    <th><strong>Id Art</strong></th>
                                    <th><strong>Désignation</strong></th>
                                    <th><strong>QTe BL</strong></th>
                                    <!--<th><strong>valider</strong></th>-->
                                 </tr>
                                </thead>
    <tbody>
                    <?php
                 while($row=mysqli_fetch_array($res,MYSQLI_ASSOC))
                 {
                 ?>
       <tr id="row<?php echo $row['ID_LIGNE']?>" name="ID_LIGNE">
        <td><button type="button" class="supprime supprimeLLIV" id="<?php echo $row['ID_LIGNE']?>" onclick="suppLigneLiv(<?php echo $row['ID_LIGNE']?>)"></button></td>
           <td> <?php echo $row['ID_LIGNE']?></td>
           <td> <?php echo $row['ID_BONL']?></td>
           <td> <?php echo $row['ID_A']?></td>
           <td> <?php echo $row['DESIGNATION']?></td>
           <td><input id="QTE" type="spinner" name="QTE_BON_L[]" class="ui-spinner chiffre" value="<?php echo $row['QTE_BON_L']?>"><input id="LIGNE" type="hidden" name="ID_LIGNE"  value="<?php echo $row['ID_LIGNE']?>"></td>
       
            <?php
            /*if($row['QTE_BON_L']>0)
            {
            ?>
            <td></td>
            <?php
              }
              else{
                ?>
              <!-- <td><form name="formvalider" action="update-ligne-liv.php" method="post"><div class="quantite"><input  type="text" name="AJOUT_QTE"  >
              <input name="ID_LIGNE" type="submit" class="ajoute" value="<?=$row['ID_LIGNE']?>" title="Ajouter quantité"></div></form></td>-->
           <?php  
            //}*/
             }
   ?>
       </tr>
       <tr>
          <td colspan="5" class="success"><strong>Quantité piece</strong></td>
         <td>
           <?=$row2['QTE_ENTREE']?></td>
           </tr>
      </tbody>
 
   </table>
   </div>
                     