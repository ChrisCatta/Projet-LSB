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
    bar_client(5);
    echo ' </div> 

    <div class="col-xs-9  ">';   ?> 
  
  <div id="tabs">
  <ul>
    <li><a href="#tabs-1">Recherche Par Identifiant</a></li>
    <li><a href="#tabs-2">Recherche Détaillée</a></li>
  </ul>
  <div id="tabs-1">
   <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    <form name="form1" method="post" action="RechercheClientResultat.php" class="well3">
        
        <p>
           <div class="row">
            <div class="col-xs-2">
              <img src="../images/RechercheClient.PNG" class="img-circle" width="100" heigth="100">
            </div>
            <div class="col-xs-10">
            <legend><h1>Recherche Par Identifiant</h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
    <div class="form-group">
      <label for="texte1" class="col-xs-2">Identifiant </label>
      <div class="col-xs-8">
      <input type="text" name="ID_C" id="texte" class="form-control" >
      </div>
      
    </div>
    </div>
   
   
      <div class="row">
    <div class="form-group">
      <div class="col-xs-offset-10 col-xs-2">
      
      <input type="submit" name="Submit" value="Rechercher" class=" btn btn-primary">
      <input type="hidden" name="PAGE" value="1">
    </div>
    </div>
    </div>
    </fieldset>
        
        </p>
      </form>
    <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
  </div>
  <div id="tabs-2">
    <form name="form1" method="post" action="RechercheClientResultat.php" class="well3">
        
        <p>
           <div class="row">
            <div class="col-xs-2">
              <img src="../images/RechercheClient.PNG" class="img-circle" width="100" heigth="100">
            </div>
            <div class="col-xs-10">
            <legend><h1>Recherche Détaillée</h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">Raison Sociale / Nom</label>
      <div class="col-xs-4">
      <input type="text" name="RAISSO_C" id="texte" class="form-control" maxlength="30">
      </div>
    </div>
    </div>
    <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">Tél.</label>
      <div class="col-xs-4">
      <input type="tel" name="TEL_C" id="texte" class="form-control " maxlength="10">
      </div>

      <label for="texte" class="col-xs-2">E-mail</label>
      <div class="col-xs-4">
      <input type="email" name="EMAIL" id="texte" class="form-control " >
      </div>
     </div>
    </div>
    <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">Nif.</label>
      <div class="col-xs-4">
      <input type="tel" name="NIF" id="texte" class="form-control " maxlength="10">
      </div>
      <label for="texte" class="col-xs-2">Stat.</label>
      <div class="col-xs-4">
      <input type="tel" name="STAT" id="texte" class="form-control " maxlength="10">
      </div>
     </div>
    </div>
        <div class="row">
       <div class="form-group">
        <label for="textarea" class="col-xs-2">Adresse</label>
      <div class="col-xs-6">
      <textarea  id="textarea" name="ADRESSE_C" class="form-control" cols="50" rows="4" maxlength="100"></textarea>
      </div>

      
    </div>
    </div>
   
        <div class="row">
    <div class="form-group">
      <div class="col-xs-offset-10 col-xs-2">
      <input type="submit" name="Submit" value="Rechercher" class="btn btn-primary">
      <input type="hidden" name="PAGE" value="2">
    </div>
    </fieldset>
        
        </p>
      </form>
  </div>
  </div>     
     </div>
    </div>
  <?php 
include('../modeles/pied.php'); ?>