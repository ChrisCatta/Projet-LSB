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
    bar_administration(4);
    echo ' </div> 

    <div class="col-xs-9 ">'; 

    foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
    $sqlquery="SELECT * FROM UTILISATEUR WHERE ID_USER='$_modifUti'";
    $result=mysqli_query($link,$sqlquery);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    echo $_modifUti;
      ?> 
   <form name="form1" method="post" action="modificationUti3.php" class="well3">
        
        <p>
           <div class="row">
            <div class="col-xs-2">
              
               <img src="../images/modif.PNG" class="img-circle" width="100" heigth="100">
              
            </div>
            <div class="col-xs-10">
            <legend><h1>Modification d'un utilisateur<h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">Nom</label>
      <div class="col-xs-4">
      <?php echo '<input pattern=".{3,30}" required title="Un nom contient minimum 3 caractères et maximum 30 caractères." name="NOM" id="texte" class="form-control" maxlength="30" value="'.$row['NOM'].'">';?>
      </div>
      <label for="texte" class="col-xs-2">Prenom</label>
      <div class="col-xs-4">
      <?php echo '<input pattern=".{3,30}" required title="Un prenom contient minimum 3 caractères et maximum 30 caractères." name="PRENOM" id="texte" class="form-control " maxlength="30" value="'.$row['PRENOM'].'">';?>
      </div>
    </div>
    </div>
    <div class="row">
    <div class="form-group">

      <label for="texte" class="col-xs-2">Date de Naissance</label>
      <div class="col-xs-4">
      <?php echo '<input type="date" name="DATENAIS" id="texte" class="form-control " value="'.$row['DATENAIS'].'">';?>
      </div>

      <label for="select" class="col-xs-2">Sexe</label>
      <div class="col-xs-4">
      <select id="select" name="SEXE" class="form-control " >
        <?php
        if($row['SEXE']=='F')
        {
          echo ' <option value="F">Femme</option>
        <option value="M">Homme</option>';
        }
        else
        {
          echo ' <option value="M">Homme</option>
                 <option value="F">Femme</option>';
        }
        ?>
       
        
      </select>
    </div>
     </div>
    </div>
        <div class="row">
       <div class="form-group">
        <label for="textarea" class="col-xs-2">Adresse</label>
      <div class="col-xs-4">
      <?php echo '<textarea  id="textarea" name="ADRESSE" class="form-control" cols="50" rows="4" maxlength="100" >'.$row['ADRESSE'].'</textarea>';?>
      </div>

      <label for="texte" class="col-xs-2">Tel</label>
      <div class="col-xs-4">
      <?php echo '<input pattern=".{10,10}" required title="Un numéro de téléphone doit contenir 10 chiffres." name="TEL1" id="texte" class="form-control " maxlength="10" value="'.$row['TEL1'].'">';?>
      </div>
        <label for="LOGIN" class="col-xs-2">LOGIN</label>
      <div class="col-xs-4">
      <?php echo '<input type="text" name="LOGIN" id="texte" class="form-control" maxlength="30" value="'.$row['LOGIN'].'">';?>
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
          <label for="select" class="col-xs-2">Catégorie</label>
          <div class="col-xs-3">
          <select id="select" name="SERVICE" class="form-control ">
            <?php
            if($row['SERVICE']=='ADMINISTRATION')
            {
                  echo '<option value="ADMINISTRATION">Administration</option>
          <option value="EMPLOYE">Employé</option>';
            }
            else
            {
                 echo '<option value="EMPLOYE">Employé</option>
                       <option value="ADMINISTRATION">Administration</option>';
            }
            ?>
          
        
      </select>
      </div>
      
    
      <label for="PW" class="col-xs-2">password</label>
      <div class="col-xs-4">
      <?php echo'<input pattern=".{5,20}" required title="Un Mot de passe contient minimum 5 caractères et maximum 20 caractères." name="PW" id="PW" class="form-control"  type="password" maxlength="30" value="'.$row['PW'].'">';?>
      </div>
       </div>
    </div>
      <div class="col-xs-4">
      <?php echo '<input type="hidden" name="ID_USER" class="form-control"  value="'.$row['ID_USER'].'">';?>
      </div>
   
    <div class="form-group">
      <div class="col-xs-2">
       <a href="modificationUti1.php"><button class="btn btn-primary" type="button">Retour</button></a>
    </div>
      <button type="submit" name="Submit" value="Modifier" class=" pull-right btn btn-primary">Modifier</button>
    </div>
    </fieldset>
        
        </p>
      </form>
       </div>
     </div>

     <?php
   }?>

<?php 
include('../modeles/pied.php'); ?>