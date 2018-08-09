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

    <div class="col-xs-9  ">'; 
    
    $sqlquery="SELECT * FROM UTILISATEUR";
    $result=mysqli_query($link,$sqlquery);
      ?> 
  
  
 
      <form name="form1" method="post" action="modificationUti2.php" class="well3">
        
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
          <label for="select" class="col-xs-4">L'employé à modifier</label>
          <div class="col-xs-8">
          <select id="select" name="modifUti" class="form-control ">
          <?php
          while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
          {
            echo '<option value="'.$row['ID_USER'].'">'.$row['ID_USER'].' - Login = '.$row['LOGIN'].'  Nom = '.$row['NOM'].'   Prenom ='.$row['PRENOM'].'</option>';
          }
          ?>
         
        
      </select>
      </div>
    </div>
  </div>
      <input type="submit" name="Submit" value="Suivant" class=" pull-right btn btn-primary">
    </div>
    </fieldset>
        
        </p>
      </form>
       </div>

     <?php
   }?>
     
<?php 
include('../modeles/pied.php'); ?>