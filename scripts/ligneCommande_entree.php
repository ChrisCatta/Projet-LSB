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
    
    bar_sortie();
    echo ' </div> 

    <div class="col-xs-9  ">'; 
    
    $sqlquery="select ID_CO, REF_CO  FROM COMMANDE";
    $result=mysqli_query($link,$sqlquery);
      ?> 
  
  
 
      <form name="form1" method="post" action="ligneCommande1.php" class="well3">
        
        <p>
           <div class="row">
            <div class="col-xs-1">
              <img src="../images/ajoutcommande.PNG" width="100" heigth="100" class="img-circle">
            </div>
            <div class="col-xs-offset-1 col-xs-10">
            <legend><h1>Choix de la commande<h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
          <div class="col-xs-5">
            <label for="select" >La commande </label>
          </div>
          <div class="col-xs-7">
            <select id="select" name="ID_CO" class="select-menu ui-widget ui-widget-content ui-corner-all">
              <?php
              while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
              {
                echo '<option value="'.$row['ID_CO'].'"> '.$row['ID_CO'].'  - '.$row['REF_CO'].'</option>';
              }
              ?>
            </select>
          </div>
    </div>
    </fieldset>
  <div class="row">
   
    <div class="form-group">
      <div class="col-xs-offset-10 col-xs-2">
          <button type="submit" name="Submit"  class="btn btn-primary ">Suivant</button>
      </div>
    </div>
   </div>
        
        </p>
      </form>
       </div>
     </div>

<?php 
include('../modeles/pied.php'); ?>