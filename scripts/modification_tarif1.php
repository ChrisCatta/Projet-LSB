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
    bar_tarif();
    ?>
    </div> 

    <div class="col-xs-9 well3">
    <?php
    $ID_TARIF=$_POST['ID_TARIF'];
    $sqlquery="select * FROM TARIFS WHERE ID_TARIF='$ID_TARIF'";
    $result=mysqli_query($link,$sqlquery);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
      ?> 
      <form name="form1" method="post" action="modification_tarif2.php" >
        
        <p>
           <div class="row">
            <div class="col-xs-2">
              <img src="../images/google-seo-ranking2.PNG" class="img-circle">
            
            </div>
            <div class="col-xs-10">
            <legend><h1>Modification d'un Tarif<h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">Ref tarif</label>
      <div class="col-xs-4">
      <input pattern=".{3,30}" required title="" name="Tarif" id="texte" class="form-control" maxlength="30" value="<?=$row['TARIF']?>">
      </div>
    </div>
    </div>
    <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">Montant HT</label>
      <div class="col-xs-4">
        <input  required title=""  name="MONTANTHT" class="form-control" maxlength="10" 
        value="<?php echo $row['MONTANTHT']?>">
      </div>
      <label for="texte" class="col-xs-2">TVA</label>
      <div class="col-xs-4">
      <input type="number" name="TVA" class="form-control" value="<?php echo $row['TVA']?>" maxlength="30">
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
      <?php echo '<input type="hidden" name="ID_TARIF" id="texte" class="form-control" maxlength="30" value="'.$row['ID_TARIF'].'">';?>
      </div>
     
       </div>
    </div>
   
    <div class="form-group">
      <div class="col-xs-2">
       <a href="listetarifs.php"><button class="btn btn-primary" type="button">Retour</button></a>
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