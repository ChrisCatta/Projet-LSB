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
    bar_sortie(1);
    echo ' </div> 

    <div class="col-xs-9 ">'; 
    
    $sqlquery="SELECT ID_C, RAISSO_C FROM CLIENT";
    $result=mysqli_query($link,$sqlquery);
      ?> 
  
  
 
      <form name="form1" method="post" action="SortieAjoutDevis1.php" class="well3">
       
           <div class="row">
            <div class="col-xs-1">
              <img src="../images/SortieAjout.PNG" width="100" heigth="100" class="img-circle">
            </div>
            <div class="col-xs-offset-1 col-xs-10">
            <legend><h1>Ajout d'un devis<h1></legend>
          </div>
           </div>
            
  <fieldset>
      <div class="row">
       <div class="form-group">
       	<label for="texte" class="col-xs-5">Réference du devis</label>
      <div class="col-xs-7">
      	 <input  pattern=".{1,30}" required title="La référence contient minimum 1 caractères et maximum 30 caractères." class="form-control" name="REF_DV" maxlength="30">
      
      </div>
          <label for="select" class="col-xs-5">Le Client </label>
          <div class="col-xs-7">
          <select id="select" name="ID_C" class="form-control ">
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
     <div class="form-group">
       	<label for="texte" class="col-xs-5">Date du devis</label>
      <div class="col-xs-7">
          <?php
             echo' <input type="date" name="DATE_DV" id="texte" class="form-control " min="'.date('Y').'-'.date('m').'-'.date('d').'" value="'.date('Y').'-'.date('m').'-'.date('d').'">';
               
          ?>
      </div>
    </div>
  </div>
 </fieldset>
  <div class="row">
    <div class="form-group">
      <div class="col-xs-offset-10 col-xs-2">
          <input type="submit" name="Submit" value="Valider" class=" btn btn-primary" />
      </div>
    </div>
  </div>
        
      </form>
  </div>
 </div>
<?php 
include('../modeles/pied.php'); ?>