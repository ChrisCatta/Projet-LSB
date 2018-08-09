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
    </div>-->
    <div class="row">
      <div class="col-xs-2">
      

    <?php
   include('../scripts/connexionDB.php');
    $retour=connexion();
//$c=$retour[0];
$link=$retour[0];
  
    include('../modeles/bar_menu.php'); 
    bar_sortie(2);
    echo ' </div> ';
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
   $sqlquery1="select DESIGNATION,QTE_STO
               from ARTICLE
               where ID_A=$_ID_A";
               $result1=mysqli_query($sqlquery1);
               $row=mysqli_fetch_array($result1,MYSQLI_ASSOC);

    echo '<div class="col-xs-8">';
    if($_QTE_CO>$row['QTE_STO'])
    {
        die(panel('panel-danger','Erreur d\'Ajout ','<p> <img src="../images/ERREUR.gif"><strong>Vous avez depassé la quantité dans le Stock Pour l\'Artcile :<br/>  Numéro :'.$_ID_A.'.<br/>Désignation : '.$row['DESIGNATION'].'<br/>Quantité en Stock : '.$row['QTE_STO'].'</strong></p>'));
    }
    else
    {
  if($_NEW_OLD==1)
  {
   
     $sqlquery="insert into CONTENIR_CO values ( $_ID_A, $_ID_CO, $_QTE_CO)";
     $result=mysqli_query($sqlquery) or die(panel('panel-danger','Erreur d\'enregistrement ','<p> <img src="../images/ERREUR.gif"><strong>Echec de l\'enregistrement</strong></p>'));

     panel('panel-success','Enregistrement réussi','<p> <img src="../images/ok.PNG">La Ligne de Commande a été enregistré correctement.</p>');
  }
  else
  {
     $sqlquery="update CONTENIR_CO set QTE_CO= QTE_CO + $_QTE_CO WHERE ID_A = $_ID_A AND ID_CO=$_ID_CO";
     $result=mysqli_query($sqlquery) or die(panel('panel-danger','Erreur d\'Ajout ','<p> <img src="../images/ERREUR.gif"><strong>Echec de l\'Ajout</strong></p>'));
     panel('panel-success','Ajout réussi','<p> <img src="../images/ok.PNG">La quantité  a été ajouté correctement.</p>');
  }
}
   
   echo '</div>';
     
   
      
    ?> 



</div>
 </td>

  </tr>

  

</table>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>