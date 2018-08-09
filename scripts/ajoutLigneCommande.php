<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>

<!--<div class="row">
  div class="col-xs-offset-2 col-xs-8">
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
    bar_entree(2);
    echo ' </div> 

    <div class="col-xs-8  ">';   ?> 
  
  <?php
  $id_bonc=$_POST['ajoutLigneCommande'];
  $sqlquery1="SELECT B.ID_CO
              FROM BON_COM B, UTILISATEUR U 
              WHERE B.ID_BONC=$id_bonc AND B.LOGIN=U.LOGIN"   ;
   $result1=mysqli_query($link,$sqlquery1);
   $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
   if($_SESSION['LOGIN']==$row1['LOGIN'])
   {
  ?>
 
      <form name="form1" method="post" action="ajoutLigneCommande1.php" class="well3">
        
        <p>
           <div class="row">
            <div class="col-xs-1">
              <img src="../images/ajoutcommande.PNG" width="100" heigth="100" class="img-circle">
            </div>
            <div class="col-xs-offset-1 col-xs-10">
            <legend><h1>Ajout d'une Ligne de Commande <h1></legend>
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
<label for ="nouv" class="form-control">Nouvelle Ligne de Commande</label>
</div>
</div>
<div class="form-group">
<div class="input-group">
<span class="input-group-addon">
<input type="radio" name="ligne" id="deja" value="2">
</span>
<label class="form-control" for="deja">Ligne de Commande Existante</label>
</div>
</div>
</div>
       
      <input type="submit" name="Submit" value="Suivant" class=" pull-right btn btn-primary btn-inverse">
       
       <?php echo '<input type="hidden" name="ID_BONC"class="form-control"  value="'.$_POST['ajoutLigneCommande'].'">';?>
     
    </div>
    </fieldset>
        
        </p>
      </form>

       <?php
    }
    else
    {
      panel('panel-danger','<h2><strong>Aucun droit</strong></h2>','<p> <strong>Vous ne pouvez pas Ajouter une ligne de Commande pour cette Commande pour les raisons suivantes :</p>
      <p><img src="../images/interdit.PNG" alt="interdit"></p>
      <p class="interdit">
          Le responsable de cette Commande est  '.$row1['NOM'].'  '.$row1['PRENOM'].'</strong>

      </p>');
    }
      ?>
       </div>


     </div>

<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>