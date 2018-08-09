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
    bar_stock();
    echo ' </div> ';
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
   $_ID_FAMILLE=$_POST['ID_FAM'];
   $_PRIX_U=$_POST['ID_TARIF'];
    echo '<div class="col-xs-9 well3">';
  if($_article==1)
  {
    $uploaddir = '../images/';
    $uploadfile = $uploaddir . basename($_FILES['CHEMIN_IMG']['name']);
    
    if (move_uploaded_file($_FILES['CHEMIN_IMG']['tmp_name'], $uploadfile)) { }
      else {$uploadfile=NULL;}
     $sqlquery="INSERT INTO article SET DESIGNATION='$_DESIGNATION', ID_TYPE='$_ID_TYPE', ID_FAMILLE='$_ID_FAMILLE', LONGUEUR='$_LONGUEUR', LARGEUR='$_LARGEUR', EPAISSEUR='$_EPAISSEUR', U_Pqt='$_U_Pqt', DIAMETRE='$_DIAMETRE', HAUTEUR='$_HAUTEUR', QTE_STO='$_QTE_STO', QTE_MIN='$_QTE_MIN', CHEMIN_IMG='$uploadfile', UNITE='$_UNITE', ID_TARIF='$_ID_TARIF', TX='$_TX' ";
     $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur d\'enregistrement 1','<p> <img src="../images/ERREUR.gif"><strong>Echec de l\'enregistrement</strong></p>'));
     
     $sqlquery1="SELECT ID_A from ARTICLE ORDER BY ID_A DESC LIMIT 1";
     $result1=mysqli_query($link,$sqlquery1);
     $row=mysqli_fetch_array($result1,MYSQLI_ASSOC);
     $ID=$row['ID_A'];
     
     panel('panel-success','Enregistrement réussi','<p> <img src="../images/ok.PNG">L\'Article <strong>'.$_DESIGNATION.'</strong>  a été enregistré correctement.</p>');
  }
  else
  {
     $sqlquery="UPDATE ARTICLE set QTE_STO= QTE_STO + '$_QTE_STO' WHERE ID_A = '$_ID_A'";
     $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur d\'Ajout ','<p> <img src="../images/ERREUR.gif"><strong>Echec de l\'Ajout</strong></p>'));
     panel('panel-success','Ajout réussi','<p> <img src="../images/ok.PNG">La quantité  a été ajouté correctement.</p>');
  }
    ?>  
 </div>     
</div>
<?php 
include('../modeles/pied.php'); ?>