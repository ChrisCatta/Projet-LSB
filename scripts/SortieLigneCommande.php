<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>

    <div class="row">
      <div class="col-xs-2">
      

    <?php
  include('../scripts/connexionDB.php');
    $retour=connexion();
//$c=$retour[0];
$link=$retour[0];
  
    include('../modeles/bar_menu.php'); 
    bar_sortie(2);
    echo ' </div> 

    <div class="col-xs-10 ">'; 
    
    $sqlquery="select ID_CO, REF_CO  FROM COMMANDE";
    $result=mysqli_query($link,$sqlquery);
      ?> 
  
  
 
      <form name="form1" method="post" action="affichecommande.php" class=" well3">
        
        <p>
           <div class="row">
            <div class="col-xs-1">
              <img src="../images/SortieAjout.PNG" width="100" heigth="100" class="img-circle">
            </div>
            <div class="col-xs-offset-1 col-xs-10">
            <legend><h1>Choix de la commande<h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
       <div class="form-group">
          <label for="select" class="col-xs-5">La commande </label>
          <div class="col-xs-7">
          <select id="select" name="ID_CO" class="form-control ">
          <?php
          while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
          {
            echo '<option value="'.$row['ID_CO'].'"> '.$row['ID_CO'].'  - '.$row['REF_CO'].'</option>';
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
     </div>

    
 </td>

  </tr>

</table>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>