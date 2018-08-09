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
    $ID_DV=$_POST['ID_DV'];
    $sqlquery="select  * FROM  DEVIS WHERE ID_DV=$ID_DV";
     
   $result=mysqli_query($link,$sqlquery);
   $row=mysqli_fetch_array($result);
      ?> 
  
  
 
      <form name="form1" method="post" action="modifier_devis2.php" class="well3" ">
        
        <p>
           <div class="row">
            <div class="col-xs-2">
              <img src="../images/livraison.JPG" width="100" heigth="100" class="img-circle">
            </div>
            <div class=" col-xs-10">
            <legend><h1>Modifier un devis<h1></legend>
          </div>
           </div>
            
    <fieldset>




<div class="row">
       <div class="form-group">
       <label for="texte" class="col-xs-4">Réference devis</label>
      <div class="col-xs-6">
         <input  type="text" value="<?=$row['REF_DV']?>" class="form-control" name="REF_DV" maxlength="30">
      
      </div>

    </div>
  </div>
  


  <div class="row">
       <div class="form-group">
        <label for="texte" class="col-xs-4">Date de la commande</label>
      <div class="col-xs-6">
          <?php
     echo' <input type="date" name="DATE_DV" id="texte" class="form-control " id="datepicker" min="'.date('d').'/'.date('m').'/'.date('Y').'" value="'.$row['DATE_DV'].'">';
       
      ?>
      </div>
       </div>
   </div>
<input type="hidden" name="ID_DV" value="<?=$row['ID_DV']?>">
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