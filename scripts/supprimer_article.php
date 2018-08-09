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
    bar_stock(3);
    echo ' </div> 

    <div class="col-xs-9">'; 
    
    $sqlquery="SELECT ID_A, DESIGNATION FROM ARTICLE";
    $result=mysqli_query($link,$sqlquery);
      ?> 
  
  
 
      <form name="form1" method="post" action="supprimer_article1.php" class="well3">
        
        <p>
           <div class="row">
            <div class="col-xs-1">
              <img src="../images/suparticle.JPG" class="img-circle" width="100" height="100">
            </div>
            <div class="col-xs-offset-1 col-xs-10">
            <legend><h1>Suppression d'un Article<h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
       <div class="form-group">
          <label for="select" class="col-xs-4">L'Article à Supprimer</label>
          <div class="col-xs-8">
          <select id="select" name="ID_A" class="form-control ">
          <?php
          while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
          {
            echo '<option value="'.$row['ID_A'].'"> '.$row['ID_A'].'  - '.$row['DESIGNATION'].'</option>';
          }
          ?>
         
        
      </select>
      </div>
    </div>
  </div>
      <input type="submit" name="Submit" value="Supprimer" class=" pull-right btn btn-primary">
    </div>
    </fieldset>
        
        </p>
      </form>
       </div>
     </div>

<?php 
include('../modeles/pied.php'); ?>