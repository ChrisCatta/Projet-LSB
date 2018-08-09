<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>
<script type="text/javascript">
                   $(document).ready(function(){
                  //chargerCategories();
                 // chargerFamille();
                //  calcultarif();
               //   calculquantite();
                  famille();
                  type();
                  });
                 </script>  
    <div class="row">
      <div class="col-xs-3">
      

    <?php
    include('../scripts/connexionDB.php');
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
   include('../modeles/bar_menu.php'); 
    bar_stock(4);
    ?> 
      </div> 

    <div class="col-xs-9 well3">
        
 <?php
    $_ID_A=$_POST['ID_A'];
    $sqlquery="SELECT * FROM ARTICLE  WHERE ID_A='$_ID_A' ";
    $result=mysqli_query($link,$sqlquery);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    
    
    
    
    
            $idtype=$row['ID_TYPE'];
            $idfamille=$row['ID_FAMILLE'];
            $PU=$row['ID_TARIF'];
            $_U=$row['UNITE'];
            if($row['CHEMIN_IMG']== "NULL")
              {
                $row['CHEMIN_IMG']='../images/pasimage.PNG';
              }
              
              
      /*Calcul des elements stock*/
            $req1="SELECT ID_A, SUM(QTE_BON_L) AS QTE_ENTREE from contenir_bon_l where ID_A='$_ID_A'";
            $res1=mysqli_query($link,$req1);
            $row1=mysqli_fetch_array($res1,MYSQLI_ASSOC);

            $req2="SELECT ID_A, SUM(QTE_CO) AS QTE_SORTIE from contenir_co where ID_A='$_ID_A'";
            $res2=mysqli_query($link,$req2);
            $row2=mysqli_fetch_array($res2,MYSQLI_ASSOC);    
     ?> 
  
  
 
    <div class="row">
      <form name="form1" method="post" action="modification_article2.php" enctype="multipart/form-data"  >
        <p>
          <div class="row">
            <div class="col-xs-2 ">
              <img src="../images/modifarticle.PNG" class="img-circle" width="100" height="100">
            </div>
            <div class="col-xs-8 table-responsive">
              <legend><h1>Modification d'un Article</h1></legend>
            </div>
            <div class="col-xs-2">
              <img src="<?=$row['CHEMIN_IMG']?>" class="img-circle" width="100" height="100">
            </div>
          </div>
            
         <fieldset>
          <div class="row">
             <div class="form-group">
                <label for="select" class="col-xs-2">Désignation</label>
                  <div class="col-xs-3">
                     <input  pattern=".{3,30}" required title="La désignation contient minimum 3 caractères et maximum 30 caractères." class="ui-widget ui-widget-content ui-corner-all" name="DESIGNATION" maxlength="30" value="<?=$row['DESIGNATION']?>"/>
                       
                  </div>
                  <label  class="col-xs-2">Modifier l'image</label>
                      <div class=" col-xs-3">
                        <input  class="ui-widget ui-widget-content ui-corner-all" maxlength="30" name="CHEMIN_IMG" value="<?=$row['CHEMIN_IMG']?>"/>
                      </div>
                      <div class=" col-xs-2">
                        <input type="file"  id="IMG_FILE" accept="image/gif, image/jpeg, image/JPG, image/png" />
                      </div>
             </div>
          </div>
          <div class="row">
             <div class="col-xs-2">
                   Select Type :
              </div>
             <div id="div-type" class="col-xs-4">
                
                <select id="select-type"  class="selectpicker" name="ID_TYPE">
                 <?php
              $sql = "SELECT * FROM TYPE order by ID_TYPE";
              $res = mysqli_query($link,$sql) or exit(mysql_error());
                    while($data=mysqli_fetch_array($res)) 
                    {
                      if(isset($idtype)){
                        if($data['ID_TYPE']==$idtype){
                           echo '<option value="'.$data['ID_TYPE'].'" selected="selected">'.$data['TYPE'].'</option><br/>'; 
                        }
                        else{
                       echo '<option value="'.$data['ID_TYPE'].'">'.$data['TYPE'].'</option><br/>'; //Attention à ne pas oublier le . qui sert à concaténer ton expression
                      }
                    }
                    }
                     
                  ?> 
                  </select>
                 </div>    
                 <div class="col-xs-2">
                    Select Famille :
                  </div>    
                 <div id="div-famille" class="col-xs-4">
                       <select id="select-famille"  class="selectpicker" name="ID_FAM" >
  <?php
                  if(isset($idtype))
                  {
            $sql1 ="SELECT * FROM FAMILLE WHERE ID_TYPE='$idtype'";
            $res1 = mysqli_query($link,$sql1) or exit(mysql_error());
                    while($data1=mysqli_fetch_array($res1)) 
                    {
                      if(isset($idfamille)){
                        if($data1['ID_FAM']==$idfamille){
                           echo '<option value="'.$data1['ID_FAM'].'" selected="selected">'.$data1['FAMILLE'].'</option><br/>'; 
                        }
                        else{
                       echo '<option value="'.$data1['ID_FAM'].'">'.$data1['FAMILLE'].'</option><br/>'; //Attention à ne pas oublier le . qui sert à concaténer ton expression
                      }
                    }
                  }
                    }
                
                    ?>
                  </select>
                 </div>
             
             <div class="row">
               <div class="form-group">
                  <label  class="col-xs-2">Quantité Stock</label>
                    <div class="col-xs-4">
                        <input class="spinner"  name="QTE_STO" value="<?php echo $row['QTE_STO']+$row1['QTE_ENTREE']-$row2['QTE_SORTIE']?>">
                    </div>

                  <label  class="col-xs-2">Quantité Seuil</label>
                    <div class="col-xs-4">
                      <input class="spinner"  name="QTE_MIN"  value="<?=$row['QTE_MIN']?>">
                     </div>
                </div>
             </div>

             <div class="row">
                <div class="form-group">
                   <label  class="col-xs-2">Prix Unitaire</label>
                   <div class=" col-xs-3">
                     <select id="select-tarif"  class="selectpicker" name="ID_TARIF" >
              <?php
                            $sql2 ="SELECT * FROM TARIFS  ORDER BY ID_TARIF ASC";
                            $res2= mysqli_query($link,$sql2) or exit(mysql_error());
                    while($data2=mysqli_fetch_array($res2)) 
                    {
                      if(isset($PU)){
                        if($data2['ID_TARIF']==$PU){
                           echo '<option value="'.$data2['ID_TARIF'].'" selected="selected">'.$data2['MONTANTHT'].'</option><br/>'; 
                        }
                        else{
                       echo '<option value="'.$data2['ID_TARIF'].'">'.$data2['MONTANTHT'].'</option><br/>'; //Attention à ne pas oublier le . qui sert à concaténer ton expression
                      }
                    }
                     else{
                        echo '<option value="'.$data2['ID_TARIF'].'">'.$data2['MONTANTHT'].'</option><br/>'; 
                     }
                    }
                     
                    ?> 
                  </select>
                <!--<input type="hidden" id="PRIX_U" name="PRIX_U" value="<?=$data2['MONTANTHT']?>" />-->
                         
                <!--<input type="hidden" id="ID_TARIF" name="ID_TARIF" value="<?=$data2['ID_TARIF']?>" />-->
                </div>
                   <label  class="col-xs-1">Taux</label>
                      <div class=" col-xs-1">
                         <input min="0" max="100" maxlength="4" class="spinner" id="TX" name="TX"  value="<?=$row['TX']?>">
                      </div>
                   
                   <label  class="col-xs-1">Tarif</label>
                      <div class=" col-xs-3">
                        <input class="spinner" min="0" max="2000000000" maxlength="10" id="TARIF"  name="PV_HT" value="<?=$data2['MONTANTHT']?>*<?=$row['TX']?>">
                        </div>
                </div>
             </div>

             <div class="row">
                <div class="form-group">
                   <label  class="col-xs-2">Unité</label>
                      <div class=" col-xs-4">
                        <select  id="Select-unite" class="selectpicker" name="UNITE"  >
                          <?php
                            $sql3 ="SELECT * FROM UNITE  ORDER BY ID_UNITE ASC";
                            $res3= mysqli_query($link,$sql3) or exit(mysql_error());
                            while($data3=mysqli_fetch_array($res3))
                            {
                      if(isset($_U)){
                        if($data3['UNITE']==$_U){
                           echo '<option value="'.$data3['UNITE'].'" selected="selected">'.$data3['UNITE'].'</option><br/>'; 
                        }
                        else{
                       echo '<option value="'.$data3['UNITE'].'">'.$data3['UNITE'].'</option><br/>'; //Attention à ne pas oublier le . qui sert à concaténer ton expression
                      }
                    }
                     else{
                        echo '<option value="'.$data3['UNITE'].'">'.$data3['UNITE'].'</option><br/>'; 
                     }
                    }
                     
                    ?> 
                        </select>
                        
               <!--  <input type="hidden" id="UNITE" name="UNITE" value="<?=$data3['UNITE']?>"/>
                         
              <input type="hidden" id="ID_UNITE" name="ID_UNITE" value="<?=$data3['ID_UNITE']?>" />-->
                  </div>
                   <label  class="col-xs-2">Qte/U</label>
                      <div class=" col-xs-4">
                         <input min="0" max="2000000000" step="0.001" maxlength="10" class="spinner" id="QTE" name="QTE"  value="<?=$row['QTE']?>"/>
                      </div>
                </div>
             </div>
             <div class="row">
                <div class="form-group">
                   <label  class="col-xs-2">Longueur</label>
                    <div class=" col-xs-4">
                      <input  step="0.1" maxlength="10" class="spinner" id="longueur" name="LONGUEUR"  value="<?=number_format($row['LONGUEUR'],2,'.','')?>">
                    </div>
                   <label  class="col-xs-2">Largeur</label>
                     <div class=" col-xs-4">
                      <input min="0" max="2000000000" maxlength="10" class="spinner" id="largeur" name="LARGEUR"  value="<?=$row['LARGEUR']?>">
                      </div>
                </div>
             </div>
          <div class="row">
             <div class="form-group">
                    <label  class="col-xs-2">Epaisseur</label>
             
                <div class=" col-xs-4">
                    <input  min="0" max="2000000000" maxlength="10" class="spinner" id="epaisseur" name="EPAISSEUR"  value="<?=$row['EPAISSEUR']?>">
                </div>
               

                    <label  class="col-xs-2">Hauteur</label>
                 <div class=" col-xs-4">
                    <input  min="0" max="2000000000" step="0.01" maxlength="10" class="spinner" id="hauteur" name="HAUTEUR"  value="<?=$row['HAUTEUR']?>">
                 </div>
             </div>
          </div>
          <div class="row">
             <div class="form-group">
                  <label  class="col-xs-2">Diametre</label>
               <div class=" col-xs-4">
               
                  <input  min="0" max="2000" maxlength="10" class="spinner" id="diametre" name="DIAMETRE"  value="<?=$row['DIAMETRE']?>">
               </div>
               

                  <label  class="col-xs-2">Unité/Pqt</label>
               <div class=" col-xs-4">
               
                  <input  min="0" max="200" " maxlength="10" class="spinner" name="U_Pqt"  value="<?=$row['U_Pqt']?>">
               </div>
             </div>
          </div>
          <div class="row">
            <div class="form-group">
               <div class="col-xs-1">
                  <input type="hidden" name="ID_A" id="ID_A" class="form-control"  value="<?=$row['ID_A']?>">
               </div>
              
            <!-- <div class="col-xs-1">
                  <input type="hidden" name="CHEMIN_IMG" id="CHEMIN_IMG" class="form-control"  value="<?=$row['CHEMIN_IMG']?>">
              </div>-->
            
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <div class="col-xs-2">
                  <a href="listarticle.php"><button class="btn btn-primary" type="button">Retour</button></a>
              </div>
              <div class="col-xs-offset-8 col-xs-2">
                  <button type="submit" name="Submit"  class="btn btn-primary ">Modifier</button>
              </div>
            </div>
           </div>
        </fieldset>
        
        </p>
       
      </form>
        

  <div class="row">
           
      <div class="col-xs-12">
        <h4>Liste sorties</h4>
          <table id="Stock" border="1" width="100%" class="info"> 
            <thead>
               <tr>
               <!--<th><strong>Modif</strong></th>
               <th><strong>Supp</strong></th>-->
                  <th><strong>Id</strong></th>
                  <th><strong>Désignation</strong></th>
                  <th><strong>Ref Comm</strong></th>
                  <th><strong>Date</strong></th>
                  <th><strong>Qte</strong></th>
                  <th><strong>Lar</strong></th>
                  <th><strong>Epais</strong></th>
                 
               </tr>
            </thead>
            <tbody>
            <?php
                                  
    $sqlquery3="SELECT * FROM CONTENIR_CO  WHERE ID_A='$_ID_A' ";
    $result3=mysqli_query($link,$sqlquery3);
    while($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
            {
              ?>
              <tr>
                 <td><?php echo $row['ID_A']?></td>
                 <td><?php echo $row['DESIGNATION']?></td>
                                     
    <?php
      $comm=$row3['ID_CO'];
      $sqlquery5="SELECT * FROM COMMANDE  WHERE ID_CO='$comm' ";
      $result5=mysqli_query($link,$sqlquery5);
      $row5= mysqli_fetch_array($result5,MYSQLI_ASSOC)
      ?>
                 <td><?php echo $row5['REF_CO']?></td>
                 <td><?php echo $row5['DATE_CO']?></td>
                 <td><?php echo $row3['QTE_CO']?></td>
                 <td><?php echo $row['LARGEUR']?></td>
                 <td><?php echo $row['EPAISSEUR']?></td>
                 <?php
                   }
                   ?>
              </tr>
            </tbody>
          </table>
       </div>
  </div>
  <div class="row">
     <div class="col-xs-12">
        <h4>Liste entrées</h4>
        <table id="Stock" border="1" width="100%" class="INFO"> 
            <thead>
              <tr>
               <!--<th><strong>Modif</strong></th>
               <th><strong>Supp</strong></th>-->
                  <th><strong>Id</strong></th>
                  <th><strong>Désignation</strong></th>
                  <th><strong>Ref Liv</strong></th>
                  <th><strong>Date</strong></th>
                  <th><strong>Qte</strong></th>
                  <th><strong>Lar</strong></th>
                  <th><strong>Epais</strong></th>
                 
              </tr>
            </thead>
            <tbody>
              <?php         
    $sqlquery4="SELECT * FROM CONTENIR_BON_L  WHERE ID_A='$_ID_A' ";
    $result4=mysqli_query($link,$sqlquery4);
     while($row4=mysqli_fetch_array($result4,MYSQLI_ASSOC))
            {
              ?>
              <tr>
                 <td><?php echo $row['ID_A']?></td>
                 <td><?php echo $row['DESIGNATION']?></td>
                 
    <?php
      $liv=$row4['ID_BONL'];
      $sqlquery6="SELECT * FROM LIV_BON  WHERE ID_BONL='$liv' ";
      $result6=mysqli_query($link,$sqlquery6);
      $row6= mysqli_fetch_array($result6,MYSQLI_ASSOC)
      ?>
                 <td><?php echo $row6['REF_LIV']?></td>
                 <td><?php echo $row6['DATE_BONL']?></td>
                 <td><?php echo $row4['QTE_BON_L']?></td>
                 <td><?php echo $row['LARGEUR']?></td>
                 <td><?php echo $row['EPAISSEUR']?></td>
                 <?php
                   }
                   ?>
                   </tr>
                </tbody>
           </table>
        </div>
  </div>
 </div>  

       </div>
          <script> $(document).ready(function() {
              $('.selectpicker').selectpicker();
              });
              
$('#TX').on('click',calcultarif());
$('#QTE').on('click',calculquantite());
$('#select-type').on('click',type());
$('#select-famille').on('click',famille());

          </script>  
  
<?php 
include('../modeles/pied.php'); ?>