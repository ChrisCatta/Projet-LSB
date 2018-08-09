<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>

<!--div class="row">
  <div class="col-xs-offset-2 col-xs-8">
      <h3>Système de gestion des stages</h3>
      </div>
    </div-->
    <div class="row">
      <div class="col-xs-2">
      

    <?php
  include('../scripts/connexionDB.php');
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
  
    include('../modeles/bar_menu.php'); 
    bar_entree(2);
    echo ' </div> 

    <div class="col-xs-8  ">'; 
    
    $sqlquery="select * FROM liv_bon";
    $result=mysqli_query($link,$sqlquery);
      ?> 
  
  
 
      <form name="form1" method="post" action="modifier_livraison.php" class="well3">
        
       
           <div class="row">
            <div class="col-xs-2">
              <img src="../images/ajoutcommande.PNG" width="100" heigth="100" class="img-circle">
            </div>
            <div class="col-xs-10">
              <legend><h1>Choix de la Livraison</h1></legend>
            </div > 
           </div>
            
    <fieldset>
      <div class="row">
          <div class="col-xs-5">
            <label for="select" >Choisir la livraison </label>
          </div>
          <div class="col-xs-7">
            <select id="select" name="ID_BONL" class="select-menu ui-widget ui-widget-content ui-corner-all">
              <?php
              while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
              {
                echo '<option value="'.$row['ID_BONL'].'"> '.$row['ID_BONL'].'  - '.$row['REF_LIV'].'</option>';
              }
              ?>
            </select>
          </div>
    </div>
    </fieldset>
    <div class="row">
       <button type="submit" name="modifier" value="modifier" class=" pull-right btn btn-primary">Modifier</button></a>
    
       
    </div>
        
        </p>
      </form>
       </div>
     </div>

     </div>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>