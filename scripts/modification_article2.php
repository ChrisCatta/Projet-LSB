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
    
    echo '<div class="col-xs-9 well3">';
   /* $uploaddir = '../images/';
    $uploadfile = $uploaddir . basename($_FILES['CHEMIN_IMG']['name']);
    
    if (move_uploaded_file($_FILES['CHEMIN_IMG']['tmp_name'], $uploadfile)) { 
      
      }
      else {
        $uploadfile=$_CHEMIN_IMG ;
        }*/
        
      $reqtype="SELECT * FROM TYPE WHERE ID_TYPE = '$_ID_TYPE'";
      $restype=mysqli_query($link,$reqtype);
      $rowtype=mysqli_fetch_array($restype,MYSQLI_ASSOC);
      $_TYPE=$rowtype['TYPE'];
      
      $reqfam="SELECT * FROM FAMILLE WHERE ID_FAM = '$_ID_FAM'";
      $resfam=mysqli_query($link,$reqfam);
      $rowfam=mysqli_fetch_array($resfam,MYSQLI_ASSOC);
      $_FAMILLE=$rowfam['FAMILLE'];
      
      $reqtar="SELECT * FROM TARIFS WHERE ID_TARIF = '$_ID_TARIF'";
      $restar=mysqli_query($link,$reqtar);
      $rowtar=mysqli_fetch_array($restar,MYSQLI_ASSOC);
      $_PRIX_U=$rowtar['MONTANTHT'];
      
      if($_TX>0){
      $_PV_HT = $_PRIX_U * $_TX;
        } else {
            $_PV_HT = $_PRIX_U;
        }
      
       $unite = $_UNITE;
                switch ($unite) {
                    case "M3";

                        $quantite  = $_LONGUEUR * $_LARGEUR/1000 * $_EPAISSEUR/1000;
                       $volume = $_LONGUEUR * $_LARGEUR/1000 * $_EPAISSEUR/1000;
                        break;
                    
                    case "M2";

                         $quantite = $_LONGUEUR * $_LARGEUR/1000;
                         $volume = $_LONGUEUR * $_LARGEUR/1000 * $_EPAISSEUR/1000;
                        break;

                    case "ML";
                         $quantite = $_LONGUEUR;
                        if ($_ID_FAM == 32 || $_ID_FAM == 34) {
                            $rayon = $_DIAMETRE / 2000;
                           $volume = ($rayon * $rayon) * 3.14 * $_LONGUEUR;
                        } elseif ($_ID_FAM == 33) {
                            $rayon = $_DIAMETRE / 2000;
                            $volume = (($rayon * $rayon) * 3.14) / 2 * $_LONGUEUR;
                        }
                        break;
                }
                if (!isset($quantite)) {
                     $quantite = 0.000;
                }
                if (!isset($volume)) {
                     $volume = 0.000;
                }
   
     $sqlquery="update ARTICLE set DESIGNATION='$_DESIGNATION', ID_TYPE='$_ID_TYPE', ID_FAMILLE ='$_ID_FAM', LONGUEUR='$_LONGUEUR', LARGEUR='$_LARGEUR', EPAISSEUR='$_EPAISSEUR', U_Pqt='$_U_Pqt', DIAMETRE='$_DIAMETRE', HAUTEUR='$_HAUTEUR',  QTE_STO ='$_QTE_STO', QTE_MIN='$_QTE_MIN', CHEMIN_IMG='$_CHEMIN_IMG', QTE='$quantite', VOL='$volume', UNITE='$_UNITE', ID_TARIF='$_ID_TARIF', PRIX_U ='$_PRIX_U', TX='$_TX', TYPE='$_TYPE',  FAMILLE='$_FAMILLE', PV_HT='$_PV_HT' WHERE ID_A='$_ID_A'";
     $result=mysqli_query($link,$sqlquery) or die(
      panel('panel-danger','Erreur de Modification 2','<p> <img src="../images/ERREUR.gif"><strong>Echec de la Modification</strong></p>'));
    
     panel('panel-success','Modification réussie','<p> <img src="../images/ok.PNG">L\'Article <strong> '.$_DESIGNATION.'</strong>  a été enregistré correctement.</p>');
  
    ?> 
 </div>
   </div>
<?php 
include('../modeles/pied.php'); ?>