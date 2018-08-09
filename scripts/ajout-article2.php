<?php

session_start();
include('../modeles/enteteAdmin.php');
        include('../scripts/connexionDB.php');
        $retour = connexion();
        //$c=$retour[0];
        $link = $retour[0];

?>
<div class="row">
    <div class="col-xs-3">
        <?php

        include('../modeles/bar_menu.php');
        bar_stock();
?>
         </div>
    <?php
        foreach ($_POST as $key => $value) {
            $varname = "_" . $key;
            $$varname = $value;
        }
        $_ID_TYPE = $_POST['ID_TYPE'];
        $_ID_FAM = $_POST['ID_FAM'];
        $_ID_TARIF = $_POST['ID_TARIF'];
      $reqtype="SELECT * FROM TYPE WHERE ID_TYPE='$_ID_TYPE'";
      $restype=mysqli_query($link,$reqtype);
      $rowtype=mysqli_fetch_array($restype,MYSQLI_ASSOC);
      $_TYPE=$rowtype['TYPE'];
      $reqfam="SELECT * FROM FAMILLE WHERE ID_FAM='$_ID_FAM'";
      $resfam=mysqli_query($link,$reqfam);
      $rowfam=mysqli_fetch_array($resfam,MYSQLI_ASSOC);
      $_FAMILLE=$rowfam['FAMILLE'];
      $reqtar="SELECT * FROM TARIFS WHERE ID_TARIF='$_ID_TARIF'";
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
        ?>
        <div class="col-xs-9 well3">
        <?php
        $sqlquery = "INSERT INTO article SET DESIGNATION='$_DESIGNATION', ID_TYPE='$_ID_TYPE', ID_FAMILLE='$_ID_FAM', LONGUEUR='$_LONGUEUR', LARGEUR='$_LARGEUR', EPAISSEUR='$_EPAISSEUR', U_Pqt='$_U_Pqt', DIAMETRE='$_DIAMETRE', HAUTEUR='$_HAUTEUR', QTE_STO='$_QTE_STO', QTE_MIN='$_QTE_MIN',  UNITE='$_UNITE',QTE='$quantite', VOL='$volume', ID_TARIF='$_ID_TARIF', TX='$_TX', TYPE='$_TYPE',  FAMILLE='$_FAMILLE', PV_HT='$_PV_HT', PRIX_U ='$_PRIX_U' ";
        $result = mysqli_query($link, $sqlquery) or die(panel('panel-danger', 'Erreur d\'enregistrement 1', '<p> <img src="../images/ERREUR.gif"><strong>Echec de l\'enregistrement</strong></p>'));
      
        panel('panel-success', 'Enregistrement réussi', '<p> <img src="../images/ok.PNG">L\'Article <strong>' . $_DESIGNATION . '</strong>  a été enregistré correctement.</p>');

        ?>
    </div>   
</div>
<?php include('../modeles/pied.php'); ?>