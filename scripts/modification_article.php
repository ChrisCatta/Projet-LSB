<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>

    <div class="row">
      <div class="col-xs-3 ">
      

    <?php
    include('../scripts/connexionDB.php');
    $retour=connexion();
//$c=$retour[0];
$link=$retour[0];
    include('../modeles/bar_menu.php'); 
    bar_stock(4);
    echo ' </div> 

    <div class="col-xs-9 well3">'; 
    
      ?> 
  
           <div class="row">
              <div class="col-xs-2">
                <img src="../images/modifarticle.PNG" class="img-circle" width="100" height="100">
              </div>
              <div class="col-xs-10">
              <legend><h1>Modification d'un Article</h1></legend>
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
                                          List articles :
                                            <div  id="div-list-art">
                                             </div>
                                      </div>
                                  </div>     
    </div>
    </fieldset>
        
       </div>
     </div>


  <script type="text/javascript">
                   $(document).ready(function(){
                  chargerCategories();
                  chargerFamille(1);
                  });
                 </script>         
<?php 
include('../modeles/pied.php'); ?>