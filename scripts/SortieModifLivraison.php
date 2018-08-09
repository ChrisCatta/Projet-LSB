<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>
 <table width="1350" border="0" cellpadding="100" cellspacing="10"  bgcolor="#ABAD68">
  <tr >
    <td height="350" valign="top">
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
    bar_sortie(3);
    echo ' </div> 

    <div class="col-xs-8  ">'; 
    $ID_LIV=$_POST['SortieModifLivraison'];
    $sqlquery1="select  CO.ID_CO, CO.REF_CO, L.LIV_REF, L.DATE_LIV 
                from  LIVRAISON L, COMMANDE CO
                WHERE L.ID_LIV=$ID_LIV AND L.ID_CO=CO.ID_CO";
    $result1=mysqli_query($sqlquery1);
    $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);

    $sqlquery="select distinct CO.ID_CO, CO.REF_CO 
               FROM COMMANDE CO, CONTENIR_CO C
               WHERE CO.ID_CO=C.ID_CO AND CO.ID_CO NOT IN (SELECT ID_CO
                                                           FROM LIVRAISON)
               ";
    $result=mysqli_query($link,$sqlquery);
      ?> 
  
  
 
      <form name="form1" method="post" action="SortieModifLivraison1.php" class="well5">
        
        <p>
           <div class="row">
            <div class="col-xs-1">
              <img src="../images/Sortielivraison.JPG" width="100" heigth="100" class="img-circle">
            </div>
            <div class="col-xs-offset-1 col-xs-10">
            <legend><h1>Modification d'une Livraison<h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
       <div class="form-group">
       	<label for="texte" class="col-xs-5">Réference de la Livraison</label>
      <div class="col-xs-7">
      	<?php echo '<input  type="text" class="form-control" name="LIV_REF" maxlength="30" value="'.$row1['LIV_REF'].'">'; ?>
      
      </div>
         <label for="select" class="col-xs-5">La Commande </label>
          <div class="col-xs-7">
          <select id="select" name="ID_CO" class="form-control ">
          <?php
          echo '<option value="'.$row1['ID_CO'].'"> '.$row1['ID_CO'].'  - '.$row1['REF_CO'].'</option>';
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
     
           
     echo' <input type="date" name="DATE_LIV" id="texte" class="form-control " min="'.date('Y').'-'.date('m').'-'.date('d').'" value="'.$row1['DATE_LIV'].'">';
      ?>
      </div>
       </div>
   </div>

      <input type="submit" name="Submit" value="Ajouter" class=" pull-right btn btn-primary">
      
      <?php echo '<input type="hidden" name="ID_LIV"  class="form-control"  value="'.$_POST['SortieModifLivraison'].'">';?>
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