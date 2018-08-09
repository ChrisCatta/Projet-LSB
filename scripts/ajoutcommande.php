<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>
<!--div class="row">
  <div class="col-xs-offset-2 col-xs-8">
      <h3>Système de gestion des stages</h3>
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
    bar_entree(1);
    echo ' </div> 

    <div class="col-xs-8  ">'; 
    
    $sqlquery="select distinct FO.ID_F, FO.RAISSOCF FROM FOURNISSEUR FO, FOURNIR F WHERE FO.ID_F=F.ID_F";
    $result=mysqli_query($link,$sqlquery);
      ?> 
  
  
 
      <form name="form1" method="post" action="ajoutcommande1.php" class="well3">
        
        <p>
           <div class="row">
            <div class="col-xs-1">
              <img src="../images/ajoutcommande.PNG" width="100" heigth="100" class="img-circle">
            </div>
            <div class="col-xs-offset-1 col-xs-10">
            <legend><h1>Ajout d'une Commande<h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
       <div class="form-group">
       	<label for="texte" class="col-xs-5">Réference de la Commande</label>
      <div class="col-xs-7">
      	 <input  pattern=".{3,30}" required title="La référence contient minimum 3 caractères et maximum 30 caractères." class="form-control" name="REFERENCE" maxlength="30">
      
      </div>
          <label for="select" class="col-xs-5">Le fournisseur </label>
          <div class="col-xs-7">
          <select id="select" name="ID_F" class="form-control ">
          <?php
          while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
          {
            echo '<option value="'.$row['ID_F'].'"> '.$row['ID_F'].'  - '.$row['RAISSOCF'].'</option>';
          }
          ?>
         
        
      </select>
      </div>
    </div>
  </div>
  <div class="row">
       <div class="form-group">
       	<label for="texte" class="col-xs-5">Date de la Commande</label>
      <div class="col-xs-7">
      	<?php
     echo' <input type="date" name="DATE_BONC" id="texte" class="form-control " min="'.date('Y').'-'.date('m').'-'.date('d').'" value="'.date('Y').'-'.date('m').'-'.date('d').'">';
       
      ?>
      </div>
       </div>
   </div>

      <button type="submit" name="Submit" value="Ajouter" class=" pull-right btn btn-primary">Ajouter</button>
    </div>
    </fieldset>
        
        </p>
      </form>
       </div>
     </div>


<?php 
include('../modeles/pied.php'); ?>