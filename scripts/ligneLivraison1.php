<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>
<script  type="text/javascript">
  $(document).ready(function(){
                  chargerCategories();
                  chargerFamille(1);
                  chargerListeLivraisonType(1);
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
    bar_entree();
    ?>
</div> 

    <div class="col-xs-9 ">
    <?php
   $ID_BONL=$_POST['ID_BONL'];
   $sqlquery="SELECT * FROM LIV_BON  WHERE  ID_BONL='$ID_BONL'   ";
   $result=mysqli_query($link,$sqlquery);
   $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
   
   ?>
   <div class="well3">
                              <div class="row ">
                                    <div class="col-xs-12"> 

                                    <input type="hidden" id="idbl" value="<?php echo $row['ID_BONL']?>"/>
                                      <h2 class="text-center">
                                      <strong><img src="../images/ajoutcommande.PNG" width="100" heigth="100" class="img-circle">&nbsp;&nbsp;&nbsp;Liste Des lignes de Livraison</strong>
                                      </h2> 
                                     </div>
                                  </div>
                              <div class="row">
                                <div class=" col-xs-6 ">Livraison :  <em class="ligneCommande"><?=$row['ID_BONL'].' - '.$row['TYPE_LIV']?></em> </div>
                                <div class=" col-xs-6">Date :  <em class="ligneCommande"><?=$row['DATE_BONL'].' - '.$row['REF_LIV']?></em> </div>
                              </div>
                                   <fieldset>
                                    <div class="row">
                                            <div class="col-xs-2">
                                                    Select Type :
                                            </div>
                                            <div class="col-xs-3">
                                                      <div id="div-type">
                                                      </div>
                                            </div>    
                                            <div class="col-xs-2">
                                                  Select Famille :
                                            </div>    
                                            <div class="col-xs-3">
                                                      <div id="div-famille">
                                                      </div>
                                              </div>
                                       </div>
                                  </fieldset>

      <div class="row">
          <div class="col-xs-12">
              List articles :
                <div  id="div-list-liv">
                 </div>
          </div>
      </div>     
      
    <form name="listArt" method="POST" action="update-liv.php">
      <div class="row">
          <div class="col-xs-10">
              List livraison articles :
                <div  id="div-liv-art">
                 </div>
          </div>
          </div>
          <div class="row">
     <div class="form-group">
        <div class="col-xs-2">
        <button id="ajouter" type="button" name="Ajouter" value="Ajouter" onclick="afficheLivraison(<?=$row['ID_BONL']?>)" class=" pull-left btn btn-primary">Ajouter</button>
        </div>
        <div class="col-xs-offset-8 col-xs-2">
        <button type="submit" name="Submit" value="Valider" class="btn btn-primary">Valider</button> 
      </div>
    </div>
     </div>
      </form>
    <!--Div de la fonction panel_tab-->
    </div>

<script>
  var idliv='<?=$row['ID_BONL']?>';
  afficheLivraison(idliv);
  </script>
<?php
include('../modeles/pied.php'); ?>