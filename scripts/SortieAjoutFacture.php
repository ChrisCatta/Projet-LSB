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
    bar_sortie(4);
    echo ' </div> 

    <div class="col-xs-10">'; 
    
    $sqlquery="SELECT distinct CO.ID_CO, CO.REF_CO 
               FROM COMMANDE CO
               WHERE  CO.ID_CO NOT IN (SELECT ID_CO FROM FACTURE)
               ";
    $result=mysqli_query($link,$sqlquery);
      ?> 
  
  
 
      <form name="form1" method="post" action="SortieAjoutFacture1.php" class="well3">
        
        <p>
           <div class="row">
            <div class="col-xs-1">
              <img src="../images/facture.gif" width="100" heigth="100" class="img-circle">
            </div>
            <div class="col-xs-offset-1 col-xs-10">
            <legend><h1>Ajout d'une Facture<h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
       <div class="form-group">
       	<label for="texte" class="col-xs-5">Réference de la Facture</label>
      <div class="col-xs-7">
      	 <input  type="text" class="form-control" name="REF_FACT" maxlength="30">
      
      </div>
          <label for="select" class="col-xs-5">La Commande </label>
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
  <div class="row">
       <div class="form-group">
       	<label for="texte" class="col-xs-5">Date de la Facture</label>
      <div class="col-xs-7">
      	<?php
     echo' <input type="date" name="DATE_FA" id="texte" class="form-control " min="'.date('Y').'-'.date('m').'-'.date('d').'" value="'.date('Y').'-'.date('m').'-'.date('d').'">';
       
      ?>
      </div>
       </div>
   </div>

      <input type="submit" name="Submit" value="Ajouter" class=" pull-right btn btn-primary">
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