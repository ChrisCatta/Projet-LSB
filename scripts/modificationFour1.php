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
    bar_fournisseur(4);
    echo ' </div> 

    <div class="col-xs-9 ">'; 

    foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
    $sqlquery="select * FROM FOURNISSEUR WHERE ID_F='$_ID_F'";
    $result=mysqli_query($link,$sqlquery);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
      ?> 
  
  
 
      <form name="form1" method="post" action="modificationFour2.php" class="well3" >
        
        <p>
           <div class="row">
            <div class="col-xs-2">
              <img src="../images/modifFour.PNG" class="img-circle" width="100" heigth="100">
            </div>
            <div class="col-xs-10">
            <legend><h1>Modification d'un utilisateur<h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">Raison Sociale / Nom</label>
      <div class="col-xs-4">
      <?php echo '<input pattern=".{3,30}" required title="La raison sociale contient minimum 3 caractères et maximum 30 caractères." name="RAISSO_F" id="texte" class="form-control" maxlength="30" value="'.$row['RAISSO_F'].'">';?>
      </div>
      <label for="texte" class="col-xs-2">Tél.</label>
      <div class="col-xs-4">
      <?php echo '<input pattern=".{10,10}"  title="Le numéro de téléphone contient 10 numéros" name="TEL_F" id="texte" class="form-control " maxlength="10" value="'.$row['TEL_F'].'">';?>
      </div>
    </div>
    </div>
    <div class="row">
      <div class="form-group">

        <label for="texte" class="col-xs-2">E-mail</label>
        <div class="col-xs-4">
        <?php echo '<input type="email" name="EMAIL_F" id="texte" class="form-control " value="'.$row['EMAIL_F'].'"  maxlength="30">';?>
        </div>
        <label for="texte" class="col-xs-2">CIN</label>
        <div class="col-xs-4">
        <?php echo '<input type="texte" name="CIN" id="texte" class="form-control " value="'.$row['CIN'].'"  maxlength="30">';?>
        </div>
       </div>
    </div>
    <div class="row">
      <div class="form-group">

        <label for="texte" class="col-xs-2">NIF</label>
        <div class="col-xs-4">
        <?php echo '<input type="email" name="NIF_F" id="texte" class="form-control " value="'.$row['NIF_F'].'"  maxlength="30">';?>
        </div>
        <label for="texte" class="col-xs-2">STAT</label>
        <div class="col-xs-4">
        <?php echo '<input type="texte" name="STAT_F" id="texte" class="form-control " value="'.$row['STAT_F'].'"  maxlength="30">';?>
        </div>
       </div>
    </div>
    <div class="row">
      <div class="form-group">
        <label for="textarea" class="col-xs-2">Adresse</label>
          <div class="col-xs-6">
          <?php echo '<textarea  id="textarea" name="ADRESSE_F" class="form-control" cols="50" rows="4" maxlength="100" >'.$row['ADRESSE_F'].'</textarea>';?>
          </div>

    </div>
    </div>

<div class="row">
           
            <div class="col-xs-12">
            <legend></legend>
          </div>
           </div>


    <div class="row">
       <div class="form-group">
          
     
      <div class="col-xs-1">
      <?php echo '<input type="hidden" name="ID_F" id="texte" class="form-control" maxlength="30" value="'.$row['ID_F'].'">';?>
      </div>
     
       </div>
    </div>
   
    <div class="form-group">
      <div class="col-xs-2">
       <a href="listefournisseur.php"><button class="btn btn-primary" type="button">Retour</button></a>
    </div>
       <div class="col-xs-offset-8 col-xs-2">
      <button type="submit" name="Submit" value="Modifier" class="btn btn-primary ">Modifier</button>
    </div>
    </div>
    </fieldset>
        
        </p>
       
      </form>
       </div>
     </div>

    
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>