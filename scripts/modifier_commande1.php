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

    <div class="col-xs-9">'; 
    $ID_CO=$_POST['ID_CO'];
    $sqlquery="select  * FROM  COMMANDE WHERE ID_CO=$ID_CO";
     
   $result=mysqli_query($link,$sqlquery);
   $row=mysqli_fetch_array($result);
      ?> 
  
  
 
      <form name="form1" method="post" action="modifier_commande2.php" class="well3" ">
        
        <p>
           <div class="row">
            <div class="col-xs-2">
              <img src="../images/livraison.JPG" width="100" heigth="100" class="img-circle">
            </div>
            <div class=" col-xs-10">
            <legend><h1>Modifier une commande<h1></legend>
          </div>
           </div>
            
    <fieldset>




<div class="row">
       <div class="form-group">
       <label for="texte" class="col-xs-4">Réference commande</label>
      <div class="col-xs-6">
         <input  type="text" value="<?=$row['REF_CO']?>" class="form-control" name="REF_CO" maxlength="30">
      
      </div>

    </div>
  </div>
  


  <div class="row">
       <div class="form-group">
        <label for="texte" class="col-xs-4">Date de la commande</label>
      <div class="col-xs-6">
          <?php
     echo' <input type="date" name="DATE_CO" id="texte" class="form-control " id="datepicker" min="'.date('d').'/'.date('m').'/'.date('Y').'" value="'.$row['DATE_CO'].'">';
       
      ?>
      </div>
       </div>
   </div>
<input type="hidden" name="ID_CO" value="<?=$row['ID_CO']?>">
      <button type="submit" name="Submit" value="Modifier" class=" pull-right btn btn-primary">Modifier</button>
     

    </div>
  </div>

    
    </fieldset>
        
        </p>
        
      </form>
       </div>
     </div>

<?php 
include('../modeles/pied.php'); ?>