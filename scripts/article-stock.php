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
    bar_stock(4);
    echo ' </div> 

    <div class="col-xs-9">';  
 
    $_ID_A=$_POST['ID_A'];
    $sqlquery="select * FROM ARTICLE  WHERE ID_A='$_ID_A' ";
    $result=mysqli_query($link,$sqlquery);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
  if($row['CHEMIN_IMG']== NULL)
    {
      $row['CHEMIN_IMG']='../images/pasimage.PNG';
    }
     ?> 
  
  
 
      <div class="row">
            <div class="col-xs-2 ">
              <img src="../images/modifarticle.PNG" class="img-circle" width="100" height="100">
            </div>
            <div class="col-xs-8 table-responsive">
              <legend><h1>Stock d'un Article</h1></legend>
            </div>
            <div class="col-xs-2">
              <img src="<?=$row['CHEMIN_IMG']?>" class="img-circle" width="100" height="100">
            </div>
      </div>
            
         <fieldset>
          <div class="row">
             <div class="form-group">
                <label for="select" class="col-xs-2">Désignation</label>
                  <div class="col-xs-4">
                     <input  pattern=".{3,30}" required title="La désignation contient minimum 3 caractères et maximum 30 caractères." class="ui-widget ui-widget-content ui-corner-all" name="DESIGNATION" maxlength="30" value="<?=$row['DESIGNATION']?>" disabled/>
                       
                  </div>
             </div>
          </div>
          <div class="row">
             <div class="form-group">
                <label  class="col-xs-2">Type</label>
                  <div class=" col-xs-4">
                    <input type"text"  class="ui-widget ui-widget-content ui-corner-all"  value="<?=$row['TYPE']?>" disabled/>
                  </div>
                <label for="select" class="col-xs-2">Famille</label>
                  <div class="col-xs-4">
                      <input type"text" class="ui-widget ui-widget-content ui-corner-all"  value="<?=$row['FAMILLE']?>" disabled/>
              </div>
             </div>
          </div>
             <div class="row">
               <div class="form-group">
                  <label  class="col-xs-2">Quantité Stock</label>
                    <div class=" col-xs-4">
                        <input  name="QTE_STO"  class="ui-widget ui-widget-content ui-corner-all"  value="<?=$row['QTE_STO']?>" disabled/>
                    </div>

                  <label  class="col-xs-2">Quantité Seuil</label>
                    <div class="col-xs-4">
                      <input   name="QTE_MIN"   class="ui-widget ui-widget-content ui-corner-all"  value="<?=$row['QTE_MIN']?>" disabled />
                     </div>
                </div>
             </div>

             <div class="row">
                <div class="form-group">
                   <label  class="col-xs-2">Prix Unitaire</label>
                      <div class=" col-xs-4">
                        <input min="0" max="2000000000" maxlength="10"   class="ui-widget ui-widget-content ui-corner-all" name="PRIX_U"  value="<?=$row['PRIX_U']?>" disabled/>
                      </div>
                 <label  class="col-xs-2">Unité/Pqt</label>
               <div class=" col-xs-4">
                <input  min="0" max="200" " maxlength="10"   class="ui-widget ui-widget-content ui-corner-all" name="U_Pqt"  value="<?=$row['U_Pqt']?>" disabled="disabled">
               </div>
                   
                </div>
             </div>
             <div class="row">
                <div class="form-group">
                   <label  class="col-xs-2">Longueur</label>
                    <div class=" col-xs-4">
                      <input min="0" max="2000000000" step="0.1" maxlength="10"   class="ui-widget ui-widget-content ui-corner-all" name="LONGUEUR"  value="<?=$row['LONGUEUR']?>" disabled="disabled">
                    </div>
                   <label  class="col-xs-2">Largeur</label>
                     <div class=" col-xs-4">
                      <input  min="0" max="2000000000" maxlength="10"  class="ui-widget ui-widget-content ui-corner-all"  name="LARGEUR"  value="<?=$row['LARGEUR']?>" disabled="disabled">
                      </div>
                </div>
             </div>
             <div class="row">
             <div class="form-group">
                    <label  class="col-xs-2">Epaisseur</label>
             <div class=" col-xs-4">
             
             <input  min="0" max="2000000000" maxlength="10"  class="ui-widget ui-widget-content ui-corner-all"  name="EPAISSEUR"  value="<?=$row['EPAISSEUR']?>" disabled="disabled">
             </div>
               </div>
             </div>
        <div class="row">
           <div class="form-group">
              <div class="col-xs-1">
                <?php echo '<input type="hidden" name="ID_A" id="texte" class="form-control"  value="'.$row['ID_A'].'">';?>
                </div>
                 <div class="col-xs-1">
                        <?php echo '<input type="hidden" name="image" id="texte" class="form-control"  value="'.$row['CHEMIN_IMG'].'">';?>
                  </div>
           </div>
    </div>
 </fieldset>
 <hr>
        <div class="row">
              <div class="col-xs-12">
                  <h1>Mouvement de l'Article</h1>
              </div>
              <div class="col-xs-12">
      <table>
          <tr>
          <th>ID</th>
          <th>DESIGNATION</th>
          <th>DATE</th>
          <th>QTE</th>
        </tr>
      <?php
      $article=$row['ID_A'];
        $req="SELECT * FROM  contenir_bon_l  WHERE ID_A='$_ID_A'  ";
        if($res=mysqli_query($link,$req))
        {
            while($row1=mysqli_fetch_array($res))
            {
              if($row1['ID_BONL']!=""){
               $liv=$row1['ID_BONL'];
               $qte=$row1['QTE_BON_L'];
                $req2="SELECT * FROM LIV_BON WHERE ID_BONL='$liv' ";
                  if($res2=mysqli_query($link,$req2)){
                       $row2=mysqli_fetch_array($res2);
                       $date=$row2['DATE_BONL'];
                     }
                   }
               
      ?>
                      <tr>
                      <td>Entrées</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      </tr>
                      <tr>
                        <td><?=$row['ID_A']?></td>
                        <td><?=$row['DESIGNATION']?></td>
                        <td><?=$date?></td>
                        <td><?=$qte?></td>
                      </tr>
      <?php
                    
              }
      }
  $req="SELECT * FROM  contenir_co WHERE ID_A='$article'  ";
        if($res=mysqli_query($link,$req))
        {
            while($row1=mysqli_fetch_array($res))
            {
              if($row1['ID_CO']!=""){
               $liv=$row1['ID_CO'];
               $qte=$row1['QTE_CO'];
                $req2="SELECT * FROM COMMANDE WHERE ID_CO='$liv' ";
                  if($res2=mysqli_query($link,$req2)){
                       $row2=mysqli_fetch_array($res2);
                       $date=$row2['DATE_CO'];
                     }
                   }
               
      ?>
                      <tr>
                      <td>Sorties</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      </tr>
                      <tr>
                        <td><?=$row['ID_A']?></td>
                        <td><?=$row['DESIGNATION']?></td>
                        <td><?=$date?></td>
                        <td><?=$qte?></td>
                      </tr>
      <?php
                    
              }
      }
?>
      </table>
    </div>
</div>
 <div class="row">
      <div class="col-xs-12">
            <div class="form-group">
                      <div class="col-xs-2">
                       <a href="listearticle.php"><button class="btn btn-primary" type="button">Retour</button></a>
                      </div>
            </div>
       </div>
     </div>

  
<?php 
include('../modeles/pied.php'); ?>