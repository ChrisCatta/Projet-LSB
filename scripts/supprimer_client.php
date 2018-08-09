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
    bar_client(3);
    echo ' </div> 

    <div class="col-xs-9 ">'; 
    
    $sqlquery="select ID_C, RAISSO_C FROM CLIENT";
    $result=mysqli_query($link,$sqlquery);
      ?> 
  
  
 
      <form name="form1" method="post" action="client_effacer.php" class="well3">
        
        <p>
           <div class="row">
            <div class="col-xs-2">
              <img src="../images/supclient.PNG" class="img-circle">
            </div>
            <div class="col-xs-10">
            <legend><h1>Suppression d'un Client</h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
       <div class="form-group">
          <label for="select" class="col-xs-4">Le client à supprimer</label>
          <div class="col-xs-8">
          <select id="select" name="supprimerclient" class="selectpicker">
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
  <div class="row">
    <div class="col-xs-offset-10 col-xs-2">
      <input type="submit" name="Submit" value="Supprimer" class=" btn btn-primary">
    </div>
    </div>
    </div>
    </fieldset>
        
        </p>
      </form>
       </div>
     </div>

   <script> 
   $(document).ready(function() {
  $('.selectpicker').selectpicker();
});
</script>   
<?php 
include('../modeles/pied.php'); ?>