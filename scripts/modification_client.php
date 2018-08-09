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
    bar_client();
    echo ' </div> 

    <div class="col-xs-9 well3 ">'; 
    
    $sqlquery="select ID_C, RAISSO_C FROM CLIENT";
    $result=mysqli_query($link,$sqlquery);
      ?> 
  
  
 
      <form name="form1" method="post" action="modification_client1.php" class="well2">
        
        <p>
           <div class="row">
            <div class="col-xs-1">
              <img src="../images/modiclient.PNG" class="img-circle">
            </div>
            <div class="col-xs-offset-1 col-xs-10">
            <legend><h1>Modification d'un Client<h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
       <div class="form-group">
          <label for="select" class="col-xs-4">Le Client à modifier</label>
          <div class="col-xs-8">
          <select id="select" name="modifclient" class="form-control ">
          <?php
          while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
          {
            echo '<option value="'.$row['ID_C'].'"> '.$row['ID_C'].'  - '.$row['RAISSO_C'].'</option>';
          }
          ?>
         
        
      </select>
      </div>
    </div>
  </div>
      <input type="submit" name="Submit" value="Suivant" class=" pull-right btn btn-primary">
    </div>
    </fieldset>
        
        </p>
      </form>
       </div>
     </div>
<?php 
include('../modeles/pied.php'); ?>