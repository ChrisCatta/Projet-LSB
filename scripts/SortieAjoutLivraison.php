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
    bar_sortie(3);
    echo ' </div> 

    <div class="col-xs-8  ">'; 
    
    $sqlquery="select distinct CO.ID_CO, CO.REF_CO 
               FROM COMMANDE CO, CONTENIR_CO C
               WHERE CO.ID_CO=C.ID_CO AND CO.ID_CO 
               ";
    $result=mysqli_query($link,$sqlquery);
      ?> 
  
  
 
      <form name="form1" method="post" action="SortieAjoutLivraison1.php" class="well5" onSubmit="return verification()">
        
        <p>
           <div class="row">
            <div class="col-xs-1">
              <img src="../images/Sortielivraison.JPG" width="100" heigth="100" class="img-circle">
            </div>
            <div class="col-xs-offset-1 col-xs-10">
            <legend><h1>Ajout d'une Livraison<h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
       <div class="form-group">
       	<label for="texte" class="col-xs-5">Réference de la Livraison</label>
      <div class="col-xs-7">
      	 <input  pattern=".{3,30}" required title="La référence contient minimum 3 caractères et maximum 30 caractères." class="form-control" name="LIV_REF" maxlength="30">
      
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
       	<label for="texte" class="col-xs-5">Date de la Livraison</label>
      <div class="col-xs-7">
      	<?php
     echo' <input type="date" name="DATE_LIV" id="texte" class="form-control " min="'.date('Y').'-'.date('m').'-'.date('d').'" value="'.date('Y').'-'.date('m').'-'.date('d').'">';
       
      ?>
      </div>
       </div>
   </div>

      <input type="submit" name="Submit" value="Ajouter" class=" pull-right btn btn-primary">
    </div>
    </fieldset>
        
        </p>
        <script language="javascript" type="text/javascript">
                            function verification()
                            {
                             
                                if(document.forms["form1"].elements["ID_CO"].value=="")
                                {
                                  alert("Vous devez passer des commandes pour valider.");
                                  return false;

                                }
                                else 
                                {
                                  return true;
                                }
                            }
                          </script>
      </form>
       </div>
     </div>

<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>