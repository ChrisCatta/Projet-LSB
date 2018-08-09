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
   if($c==1)
   {
   include('../modeles/bar_menu.php'); 
    bar_administration(2);
     ?> 
       </div> 
       <div class="col-xs-9 well3"> 
           <form name="form1" method="post" action="enregistrer_utilisateur.php" onSubmit="return verification()">
        
        <p>
           <div class="row">
            <div class="col-xs-2">
              
               <img src="../images/ajout.PNG" class="img-circle" width="100" heigth="100">
            </div>
            <div class=" col-xs-10">
            <legend><h1>Ajout d'un utilisateur<h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">Nom</label>
      <div class="col-xs-4">
       
      <input pattern=".{3,30}" required title="Un nom contient minimum 3 caractères et maximum 30 caractères." name="NOM" id="texte" class="form-control" >
      </div>
      <label for="texte" class="col-xs-2">Prenom</label>
      <div class="col-xs-4">
      <input pattern=".{3,30}" required title="Un Prenom contient minimum 3 caractères et maximum 30 caractères." name="PRENOM" id="texte" class="form-control " maxlength="30">
      </div>
    </div>
    </div>
    <div class="row">
    <div class="form-group">

      <label for="texte" class="col-xs-2">Date de Naissance</label>
      <div class="col-xs-4">
      <input type="date" name="DATENAIS" id="texte" class="form-control " >
      </div>

      <label for="select" class="col-xs-2">Sexe</label>
      <div class="col-xs-4">
      <select id="select" name="SEXE" class="form-control ">
        <option value="F">Femme</option>
        <option value="M">Homme</option>
        
      </select>
    </div>
     </div>
    </div>
        <div class="row">
       <div class="form-group">
        <label for="textarea" class="col-xs-2">Adresse</label>
      <div class="col-xs-4">
      <textarea  id="textarea" name="ADRESSE" class="form-control" cols="50" rows="4" maxlength="100" ></textarea>
      </div>

      <label for="texte" class="col-xs-2">Tel</label>
      <div class="col-xs-4">
      <input pattern=".{10,10}" required title="Un numéro de téléphone  doit contenir 10 numéros." name="TEL1" id="texte" class="form-control " maxlength="10">
      </div>
    </div>
    </div>

<div class="row">
           
            <div class="col-xs-1é">
            <legend></legend>
          </div>
           </div>


    <div class="row">
       <div class="form-group">
          <label for="select" class="col-xs-1">Catégorie</label>
          <div class="col-xs-3">
          <select id="select" name="SERVICE" class="form-control ">
          <option value="ADMINISTRATION">Administration</option>
          <option value="EMPLOYE">Employé</option>
        
      </select>
      </div>
      <label for="texte" class="col-xs-1">Login</label>
      <div class="col-xs-3">
      <input pattern=".{3,10}" required title="Un login contient minimum 3 caractères et maximum 10 caractères." name="LOGIN" id="texte" class="form-control" maxlength="30">
      </div>
      <label for="PW" class="col-xs-1">password</label>
      <div class="col-xs-3">
      <input pattern=".{5,20}" required title="Un Mot de passe contient minimum 5 caractères et maximum 20 caractères." name="PW" id="PW" class="form-control" maxlength="30">
      </div>
       </div>
    </div>
   
    <div class="form-group">
      <div class="col-xs-2">
       <input type="reset" name="Submit" value="Réinitialiser" class=" pull-right btn btn-primary">
    </div>
      <input type="submit" name="Submit" value="Ajouter" class=" pull-right btn btn-primary">
    </div>
    </fieldset>
        
        </p>
         <script language="javascript" type="text/javascript">
                            function verification()
                            {
                             
                                if(document.forms["form1"].elements["DATENAIS"].value=="")
                                {
                                  alert("Vous avez laissez le champs de la date de naissance vide");
                                  return false;

                                }
                                if(document.forms["form1"].elements["ADRESSE"].value=="")
                                {
                                  alert("Vous avez laissez le champs de l'Adresse vide");
                                  return true;

                                }
                                else 
                                {
                                  return true;
                                }
                            }
                          </script>
      </form>
       </div>
     </div>

     <?php
   }?>
     
<?php 
include('../modeles/pied.php'); ?>