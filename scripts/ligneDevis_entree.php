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
    bar_sortie(2);
    echo ' </div> 

    <div class="col-xs-9  ">'; 
    
    $sqlquery="SELECT ID_DV, REF_DV  FROM DEVIS";
    $result=mysqli_query($link,$sqlquery);
      ?> 
  
  
 
      <form name="form1" method="post" action="lignedevis1.php" class="well3">
        
        <p>
           <div class="row">
            <div class="col-xs-1">
              <img src="../images/ajoutcommande.PNG" width="100" heigth="100" class="img-circle">
            </div>
            <div class="col-xs-offset-1 col-xs-10">
            <legend><h1>Choix du devis</h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
          <div class="col-xs-5">
            <label for="select" >Le devis </label>
          </div>
          <div class="col-xs-7">
            <select id="select" name="ID_DV" class="select-menu ui-widget ui-widget-content ui-corner-all">
              <?php
              while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
              {
                echo '<option value="'.$row['ID_DV'].'"> '.$row['ID_DV'].'  - '.$row['REF_DV'].'</option>';
              }
              ?>
            </select>
          </div>
    </div>
    </fieldset>
    <div class="row">
            <div class="col-xs-offset-10 col-xs-2">
        <button type="submit" name="Submit" value="Suivant" class="btn btn-primary">Suivant</button>
        </div>
    </div>
        
        </p>
      </form>
       </div>
     </div>

<?php 
include('../modeles/pied.php'); ?>