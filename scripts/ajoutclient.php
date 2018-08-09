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
    bar_client(2);
    echo ' </div> 

    <div class="col-xs-9">';   ?> 
  
  
 
      <form name="form1" method="post" action="enregistrer_client.php" class="well3" >
        
        <p>
           <div class="row">
            <div class="col-xs-2">
              <img src="../images/c.PNG" class="img-circle ">
            </div>
            <div class="col-xs-10">
            <legend><h1>Ajout d'un Client<h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">Raison Sociale / Nom</label>
      <div class="col-xs-4">
      <input pattern=".{3,30}" required title="La raison sociale contient minimum 3 caractères et maximum 30 caractères." name="RAISSO_C" id="texte" class="form-control" maxlength="30">
      </div>
    </div>
    </div>
    <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">Tél.</label>
      <div class="col-xs-4">
      <input pattern=".{10,13}"  title="Le numéro de téléphone contient 10 numéros" name="TEL_C" id="texte" class="form-control " maxlength="10">
      </div>

      <label for="texte" class="col-xs-2">E-mail</label>
      <div class="col-xs-4">
      <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  name="EMAIL" id="texte" class="form-control " >
      </div>
     </div>
    </div>
    <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">NIF.</label>
      <div class="col-xs-4">
      <input pattern=".{0,30}"  title="Le Nif contient xx numéros" name="NIF" id="texte" class="form-control " maxlength="30">
      </div>
      <label for="texte" class="col-xs-2">STAT.</label>
      <div class="col-xs-4">
      <input pattern=".{0,30}"  title="Le Stat contient xx numéros" name="STAT" id="texte" class="form-control " maxlength="30">
      </div>
     </div>
    </div>
    <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">RC.</label>
      <div class="col-xs-4">
      <input pattern=".{0,30}"  title="Le RC contient xx numéros" name="RC" id="texte" class="form-control " maxlength="30">
      </div>
      <label for="texte" class="col-xs-2">CIF.</label>
      <div class="col-xs-4">
      <input pattern=".{0,30}"  title="Le CIF contient xx numéros" name="CIF" id="texte" class="form-control " maxlength="30">
      </div>
     </div>
    </div>
        <div class="row">
       <div class="form-group">
        <label for="textarea" class="col-xs-2">Adresse</label>
      <div class="col-xs-6">
      <textarea  id="textarea" name="ADRESSE_C" class="form-control" cols="50" rows="4" maxlength="100" ></textarea>
      </div>

      
    </div>
    </div>
 <div class="form-group">
      <div class="col-xs-2">
       <input type="reset" name="Submit" value="Réinitialiser" class=" btn btn-primary">
    </div>
      <div class="col-xs-offset-8 col-xs-2">
      <input type="submit" name="Submit" value="Ajouter" class=" btn btn-primary">
    </div>
    </fieldset>
        
        </p>
      
      </form>
       </div>
     </div>
<?php 
include('../modeles/pied.php'); ?>