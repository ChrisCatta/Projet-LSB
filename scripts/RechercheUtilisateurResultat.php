<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>
 <table >
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
    bar_administration(5);
    foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
      // Debut de la partie page1 de la recherche par login //////////////////////////////////////////////////////////////////////////////////  

   if($_PAGE==1)
   {
    echo ' </div> 

    <div class="col-xs-8  table-responsive">';
  
   $sqlquery="select NOM, PRENOM, DATENAIS, SEXE, ADRESSE, TEL1, SERVICE FROM UTILISATEUR where LOGIN='$_LOGIN' ORDER BY NOM";
   $result=mysqli_query($link,$sqlquery);
   panel_tab('panel-info','<img src="../images/utilisateur.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;Résultat de la recherche');
   echo '<table class="table table-bordered table-striped table-condensed">
   <tr class="info">
      <td><strong>NOM</strong></td>
      <td><strong>PRENOM</strong></td>
      <td><strong>DATE_DE_NAISSANCE</strong></td>
      <td><strong>SEXE</strong></td>
      <td><strong>ADRESSE</strong></td>
      <td><strong>SERVICE</strong></td>
   </tr>';
   
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    echo '
       <tr>
           <td>'.$row['NOM'].'</td>
           <td>'.$row['PRENOM'].'</td>
           <td>'.$row['DATENAIS'].'</td>
           <td>'.$row['SEXE'].'</td>
           <td>'.$row['ADRESSE'].'</td>
           <td>'.$row['SERVICE'].'</td>
       </tr>
    ';
   }
   echo'</table>
   
 
<!-- div de la fonction panel_tab -->
    </div>
    ';
 }    
   // FIN de la partie page1 de la recherche par login //////////////////////////////////////////////////////////////////////////////////  
  // debut de la partie pag2 de la recherche par login ////////////////////////////////////////////////////////////////////////////////// 
 elseif($_PAGE==2)
 {
         echo ' </div> 

    <div class="col-xs-8  table-responsive">';
  
   $sqlquery="select NOM, PRENOM, DATENAIS, SEXE, ADRESSE, TEL1, SERVICE FROM UTILISATEUR where (NOM='$_NOM' or PRENOM='$_PRENOM') AND SEXE='$_SEXE' and SERVICE='$_SERVICE'  ORDER BY NOM";
   $result=mysqli_query($link,$sqlquery);
   panel_tab('panel-info','<img src="../images/utilisateur.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;Résultat de la recherche');
   echo '<table class="table table-bordered table-striped table-condensed">
   <tr class="info">
      <td><strong>NOM</strong></td>
      <td><strong>PRENOM</strong></td>
      <td><strong>DATE_DE_NAISSANCE</strong></td>
      <td><strong>SEXE</strong></td>
      <td><strong>ADRESSE</strong></td>
      <td><strong>SERVICE</strong></td>
   </tr>';
   
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    echo '
       <tr>
           <td>'.$row['NOM'].'</td>
           <td>'.$row['PRENOM'].'</td>
           <td>'.$row['DATENAIS'].'</td>
           <td>'.$row['SEXE'].'</td>
           <td>'.$row['ADRESSE'].'</td>
           <td>'.$row['SERVICE'].'</td>
       </tr>
    ';
   }
   echo'</table>
   
 
<!-- div de la fonction panel_tab -->
    </div>
    ';
 }
   // FIN de la partie page2 de la recherche par login //////////////////////////////////////////////////////////////////////////////////  

    // debut de la partie pag2 de la recherche par login ////////////////////////////////////////////////////////////////////////////////// 
 else
 {
 echo ' </div> 

    <div class="col-xs-8  table-responsive">';
  
   $sqlquery="select NOM, PRENOM, DATENAIS, SEXE, ADRESSE, TEL1, SERVICE FROM UTILISATEUR where (NOM='$_NOM' or PRENOM='$_PRENOM' or ADRESSE='$_ADRESSE' or TEL1='$_TEL1' or LOGIN='$_LOGIN' or DATENAIS='$_DATENAIS') AND SEXE='$_SEXE' and SERVICE='$_SERVICE'  ORDER BY NOM";
   $result=mysqli_query($link,$sqlquery);
   panel_tab('panel-info','<img src="../images/utilisateur.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;Résultat de la recherche');
   echo '<table class="table table-bordered table-striped table-condensed">
   <tr class="info">
      <td><strong>NOM</strong></td>
      <td><strong>PRENOM</strong></td>
      <td><strong>DATE_DE_NAISSANCE</strong></td>
      <td><strong>SEXE</strong></td>
      <td><strong>ADRESSE</strong></td>
      <td><strong>SERVICE</strong></td>
   </tr>';
   
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    echo '
       <tr>
           <td>'.$row['NOM'].'</td>
           <td>'.$row['PRENOM'].'</td>
           <td>'.$row['DATENAIS'].'</td>
           <td>'.$row['SEXE'].'</td>
           <td>'.$row['ADRESSE'].'</td>
           <td>'.$row['SERVICE'].'</td>
       </tr>
    ';
   }
   echo'</table>
   
 
<!-- div de la fonction panel_tab -->
    </div>
    ';
 }
   // FIN de la partie page2 de la recherche par login //////////////////////////////////////////////////////////////////////////////////  
 
   
      
   
    ?> 
<div class="form-group">
     
      <a href="RechercheUtilisateur.php"><input type="submit" name="Submit" value="Retour" class=" pull-right btn btn-primary"></a>
      </div>
</div>

    </div>


 </td>

  </tr>

  

</table>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>