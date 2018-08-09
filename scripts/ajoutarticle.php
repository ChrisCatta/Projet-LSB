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
  
  
 
      <form name="form1" method="post" action="ajout-article.php" class="well3">
        
        <p>
           <div class="row">
            <div class="col-xs-2">
              <img src="../images/article.JPG" class="img-circle " width="100" heigth="100">
            </div>
            <div class="col-xs-8">
            <legend><h1>Ajout d'un Article<h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
       <div class="input-group col-xs-offset-4 col-lg-4">
<div class="form-group">
<div class="input-group">
<span class="input-group-addon">
<input type="radio" name="article" class="ui-widget ui-corner-all ui-widget-content" id="nouv" value="1" checked>
</span>
<label for ="nouv" class="form-control">Nouvel Article</label>
</div>
</div>
<div class="form-group">
<div class="ui-checkboxradio ui-corner-all ui-widget-content input-group">
<span class="ui-checkboxradio input-group-addon">
<input type="radio" name="article" class="ui-button ui-widget ui-checkboxradio" id="deja" value="2">
</span>
<label class="ui-widget-content" for="deja">Article Existant</label>
</div>
</div>
</div>
       
      <button type="submit" name="Submit" value="Suivant" class="btn btn-primary pull-right  btn-inverse">Suivant</button>
    </div>
    </fieldset>
        
        </p>
      </form>
       </div>
     </div>

<?php 
include('../modeles/pied.php'); ?>