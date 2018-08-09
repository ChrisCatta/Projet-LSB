  <?php require_once('conn.php');
    
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
    ?>
  <?php
                    if(isset($_GET['idCO']))
                    {
                    $idco=$_GET['idCO'];
               }
               else{
                echo ("rien trouve");
               }
                    $req= "SELECT L.ID_CO_LIGNE, L.ID_CO, L.ID_A, L.QTE_CO, A.ID_A, A.DESIGNATION, A.ID_TYPE, A.ID_FAMILLE, A.QTE_STO FROM contenir_co  L, ARTICLE A WHERE L.ID_CO='$idco' AND A.ID_A=L.ID_A";
                    $res = mysqli_query($link,$req) or exit(mysql_error());
          ?>

                 <table id="ligne-commande" border="1"> 
                                <thead>
                                 <tr>
                                    <th><strong>supp</strong></th>
                                    <th><strong>Id Ligne</strong></th>
                                    <th><strong>Id Bon</strong></th>
                                    <th><strong>Id Art</strong></th>
                                    <th><strong>Famille</strong></th>
                                    <th><strong>Désignation</strong></th>
                                    <th><strong>QTe DISPO</strong></th>
                                    <th><strong>QTe CO</strong></th>
                                 </tr>
                                </thead>
    <tbody>
                    <?php
                 while($row=mysqli_fetch_array($res,MYSQLI_ASSOC))
                 {
                   
                      $article=$row['ID_A'];
                      $type =$row['ID_TYPE'];
                      $famille=$row['ID_FAMILLE'];
                      $req1="SELECT ID_A, SUM(QTE_BON_L) AS QTE_ENTREE from contenir_bon_l where ID_A='$article'";
                      $res1=mysqli_query($link,$req1);
                     $row1=mysqli_fetch_array($res1,MYSQLI_ASSOC);

                      $req2="SELECT ID_A, SUM(QTE_CO) AS QTE_SORTIE from contenir_co where ID_A='$article'";
                      $res2=mysqli_query($link,$req2);
                     $row2=mysqli_fetch_array($res2,MYSQLI_ASSOC);
                     
                     $dispo=$row['QTE_STO']+$row1['QTE_ENTREE']-$row2['QTE_SORTIE'];
                     if($dispo>=5){
                       $color="stockOK";
                       }
                       else{
                         if((0<$dispo)&($dispo<5)){
                           $color="stockLimite";
                           }
                           else{
                             $color="stockDown";
                             }
                         }
                     
                      $req3="SELECT * from FAMILLE where ID_FAM='$famille'";
                      $res3=mysqli_query($link,$req3);
                     $row3=mysqli_fetch_array($res3,MYSQLI_ASSOC);
                 ?>
       <tr class="<?=$color?>" id="<?php echo $row['ID_CO']?>" name="ID_CO">
        <td><button type="button" class="supprime supprimeLCO" id="<?php echo $row['ID_CO_LIGNE']?>" ></button></td>
           <td><input  type="hidden" name="ID_CO_LIGNE[]" value="<?=$row['ID_CO_LIGNE']?>"/><?php echo $row['ID_CO_LIGNE']?></td>
           <td> <?php echo $row['ID_CO']?></td>
           <td> <?php echo $row['ID_A']?></td>
           <td> <?php echo $row3['FAMILLE']?></td>
           <td> <?=$row['DESIGNATION']?></td>
           <td><?php echo $dispo ?></td>
           <td><input  name="QTE_CO[]" class="ui-spinner chiffre" max="<?php echo $dispo ?>" value="<?php echo $row['QTE_CO']?>"/></td>
           <?php  
             }
            ?>
       </tr>
      </tbody>
 
   </table>
   <input  type="hidden" id="idco" name="ID_CO" value="<?=$idco?>"/>
   </div>
                     