<?php
session_start();
 include('../modeles/enteteAdmin.php');
 ?>
   <script type="text/javascript">
                   $(document).ready(function(){
                  chargerCategories();
                  chargerFamille(1);
                  chargerListeArticlesStock(1);
                  });
                 </script>      
    <div class="row">
      <div class="col-xs-3">
       <?php
        include('../modeles/bar_menu.php');
       include('../scripts/connexionDB.php');
          $retour=connexion();
          //$c=$retour[0];
          $link=$retour[0];  
        bar_stock();
       ?>
     </div> 
     <div class="col-xs-9 well3">
       <div class="row">
            <div class="col-xs-2 ">
              <img src="../images/modifarticle.PNG" class="img-circle" width="100" height="100"/>
            </div>
            <div class="col-xs-8 table-responsive">
              <legend><h1>Liste avec stock reel</h1></legend>
            </div>
            <div class="col-xs-2">
             
            </div>
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
                     <div  id="div-list-stock">
                      </div>
                    </div>
                </div>     
    </div>
    </div>
 
<?php 
include('../modeles/pied.php'); ?>