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
    bar_entree(3);
    echo ' </div> 

    <div class="col-xs-9  ">'; 
 
      ?> 
  
  
 
      <form name="form1" method="post" action="ajoutLivraison1.php" class="well3" ">
        
        <p>
           <div class="row">
            <div class="col-xs-2">
              <img src="../images/livraison.JPG" width="100" heigth="100" class="img-circle">
            </div>
            <div class="col-xs-10">
            <legend><h1>Ajout d'une Livraison<h1></legend>
          </div>
           </div>
            
    <fieldset>




<div class="row">
       <div class="form-group">
       <label for="texte" class="col-xs-4">Réference Livraison</label>
      <div class="col-xs-6">
         <input  pattern=".{3,30}" required title="La référence contient minimum 3 caractères et maximum 30 caractères." class="form-control" name="REF_LIV" maxlength="30">
      
      </div>

    </div>
  </div>
<div class="row">
       <div class="form-group">
         <label for="texte" class="col-xs-4">Type Livraison</label>
            <div class="col-xs-6">
             <select id="select" name="TYPE_LIV" class="form-control ">
                        <option value=""></option>
                               <?php
                                $sql = "SELECT * FROM TYPE";
                                $res = mysqli_query($link,$sql) or exit(mysql_error());
                                while($data=mysqli_fetch_array($res)) 
                                {
                                   echo '<option value='.$data['TYPE'].'>'.$data['TYPE'].'</option><br/>'; //Attention à ne pas oublier le . qui sert à concaténer ton expression
                                }
                                 
                                ?> 
            </select> 
    </div>

    </div>
  </div>
  


        <div class="row">
             <div class="form-group">
              <label for="texte" class="col-xs-4">Date de la Livraison</label>
            <div class="col-xs-6">
                <?php
           echo' <input type="date" name="DATE_BONL" id="texte" class="form-control " id="datepicker"  value="'.date('Y').'-'.date('m').'-'.date('d').'">';
             
            ?>
            </div>
             </div>
         </div>
        
         <div class="row"> 
            <div class="col-xs-offset-10 col-xs-2">
            <input type="submit" name="Submit" value="Ajouter" class=" btn btn-primary">
            </div>
          </div>
     


    
    </fieldset>
        
        </p>
        
      </form>
       </div>
     </div>

<?php 
include('../modeles/pied.php'); ?>