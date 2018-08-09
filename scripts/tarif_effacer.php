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
    bar_tarif();
    ?>
    </div>
    <div class="col-xs-9 well3">
    <?php
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
     $sqlquery1="SELECT count(*) as 'n' from ARTICLE WHERE ID_TARIF='$_supprimertarif'";
     $result1=mysqli_query($link,$sqlquery1);
     $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
    if($row1['n']!=0)
    {
      panel('panel-info','Information concernant la suppression','<p> <img src="../images/info.PNG" width="100" heigth="100">Le Tarif  ne peut pas être supprimer.<br/>Ce tarif est utilisé dans '.$row1['n'].' Articles(s).<br/>Vous devez supprimer ces articles pour pouvoir le supprimer</p>');
          
    }
    else
    {
    $sqlquery="DELETE from TARIFS WHERE ID_TARIF='$_supprimertarif'";
    $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur de suppression','<p> <img src="../images/ERREUR.gif"><strong>Echec de la suppression.</strong></p>'));
    panel('panel-success','Suppression réussie','<p> <img src="../images/ok.PNG"><strong>Le Tarif a été supprimé correctement.</strong></p>');
    }
     echo '</div>';
      
   
    ?> 



</div>
<?php 
include('../modeles/pied.php'); ?>