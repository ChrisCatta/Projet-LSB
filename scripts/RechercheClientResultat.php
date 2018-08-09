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
    bar_Client();
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
  
   $sqlquery="SELECT *  FROM CLIENT where RAISSO_C LIKE '%".$_ID_C."%' ";
   $result=mysqli_query($link,$sqlquery);
   panel_tab('panel-info','<img src="../images/listeClient.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;&nbsp;Resultat de la Recherche');
   echo '<table class="info" border="1" width="100%" >
   <tr>
        <th><strong>Modif</strong></th>
        <th><strong>Supp</strong></th>
      <td><strong>Identifiant</strong></td>
      <td><strong>Raison sociale / Nom </strong></td>
      <td><strong>Adresse</strong></td>
      <td><strong>Tél.</strong></td>
      <td><strong>Nif.</strong></td>
      <td><strong>Stat.</strong></td>
      <td><strong>E-mail</strong></td>
   </tr>';
   
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    echo '
       <tr>
        <td><form name="formafficher" action="modification_client1.php" method="post"><div class="affiche"><input name="ID_C" type="submit" class="ajoute" value='.$row['ID_C'].'" title="Détail Article"></div></form></td>
         <td><form name="formsupprimer" action="client_effacer.php" method="post"><div class="supprime"><input name="supprimerclient" type="submit" class="ajoute" value="'.$row['ID_C'].'" title="Supprimer CLient"></div></form></td>
           <td>'.$row['ID_C'].'</td>
           <td>'.$row['RAISSO_C'].'</td>
           <td>'.$row['ADRESSE_C'].'</td>
           <td>'.$row['TEL_C'].'</td>
           <td>'.$row['NIF'].'</td>
           <td>'.$row['STAT'].'</td>
           <td>'.$row['EMAIL'].'</td>
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
  
    echo $_RAISSO_C;
    $sqlquery="SELECT *  FROM CLIENT where RAISSO_C LIKE '%".$_RAISSO_C."%'  or ADRESSE_C LIKE '%".$_ADRESSE_C."%'  or TEL_C LIKE '%".$_TEL_C."%'  or NIF LIKE '%".$_NIF."%'  or STAT LIKE '%".$_STAT."%'  or  EMAIL LIKE '%".$_EMAIL."%' ";
   $result=mysqli_query($link,$sqlquery);
   panel_tab('panel-info','<img src="../images/listeClient.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;&nbsp;Resultat de la Recherche');
   echo '<table class="info" border="1" width="100%" >
   <tr class="info">
        <th><strong>Modif</strong></th>
        <th><strong>Supp</strong></th>
      <td><strong>Identifiant</strong></td>
      <td><strong>Raison sociale / Nom </strong></td>
      <td><strong>Adresse</strong></td>
      <td><strong>Tél.</strong></td>
      <td><strong>Nif.</strong></td>
      <td><strong>Stat.</strong></td>
      <td><strong>E-mail</strong></td>
   </tr>';
   
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    echo '
       <tr>
           <td>'.$row['ID_C'].'</td>
           <td>'.$row['RAISSO_C'].'</td>
           <td>'.$row['ADRESSE_C'].'</td>
           <td>'.$row['TEL_C'].'</td>
           <td>'.$row['NIF'].'</td>
           <td>'.$row['STAT'].'</td>
           <td>'.$row['EMAIL'].'</td>
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

 <div class="row">
<div class="form-group">
            <div class="col-xs-offset-10 col-xs-2">
     
      <a href="RechercheClient.php"><input type="submit" name="Submit" value="Retour" class="btn btn-primary"></a>
      </div>
</div>
    </div>
    </div>
    </div>
<?php 
include('../modeles/pied.php'); ?>