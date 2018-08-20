<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>
<script type="text/javascript">
            $(document).ready(function(){
                  chargerCategories();
                  chargerFamille(1);
                  chargerListeDevType(1);
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
    bar_sortie();
?>
    </div>  
    <div class="col-xs-9 well3">
        <?php
   $ID_DV=$_POST['ID_DV'];
   $sqlquery1="SELECT *
              FROM DEVIS 
              WHERE  ID_DV='$ID_DV'   ";
   $result1=mysqli_query($link,$sqlquery1);
   $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
   
   ?>
                              <div class="row ">
                                    <div class="col-xs-12"> 

                                  <input type="hidden" id="iddv" name="iddv" value="<?php echo $row1['ID_DV']?>"/>
                                      <h2 class="text-center">
                                      <strong><img src="../images/ajoutcommande.PNG" width="100" heigth="100" class="img-circle">&nbsp;&nbsp;&nbsp;Liste Des lignes de devis</strong>
                                      </h2> 
                                     </div>
                              </div>
                              <div class="row">
                                <div class=" col-xs-6 ">Devis N° :  <em class="ligneCommande"><?=$row1['ID_DV']?></em> </div>
                                <div class=" col-xs-6">Date :  <em class="ligneCommande"><?=$row1['DATE_DV'].' - '.$row1['REF_DV']?></em> </div>
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

              List articles :
                <div  id="div-list-dev">
                 </div>
      
              Liste livraison articles :
                <div  id="div-dev-art">
                 </div>
              
          </div>
      </div>     
       
     <!-- <div class="row">
     <div class="form-group">
            <div class="col-xs-2">
                  <button id="ajouter" type="button" name="idDV" value="Ajouter" onclick="afficheDevis(<?=$row1['ID_DV']?>)" class=" pull-left btn btn-primary">Ajouter</button>
            </div>
            <div class="col-xs-offset-8 col-xs-2">
                <button type="submit" name="Submit" value="Valider" class=" btn btn-primary">Valider</button> 
            </div>
        </div>
        </div>
      </form>-->
 
    <!--Div de la fonction panel_tab-->
    </div>
<script type="text/javascript">
  var idDV='<?=$row1['ID_DV']?>';
  afficheDevis(idDV);
  </script>
  
<?php 
include('../modeles/pied.php'); ?>