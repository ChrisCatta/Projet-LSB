<?php
session_start();
 include('../modeles/enteteAdmin.php');
 ?>     
    <div class="row">
      <div class="col-xs-3">
       <?php
        include('../modeles/bar_menu.php');
       include('../scripts/connexionDB.php');
          $retour=connexion();
          //$c=$retour[0];
          $link=$retour[0];  
        bar_tarif();
          ?>
     </div> 
     <div class="col-xs-9 well3">
       <div class="row">
            <div class="col-xs-2 panel">
              <img src="../images/modifarticle.PNG" class="img-circle" width="100" height="100"/>
            </div>
            <div class="col-xs-8 panel">
              <h1>Liste avec prix</h1>
            </div>
      </div>
       <div class="row">
           <?php 
             
            $req="select *  FROM TYPE ";
            $res = mysqli_query($link,$req) or exit(mysql_error());
            $rows = array();
            while($row=mysqli_fetch_array($res)){
              $rows[] = $row;
              }
            /*echo '<pre>';
            print_r($rows);
            echo '</pre>';*/
              foreach($rows as $row){
             $type=$row['ID_TYPE'];
             $req1="select * FROM FAMILLE WHERE ID_TYPE='$type'";
            $res1 = mysqli_query($link,$req1) or exit(mysql_error());
            $rows1 = array();
            ?>
            <table class="info" border="1" >
              <tr>
                <td width="20%"><strong><?=$row['TYPE']?></strong></td><td width="20%">&nbsp;</td><td width="60%">&nbsp;</td>
              </tr>
              </table>
           <?php 
              while($row1=mysqli_fetch_array($res1)){
                  $rows1[] = $row1;
              }
              foreach($rows1 as $row1){
              $famille=$row1['ID_FAM'];
              $req2="SELECT ID_A, ID_FAMILLE, DESIGNATION,LONGUEUR, LARGEUR,UNITE,TX,ID_TARIF,PRIX_U FROM ARTICLE WHERE ID_FAMILLE='$famille' GROUP BY ID_TARIF, ID_FAMILLE,DESIGNATION ,LONGUEUR, LARGEUR,UNITE,TX,ID_A,PRIX_U ORDER BY PRIX_U ASC, LONGUEUR ASC, LARGEUR ASC";
              $res2 = mysqli_query($link,$req2) or exit(mysql_error());
           /* echo '<pre>';
            print_r($res2);
            echo '</pre>';*/
              ?>
              <table>
              <tr>
                <td style="width:20%">&nbsp;</td><td style="width:20%"><?=$row1['FAMILLE']?></td><td width="60%">&nbsp;</td>
              </tr>
              <tr>
                 <table border="1" > 
                           <thead>
                              <tr>
                                    <th><strong>Id</strong></th>
                                    <th><strong>Désignation</strong></th><!--<th><strong>Type</strong></th>
                                      <th><strong>Famille</strong></th>-->
                                    <th><strong>Long</strong></th>
                                    <th><strong>Lar</strong></th>
                                    <th><strong>U</strong></th>
                                    <th><strong>PU</strong></th>
                                    <th><strong>Taux</strong></th>
                                    <th><strong>PV-HT</strong></th>
                               </tr>
                          </thead>
                          <tbody>
                                  <?php
                                     while($row2=mysqli_fetch_array($res2,MYSQLI_ASSOC))
                                       {
                                   ?>
                                       <tr>
                                       <td><?php echo $row2['ID_A']?></td>
                                       <td><?php echo $row2['DESIGNATION']?></td>
                                      <!-- <td><?php echo $row['TYPE']?></td>
                                       <td><?php echo $row1['FAMILLE']?></td>-->
                                       <td><?php echo $row2['LONGUEUR']?></td>
                                       <td><?php echo $row2['LARGEUR']?></td>
                                       <td><?php echo $row2['UNITE']?></td>
                                       <td><?php echo $row2['PRIX_U']?></td>
                                       <td><?php echo $row2['TX']?></td>
                                       <td><?php echo number_format(round($row2['PRIX_U']+$row2['PRIX_U']*($row2['TX']/100)),2,',',' ')?></td>
                                       </tr>
                                   <?php
                                         }
                                   ?>
                          </tbody>
 
                    </table>
                    </tr>
        <?php
                                      }  
                                   }
                                ?>
            </tr>
        </table>
        </div>
   </div>
  