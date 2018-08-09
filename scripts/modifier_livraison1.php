<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>

<!--div class="row">
  <div class="col-xs-offset-2 col-xs-8">
      <h3>Système de gestion des stages</h3>
      </div>
    </div-->
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

    <div class="col-xs-9">'; 
    $ID_BONL=$_POST['ID_BONL'];
    $sqlquery="select  * FROM  LIV_BON WHERE ID_BONL=$ID_BONL";
     
   $result=mysqli_query($link,$sqlquery);
   $row=mysqli_fetch_array($result);
      ?> 
  
  
 
      <form name="form1" method="post" action="modifier_livraison2.php" class="well3" ">
        
        <p>
           <div class="row">
            <div class="col-xs-2">
              <img src="../images/livraison.JPG" width="100" heigth="100" class="img-circle">
            </div>
            <div class=" col-xs-10">
            <legend><h1>Modifier une Livraison<h1></legend>
          </div>
           </div>
            
    <fieldset>




<div class="row">
       <div class="form-group">
       <label for="texte" class="col-xs-4">Réference Livraison</label>
      <div class="col-xs-6">
         <input  type="text" value="<?=$row['REF_LIV']?>" class="form-control" name="REF_LIV" maxlength="30">
      
      </div>

    </div>
  </div>
<div class="row">
       <div class="form-group">
       <label for="texte" class="col-xs-4">Type Livraison</label>
      <div class="col-xs-6">
       <select id="select" name="TYPE_LIV" class="form-control ">
                   <?php
                    $sql = "SELECT * FROM TYPE";
                    $res = mysqli_query($link,$sql) or exit(mysql_error());
                    while($data=mysqli_fetch_array($res)) 
                    {
                        if ($data['TYPE'] == $row['TYPE']) 
                                { // Ta comparaison à toi de la choisir
                                echo '<option value="'.$data['TYPE'].'" selected="selected">'.$data['TYPE'].'</option><br/>'; 
                                }
                                else
                                {
                                echo '<option value="'.$data['TYPE'].'" >'.$data['TYPE'].'</option>'; // Tu n'ajoute rien si la comparaison est fausse (ou vrai)
                                }
                    }
                     
                    ?> 
                </select> 

    </div>
  </div>
  


  <div class="row">
       <div class="form-group">
        <label for="texte" class="col-xs-4">Date de la Livraison</label>
      <div class="col-xs-6">
          <?php
     echo' <input type="date" name="DATE_BONL" id="texte" class="form-control " id="datepicker" min="'.date('d').'/'.date('m').'/'.date('Y').'" value="'.$row['DATE_BONL'].'">';
       
      ?>
      </div>
       </div>
   </div>
<input type="hidden" name="ID_BONL" value="<?=$row['ID_BONL']?>">
      <button type="submit" name="Submit" value="Modifier" class=" pull-right btn btn-primary">Modifier</button>
     

    </div>
  </div>

    
    </fieldset>
        
        </p>
        
      </form>
       </div>
     </div>

<?php 
include('../modeles/pied.php'); ?>