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
    bar_sortie();
    echo ' </div> ';
    $ID_CO=$_POST['ID_CO'];
    $sqlquery1="SELECT  count(*) as 'nombre' from CONTENIR_CO WHERE ID_CO='$ID_CO'";
          $result1=mysqli_query($link,$sqlquery1);     
          $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
    echo '<div class="col-xs-9 well3">';
          $nombre=$row1['nombre'];
          if($nombre!=0)
          {
            $sqlquery3="DELETE from CONTENIR_CO WHERE ID_CO='$ID_CO'";
                   $result3=mysqli_query($link, $sqlquery3) ;
           $sqlquery="DELETE from COMMANDE WHERE ID_CO='$ID_CO'";
           $result=mysqli_query($link, $sqlquery) or die(panel('panel-danger','Erreur de Suppression ','<p> <img src="../images/erreur.png"/><strong>Echec de la Suppression</strong></p>'));
           panel('panel-success','Suppression réussite','<p> <img src="../images/ok.PNG">La Commande  a été Supprimé correctement.</p>');
          }
 else
  {
           $sqldel="DELETE from COMMANDE WHERE ID_CO='$ID_CO'";
           $res=mysqli_query($link, $sqldel) or die(panel('panel-danger','Erreur de Suppression ','<p> <img src="../images/erreur.png"/><strong>Echec de la Suppression</strong></p>'));
           panel('panel-success','Suppression réussite','<p> <img src="../images/ok.PNG">La Commande  a été Supprimé correctement.</p>');
    /*$sqlquery2="SELECT  count(*) as 'nombre2'
                from FACTURE 
                WHERE ID_CO='$ID_CO'";
          $result2=mysqli_query($link,$sqlquery2);     
   $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
    $nombre2=$row2['nombre2'];
        if($nombre2!=0)
        {
         
           panel('panel-info','Suppression Impossible','<p> <img src="../images/info.PNG" width="100" heigth="100">La Commande ne peut pas être Supprimer Elle Contient '.$nombre2.' Facture.</p><p>Vous devez supprimer ces Factures pour supprimer cette commande');
        }
        else
        {*/
          
 //  }
   }
   echo '</div>';
     
   
      
    ?> 



</div>
<?php 
include('../modeles/pied.php'); ?>