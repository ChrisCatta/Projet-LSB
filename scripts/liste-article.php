  

  <?php require_once('conn.php');?>
  <?php
              if(isset($_GET['ID_FAMILLE']))
              {
                    $famille=$_GET['ID_FAMILLE'];
                    $req="select *  FROM ARTICLE WHERE  ID_FAMILLE= '$famille'";
                    $res = mysqli_query($link,$req) or exit(mysql_error());
               }
               else{
                    if(isset($_GET['idtype']))
                    {
                    $type=$_GET['idtype'];
                    $req="SELECT *  FROM ARTICLE WHERE  ID_TYPE= '$type'";
                    $res = mysqli_query($link,$req) or exit(mysql_error());
                     }
                     else{
                          $req="SELECT *  FROM ARTICLE ";
                          $res = mysqli_query($link,$req) or exit(mysql_error());
                     }
                }
          ?>
                 <table id="Article" border="1" width="100%" class="display"> 
                                <thead>
                                 <tr>
                                 <th></th>
                                    <th><strong>Id</strong></th>
                                    <th><strong>Désignation</strong></th>
                                    <th><strong>Type</strong></th>
                                    <th><strong>Famille</strong></th>
                                    <th><strong>Long</strong></th>
                                    <th><strong>Lar</strong></th>
                                    <th><strong>Epais</strong></th>
                                    <th><strong>Diam</strong></th>
                                    <th><strong>Stock</strong></th>
                                    <th><strong>Image</strong></th>
                                 </tr>
                                </thead>
    <tbody>
                    <?php
                 while($row=mysqli_fetch_array($res,MYSQLI_ASSOC))
                 {
                          if($row['CHEMIN_IMG']=="NULL")
                          {
                            $row['CHEMIN_IMG']='../images/pasimage.PNG';
                          }
                  $article=$row['ID_A'];
                      $req1="SELECT ID_A, SUM(QTE_BON_L) AS QTE_ENTREE from contenir_bon_l where ID_A='$article'";
                      $res1=mysqli_query($link,$req1);
                     $row1=mysqli_fetch_array($res1,MYSQLI_ASSOC);

                      $req2="SELECT ID_A, SUM(QTE_CO) AS QTE_SORTIE from contenir_co where ID_A='$article'";
                      $res2=mysqli_query($link,$req2);
                     $row2=mysqli_fetch_array($res2,MYSQLI_ASSOC);

                     $req4="SELECT * FROM TYPE WHERE ID_TYPE='$type'";
                     $res4= mysqli_query($link,$req4);
                     $row4=mysqli_fetch_array($res4,MYSQLI_ASSOC);

                     $req3="SELECT * FROM FAMILLE WHERE ID_FAM='$famille'";
                     $res3= mysqli_query($link,$req3);
                     $row3=mysqli_fetch_array($res3,MYSQLI_ASSOC);
                  echo $row['ID_A'];
                  echo $row['ID_TYPE'];
                 ?>
       <tr id="<?php echo $row['ID_A']?>" data-info="<?php echo $row['ID_A']?>">
       <td><form name="formafficher" action="modification_article1.php" method="post"><div class="affiche"><input name="ID_A" type="submit" class="ajoute" value="<?=$row['ID_A']?><input name="ID_TYPE" type="hidden" value="<?=$row['ID_TYPE']?>" title="Détail Article"></div></form></td>
           <td><?php echo $row['ID_A']?></td>
           <td><?php echo $row['DESIGNATION']?></td>
           <td><?php echo $row4['TYPE']?></td>
           <td><?php echo $row3['FAMILLE']?></td>
           <td><?php echo $row['LONGUEUR']?></td>
           <td><?php echo $row['LARGEUR']?></td>
           <td><?php echo $row['EPAISSEUR']?></td>
           <td><?php echo $row['DIAMETRE']?></td>
           <td><?=$row['QTE_STO']+$row1['QTE_ENTREE']-$row2['QTE_SORTIE']?></td>
           <td><img src="<?php echo $row['CHEMIN_IMG']?> " align="center"></td>
           <?php  
         }
   ?>
       </tr>
       <tr>
         <td></td>
       </tr>
      </tbody>
 
   </table>
   </div>
  <script type="text/javascript">
                   $(document).ready(function(){
                  $('#Article').DataTable();
                  chargerCategories();
                  });
                 </script>         