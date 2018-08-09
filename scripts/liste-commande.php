  <?php require_once('conn.php');
    
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
                    if(isset($_GET['idtype']))
                    {
                      $type=$_GET['idtype'];
                      $req="select *  FROM ARTICLE WHERE  ID_TYPE=$type ORDER BY ID_FAMILLE ASC";
                      $res = mysqli_query($link,$req) or exit(mysql_error());
                      }
                    else{
                        if(isset($_GET['idfamille']))
                              {
                              $famille=$_GET['idfamille'];
                              $req="select *  FROM ARTICLE WHERE  ID_FAMILLE= '$famille'";
                              $res = mysqli_query($link,$req) or exit(mysql_error());
                              }
                         else{
                              $req="select *  FROM ARTICLE ";
                              $res = mysqli_query($link,$req) or exit(mysql_error());
                         }
                     }
  ?>
                 <table id="commande" border="1" width="100%" class="display"> 
                                <thead>
                                 <tr>
                                    <th><strong>Modif</strong></th>
                                    <th><strong>Id</strong></th>
                                    <th><strong>Désignation</strong></th>
                                    <th><strong>Type</strong></th>
                                    <th><strong>Famille</strong></th>
                                    <th><strong>Long</strong></th>
                                    <th><strong>Lar</strong></th>
                                    <th><strong>Epais</strong></th>
                                    <th><strong>Vol</strong></th>
                                    <th><strong>Stock reel</strong></th>
                                    <th><strong>Stock mini</strong></th>
                                    <th><strong>Qte</strong></th>
                                 </tr>
                                </thead>
    <tbody>
                    <?php
                 while($row=mysqli_fetch_array($res,MYSQLI_ASSOC))
                 {
                  if($row['CHEMIN_IMG']== NULL)
                  {
                    $row['CHEMIN_IMG']='../images/pasimage.PNG';
                  } 
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
                     $mini=$row['QTE_MIN'];
                     $diff=$dispo-($mini+5);
                     if($dispo>$mini+5){
                       $color="stockOK";
                       }
                       else{
                         if(($mini-5<$dispo)&($dispo<$mini+5)){
                           $color="stockLimite";
                           }
                           else{
                             $color="stockDown";
                             }
                         }

                     $req4="SELECT * FROM TYPE WHERE ID_TYPE='$type' ";
                     $res4= mysqli_query($link,$req4);
                     $row4=mysqli_fetch_array($res4,MYSQLI_ASSOC);

                     $req3="SELECT * FROM FAMILLE WHERE ID_FAM='$famille' ";
                     $res3= mysqli_query($link,$req3);
                     $row3=mysqli_fetch_array($res3,MYSQLI_ASSOC);
                 ?>
       <tr class="<?=$color?>" id="<?php echo $row['ID_A']?>" data-info="<?php echo $row['ID_A']?>">
       <td><form name="formafficher" action="modification_article1.php" method="post"><div class="affiche"><input name="ID_A" type="submit" class="ajoute" value="<?=$row['ID_A']?>" title="Détail Article"></div></form></td>
           <td><?php echo $row['ID_A']?></td>
           <td><?php echo $row['DESIGNATION']?></td>
           <td><?php echo $row4['TYPE']?></td>
           <td><?php echo $row3['FAMILLE']?></td>
           <td><?php echo $row['LONGUEUR']?></td>
           <td><?php echo $row['LARGEUR']?></td>
           <td><?php echo $row['EPAISSEUR']?></td>
           <td><?php echo ($row['QTE'])*($row['QTE_STO']+$row1['QTE_ENTREE']-$row2['QTE_SORTIE'])?></td>
           <td><?php echo $dispo ?></td>
           <td><?php echo $row['QTE_MIN']?></td>
           <td> <form action=""><input id="qte<?php echo $row['ID_A']?>" type="text" size="5"  placeholder="QTE" value=""/></form></td>
           <?php  
             }
            ?>
       </tr>
      </tbody>
 
   </table>
   </div>
     <script type="text/javascript">
                   $(document).ready(function(){
                  $('#commande').DataTable({
                  scrollY:        '50vh',
                  paging:         false
                 });
                  });
                 </script>     
                     