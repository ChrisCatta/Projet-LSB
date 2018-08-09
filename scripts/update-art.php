<?php

session_start();
include('../modeles/enteteAdmin.php');

?>
<div class="row well3">
    <div class="col-xs-3">


        <?php

        include('../scripts/connexionDB.php');
        $retour = connexion();
        //$c=$retour[0];
        $link = $retour[0];

        include('../modeles/bar_menu.php');
        bar_tarif();

        ?>
    </div> 
    <div class="col-xs-9 well3">
        <?php

        if (isset($_POST['Submit'])) {
            $req = "SELECT * FROM ARTICLE ";
            $res = mysqli_query($link, $req) or exit(mysql_error());
            $rows = array();
            while ($ligne = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $rows[] = $ligne;
            }
            foreach ($rows as $ligne) {
                $idarticle = $ligne['ID_A'];
                $tx = $ligne['TX'];
                $tx = $tx / 100;
                $tx = $tx + 1;
                $des = $ligne['DESIGNATION'];
                $long = floatval($ligne['LONGUEUR']);
                $larg = intval($ligne['LARGEUR']);
                $ep = intval($ligne['EPAISSEUR']);
                $diam = intval($ligne['DIAMETRE']);
                $idtype = $ligne['ID_TYPE'];
                    $reqtyp = "SELECT * FROM TYPE WHERE ID_TYPE='$idtype'";
                    $restyp = mysqli_query($link, $reqtyp);
                    $rowtyp = mysqli_fetch_array($restyp, MYSQLI_ASSOC);
                    $type = $rowtyp['TYPE'];
                $idfamille = $ligne['ID_FAMILLE'];
                    $reqfam = "SELECT * FROM FAMILLE WHERE ID_FAM='$idfamille'";
                    $resfam = mysqli_query($link, $reqfam);
                    $rowfam = mysqli_fetch_array($resfam, MYSQLI_ASSOC);
                    $famille = $rowfam['FAMILLE'];
                $idtarif = $ligne['ID_TARIF'];
                    $req2 = "SELECT * FROM TARIFS WHERE ID_TARIF='$idtarif'";
                    $res2 = mysqli_query($link, $req2)or exit(mysql_error());
                    $row2 = mysqli_fetch_array($res2, MYSQLI_ASSOC);
                    $tarifht = floatval($row2['MONTANTHT']);
                    
                if($tx>0){
                $pvht = $tarifht * $tx;
                  } else {
                      $pvht = $tarifht;
                  }

                //recalcul qte unitaire en fonction de la famille

                $unite = $ligne['UNITE'];
                switch ($unite) {
                    case "M3";

                        $quantite  = $long * $larg/1000 * $ep/1000;
                       $volume = $long * $larg/1000 * $ep/1000;
                        break;
                    
                    case "M2";

                         $quantite = $long * $larg/1000;
                         $volume = $long * $larg/1000 * $ep/1000;
                        break;

                    case "ML";
                         $quantite = $long;
                        if ($idfamille == 32 || $idfamille == 34) {
                            $rayon = $diam / 2000;
                           $volume = ($rayon * $rayon) * 3.14 * $long;
                        } elseif ($idfamille == 33) {
                            $rayon = $diam / 2000;
                            $volume = (($rayon * $rayon) * 3.14) / 2 * $long;
                        }
                        break;
                }
                if (!isset($quantite)) {
                     $quantite = 0.000;
                }
                if (!isset($volume)) {
                     $volume = 0.000;
                }
                      // var_dump($tarifht, $pvht,$famille, $type, $quantite , $volume);
                $req1 = "UPDATE ARTICLE SET PRIX_U='$tarifht', PV_HT='$pvht', FAMILLE='$famille', TYPE='$type', QTE='$quantite', VOL='$volume'   WHERE ID_A='$idarticle'";
                $res1 = mysqli_query($link, $req1)or die(panel('panel-danger', 'Erreur de Mise à jour ', '<p> <img src="../images/ERREUR.gif"><strong>Echec de la Mise à jour</strong></p>'));
            }

            panel('panel-success', 'MAJ réussie', '<p> <img src="../images/ok.PNG">Les prix ont été correctement mis à jour.</p>');
        }
