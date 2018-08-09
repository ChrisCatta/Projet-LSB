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
   if($c==1)
   {
    include('../modeles/bar_menu.php'); 
    bar_fournisseur(5);
    foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
      // Debut de la partie page1 de la recherche par login //////////////////////////////////////////////////////////////////////////////////  

   if($_PAGE==1)
   {
    echo ' </div> 

    <div class="col-xs-9 well3">';
  
  $sqlquery="select ID_F, RAISSO_F, ADRESSE_F, TEL_F, CIN, EMAIL_F ,NIF_F, STAT_F FROM FOURNISSEUR where ID_F=$_ID_F";
   $result=mysqli_query($link,$sqlquery);
   panel_tab('panel-info','<img src="../images/listeFournisseur.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;Le Resultat de la Recherche');
   echo '<table class="table table-bordered table-striped table-condensed">
   <tr>
        <th><strong>Modif</strong></th>
        <th><strong>Supp</strong></th>
      <td><strong>Identifiant</strong></td>
      <td><strong>Raison sociale / Nom </strong></td>
      <td><strong>Adresse</strong></td>
      <td><strong>Tél.</strong></td>
      <td><strong>CIN.</strong></td>
      <td><strong>E-mail</strong></td>
      <td><strong>NIF.</strong></td>
      <td><strong>STAT</strong></td>
   </tr>';
   
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    echo '
       <tr>
        <td><form name="formafficher" action="modificationFour1.php" method="post"><div class="affiche"><input name="ID_F" type="submit" class="ajoute" value='.$row['ID_F'].'" title="Détail Fournisseur"></div></form></td>
         <td><form name="formsupprimer" action="fournisseur_effacer.php" method="post"><div class="supprime"><input name="supprimerfournisseur" type="submit" class="ajoute" value="'.$row['ID_F'].'" title="Supprimer Fournisseur"></div></form></td>
           <td>'.$row['ID_F'].'</td>
           <td>'.$row['RAISSO_F'].'</td>
           <td>'.$row['ADRESSE_F'].'</td>
           <td>'.$row['TEL_F'].'</td>
           <td>'.$row['CIN'].'</td>
           <td>'.$row['EMAIL_F'].'</td>
           <td>'.$row['NIF_F'].'</td>
           <td>'.$row['STAT_F'].'</td>
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

    <div class="col-xs-9 well3">';
  
   $sqlquery="select ID_F, RAISSO_F, ADRESSE_F, TEL_F, CIN, EMAIL_F ,NIF_F, STAT_F  FROM FOURNISSEUR where RAISSOCF LIKE'$_RAISSO_F' or ADRESSE_F LIKE'ADRESSE_F' or TEL_F LIKE 'TEL_F' or CIN='CIN' or  EMAIL_F='EMAIL_F'or NIF_F='NIF_F' or STAT_F='STAT_F' ";
   $result=mysqli_query($link,$sqlquery);
   panel_tab('panel-info','<img src="../images/listeFournisseur.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;Le Resultat de la Recherche');
   echo '<table class="table table-bordered table-striped table-condensed">
   <tr>
        <th><strong>Modif</strong></th>
        <th><strong>Supp</strong></th>
      <td><strong>Identifiant</strong></td>
      <td><strong>Raison sociale / Nom </strong></td>
      <td><strong>Adresse</strong></td>
      <td><strong>Tél.</strong></td>
      <td><strong>CIN.</strong></td>
      <td><strong>E-mail</strong></td>
      <td><strong>NIF.</strong></td>
      <td><strong>STAT</strong></td>
   </tr>';
   
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    echo '
       <tr>
        <td><form name="formafficher" action="modificationFour1.php" method="post"><div class="affiche"><input name="ID_F" type="submit" class="ajoute" value='.$row['ID_F'].'" title="Détail Fournisseur"></div></form></td>
         <td><form name="formsupprimer" action="fournisseur_effacer.php" method="post"><div class="supprime"><input name="supprimerfournisseur" type="submit" class="ajoute" value="'.$row['ID_F'].'" title="Supprimer Fournisseur"></div></form></td>
           <td>'.$row['ID_F'].'</td>
           <td>'.$row['RAISSO_F'].'</td>
           <td>'.$row['TEL_F'].'</td>
           <td>'.$row['CIN'].'</td>
           <td>'.$row['EMAIL_F'].'</td>
           <td>'.$row['NIF_F'].'</td>
           <td>'.$row['STAT_F'].'</td>
       </tr>
    ';
   }
   echo'</table>
   
 
<!-- div de la fonction panel_tab -->
    </div>
    ';
 }
   // FIN de la partie page2 de la recherche par login //////////////////////////////////////////////////////////////////////////////////  
    }
      
   
    ?> 
 <div class="row">
<div class="form-group">
            <div class="col-xs-offset-10 col-xs-2">
     
      <a href="RechercheFournisseur.php"><input type="submit" name="Submit" value="Retour" class="btn btn-primary"></a>
      </div>
      </div>
    </div>
    </div>
    </div>
<?php 
include('../modeles/pied.php'); ?>