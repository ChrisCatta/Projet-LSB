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
    bar_stock(3);
    echo ' </div> ';
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
    $sqlquery1="SELECT count(*) as 'n' from CONTENIR_CO C, COMMANDE CO WHERE C.ID_A='$_ID_A' AND CO.ID_CO=C.ID_CO";
     $result1=mysqli_query($link,$sqlquery1);
     $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
     $sqlquery2="SELECT count(*) as 'n' from CONTENIR_BON C, BON_COM B, FOURNISSEUR F WHERE C.ID_A='$_ID_A' AND C.ID_BONC=B.ID_BONC AND B.ID_F=F.ID_F";
     $result2=mysqli_query($link,$sqlquery2);
     $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);

    echo '<div class="col-xs-9">';
    if($row1['n']!=0 || $row2['n']!=0 )
     {
          if($row2['n']!=0)
          {
             panel('panel-info','Information concernant la suppression','<p> <img src="../images/info.PNG" width="100" heigth="100">L\'Article   ne peut pas être supprimer.<br/>Cet Article concerne '.$row2['n'].' entrées.<br/>Vous devez supprimer ces commandes pour pouvoir le supprimer</p>');
          }
          elseif($row1['n']!=0)
          {
            panel('panel-info','Information concernant la suppression','<p> <img src="../images/info.PNG" width="100" heigth="100">L\'Article  ne peut pas être supprimer.<br/>Cet Article concerne '.$row1['n'].' sorties.<br/>Vous devez supprimer ces commandes pour pouvoir le supprimer</p>');
          }
     }
     else
     {
    $sqlquery1="DELETE from ARTICLE WHERE ID_A='$_ID_A'";
    $result1=mysqli_query($link,$sqlquery1) or die(panel('panel-danger','Erreur de suppression 2','<p> <img src="../images/ERREUR.gif"><strong>Echec de la suppression.</strong></p>'));
    panel('panel-success','Suppression réussie','<p> <img src="../images/ok.PNG"><strong>L\'article a été supprimé correctement.</strong></p>');
     }
    ?> 
   </div>
      </div>
<?php 
include('../modeles/pied.php'); ?>