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
    bar_fournisseur(3);
    echo ' </div> ';
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
  
$sqlquery1="select count(*) as 'n' from FOURNIR WHERE ID_F='$_supprimerFour'";
     $result1=mysqli_query($sqlquery1);
     $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
     $sqlquery2="select count(*) as 'n' from BON_COM WHERE ID_F='$_supprimerFour'";
     $result2=mysqli_query($sqlquery2);
     $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
     
    echo '<div class="col-xs-9 well3">';
if($row1['n']!=0 || $row2['n']!=0 )
     {
          if($row2['n']!=0)
          {
             panel('panel-info','Information concernant la suppression','<p> <img src="../images/info.PNG" width="100" heigth="100">Le fournisseur  ne peut pas être supprimer.<br/>Ce fournisseur concerne '.$row2['n'].' commandes .<br/>Vous devez supprimer ces commandes pour pouvoir le supprimer</p>');
          }
          elseif($row1['n']!=0)
          {
            panel('panel-info','Information concernant la suppression','<p> <img src="../images/info.PNG" width="100" heigth="100">Le fournisseur  ne peut pas être supprimer.<br/>Ce fournisseur fourni  '.$row1['n'].' Articles.<br/>Vous devez supprimer ces articles pour pouvoir le supprimer</p>');
          }
     }
     else
     {
     $sqlquery="delete from FOURNISSEUR WHERE ID_F='$_supprimerFour'";
    
     $result=mysqli_query($sqlquery) or die(panel('panel-danger','Erreur de Suppression','<p> <img src="../images/ERREUR.gif"><strong>Echec de la suppression.</strong></p>'));
   
     panel('panel-success','Suppression réussie','<p> <img src="../images/ok.PNG"> Le Fournisseur  a été supprimer correctement.</p>');
     }
   echo '</div>';
      
   
    ?> 



</div>
<?php 
include('../modeles/pied.php'); ?>