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
    bar_sortie(1);
    echo ' </div> ';
    $ID_DV=$_POST['ID_DV'];
    $sqlquery1="SELECT  count(*) as 'nombre'
                from CONTENIR_DV 
                WHERE ID_DV=$ID_DV";
          $result1=mysqli_query($link,$sqlquery1);     
   $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
    echo '<div class="col-xs-9">';
    $nombre=$row1['nombre'];
  if($nombre!=0)
  {
   
   $sqlquery3="DELETE from CONTENIR_DV WHERE ID_DV='$ID_DV'";
   $result3=mysqli_query($link, $sqlquery3) ;
   $sqlquery="DELETE from DEVIS WHERE ID_DV='$ID_DV'";
   $result=mysqli_query($link,$sqlquery) or die(panel('panel-info','Suppression Impossible','<p> <img src="../images/info.PNG" width="100" heigth="100">Le devis ne peut pas être Supprimer il Contient '.$nombre.' Ligne(s).</p><p>Vous devez supprimer ces lignes de devis pour supprimer ce devis'));
              panel('panel-success','Suppression réussite','<p> <img src="../images/ok.PNG">Le devis a été Supprimé correctement.</p>');
  }
  else
  {
    
     $sqlquery="DELETE from DEVIS WHERE ID_DV=$ID_DV";
     $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur de Suppression ','<p> <img src=\"../images/ERREUR.gif\"><strong>Echec de la Suppression</strong></p>'));
     panel('panel-success','Suppression réussite','<p> <img src="../images/ok.PNG">Le devis a été Supprimé correctement.</p>');
  }
    ?> 
   
</div>
 </div>
<?php 
include('../modeles/pied.php'); ?>