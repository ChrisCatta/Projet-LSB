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
    bar_client(4);
    echo ' </div> 

    <div class="col-xs-9 ">'; 

    foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
    $sqlquery="select * FROM CLIENT WHERE ID_C='$_ID_C'";
    $result=mysqli_query($link,$sqlquery);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
      ?> 
  
  
 
      <form name="form1" method="post" action="modification_client2.php" class="well3" >
        
        <p>
           <div class="row">
            <div class="col-xs-1">
              <img src="../images/modiclient.PNG" class="img-circle">
            
            </div>
            <div class="col-xs-10">
            <legend><h1>Modification d'un Client<h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">Raison Sociale / Nom</label>
      <div class="col-xs-4">
      <input pattern=".{3,30}" required title="La raison sociale contient minimum 3 caractères et maximum 30 caractères." name="RAISSO_C" id="texte" class="form-control" maxlength="30" value="<?=$row['RAISSO_C']?>">
      </div>
    </div>
    </div>
    <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">Tél.</label>
      <div class="col-xs-4">
      <input pattern=".{10,10}"  title="Le numéro de téléphone contient 10 numéros" name="TEL_C" id="texte" class="form-control " maxlength="10" value="<?=$row['TEL_C']?>">
      </div>
      <label for="texte" class="col-xs-2">E-mail</label>
      <div class="col-xs-4">
     <input type="email" name="EMAIL" id="texte" class="form-control " value="<?=$row['EMAIL']?>" maxlength="30">
      </div>
     </div>
    </div>
    <div class="row">
    <div class="form-group">
    <label for="texte" class="col-xs-2">NIF.</label>
      <div class="col-xs-4">
      <input   title="Le Nif contient xx numéros" name="NIF" id="texte" class="form-control " maxlength="30" value="<?=$row['NIF']?>">
      </div>
    <label for="texte" class="col-xs-2">STAT.</label>
      <div class="col-xs-4">
      <input  title="Le Stat contient xx characteres" name="STAT" id="texte" class="form-control " maxlength="30" value="<?=$row['STAT']?>">
      </div>
     </div>
    </div>
    <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">RC.</label>
      <div class="col-xs-4">
      <input pattern=".{0,30}"  title="Le RC contient xx numéros" name="RC" id="texte" class="form-control " maxlength="30" value="<?=$row['RC']?>">
      </div>
      <label for="texte" class="col-xs-2">CIF.</label>
      <div class="col-xs-4">
      <input pattern=".{0,30}"  title="Le CIF contient xx numéros" name="CIF" id="texte" class="form-control " maxlength="30" value="<?=$row['CIF']?>">
      </div>
     </div>
    </div>
        <div class="row">
       <div class="form-group">
        <label for="textarea" class="col-xs-2">Adresse</label>
      <div class="col-xs-6">
      <textarea  id="textarea" name="ADRESSE_C" class="form-control" cols="50" rows="4" maxlength="100" ><?= $row['ADRESSE_C'] ?></textarea>
      </div>
        
      <label for="texte" class="col-xs-2">Adresse1</label>
      <div class="col-xs-4">
      <input    name="ADRESSE1_C" id="texte" class="form-control " maxlength="150" value="<?= $row['ADRESSE1_C']?>">
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
      <?php echo '<input type="hidden" name="ID_C" id="texte" class="form-control" maxlength="30" value="'.$row['ID_C'].'">';?>
      </div>
     
       </div>
    </div>
   
    <div class="form-group">
      <div class="col-xs-2">
       <a href="listclient.php"><button class="btn btn-primary" type="button">Retour</button></a>
    </div>
      <div class="col-xs-offset-8 col-xs-2">
      <button type="submit" name="Submit" value="Modifier" class="btn btn-primary ">Modifier</button>
    </div>
    </fieldset>
        
        </p>
       
      </form>
       </div>
     </div>
<?php 
include('../modeles/pied.php'); ?>