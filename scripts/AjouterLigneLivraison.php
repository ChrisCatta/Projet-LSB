<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>
  <!--div class="col-xs-offset-2 col-xs-8">
      <h3>Ajout Article</h3>
      </div>
    </div-->
    <div class="row">
      <div class="col-xs-2">
      

    <?php
    include('../scripts/connexionDB.php');
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
   include('../modeles/bar_menu.php'); 
    bar_entree(3);
    echo ' </div> 

    <div class="col-xs-8  ">';   ?> 
  
 
 
      <form name="form1" method="post" action="ajoutLigneLivraison1.php" class="well4">
        
        <p>
           <div class="row">
            <div class="col-xs-2">
              <img src="../images/Livraison.JPG" width="100" heigth="100" class="img-circle">
            </div>
            <div class=" col-xs-10">
            <legend><h1>Ajout d'une Ligne de Livraison <h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
       <div class="input-group col-xs-offset-4 col-lg-4">
<div class="form-group">
<div class="input-group">
<span class="input-group-addon">
<input type="radio" name="ligne" id="nouv" value="1" checked>
</span>
<label for ="nouv" class="form-control">Nouvelle Ligne de Livraison</label>
</div>
</div>
<div class="form-group">
<div class="input-group">
<span class="input-group-addon">
<input type="radio" name="ligne" id="deja" value="2">
</span>
<label class="form-control" for="deja">Ligne de Livraison Existante</label>
</div>
</div>
</div>
       
      <input type="submit" name="Submit" value="Suivant" class=" pull-right btn btn-primary btn-inverse">
       
       <?php echo '<input type="hidden" name="ID_BONL" class="form-control"  value="'.$_POST['ajoutLigneLivraison'].'">';?>
     
    </div>
    </fieldset>
        
        </p>
      </form>

      
       </div>


     </div>

    

 </td>

  </tr>

  

</table>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>