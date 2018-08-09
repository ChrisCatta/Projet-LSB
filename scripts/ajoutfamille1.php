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
    bar_stock(2);
    ?> 
 </div> 

    <div class="col-xs-9">
  
  
 
      <form name="form1" method="post" action="ajoutfamille2.php" enctype="multipart/form-data" class="well3" onSubmit="return verification()">
        
        <p>
           <div class="row">
            <div class="col-xs-1">
              <img src="../images/article.JPG" class="img-circle " width="100" heigth="100">
            </div>
            <div class="col-xs-offset-1 col-xs-10">
            <legend><h1>Ajout d'une Famille<h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
            <div class="form-group">
                   <label for="select" class="col-xs-2">Famille</label>
                <div class="col-xs-4">
                   <input  pattern=".{3,30}" required title="La famille contient minimum 3 caractères et maximum 30 caractères." class="form-control" name="FAMILLE" maxlength="30">
                </div>
               
             </div>
      </div>
 <div class="form-group">
      <div class="col-xs-2">
       <a href="ajoutarticle.php"><button class="btn btn-primary" type="button">Retour</button></a>
    </div>
      <input type="submit" name="Submit" value="Ajouter" class=" pull-right btn btn-primary">
    </div>
    </div>
</fieldset>
         </p>
       </form>
       </div>

<?php 
include('../modeles/pied.php'); ?>