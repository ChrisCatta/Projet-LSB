<!DOCTYPE html>
<html lang="fr">
    <html>
        <head>
            <meta charset="utf-8" />
            <title>Devis</title>
            <link rel="stylesheet" type="text/css" href="../bootstrap/dist/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="../jquery/css/jquery-ui.css">
            <link rel="stylesheet" type="text/css" href="../DataTables/jquery.dataTables.min.css">
            <link rel="stylesheet" type="text/css" href="../bootstrap/dist/css/bootstrap-select.min.css">
            <link rel="stylesheet" type="text/css" href="../LSB.css">
            <!--////////////////////-->
            <style>
                .facture{
                    border: 1px solid #3a3a3a;
                    margin-bottom: 20px;
                    margin-top: 20px;
                }
                table{
                    margin-bottom: 20px;
                    border-collapse: collapse;
                }
                input {
                    display: inline;
                    white-space: nowrap;
                    border: 1px solid #999;
                }
                input:before {
                    content: attr(value);
                }
                .pagenum:before {
                    content: counter(page);
                }
            </style>
        </head>
        <body class="imp">
            <?php

            include('../scripts/conn.php');
            $retour = connexion();
//$c=$retour[0];
            $link = $retour[0];

            ?>
            <div class="container-imp">
                    <?php

                    if (isset($_POST['ID_DV'])) {
                        $ID_DV = $_POST['ID_DV'];
                        $comment1 = $_POST['comment1'];
                        $comment2 = $_POST['comment2'];
                        $comment3 = $_POST['comment3'];
                    }
                    if (isset($_GET['ID_DV'])) {
                        $ID_DV = $_GET['ID_DV'];
                        $comment1 = $_GET['comment1'];
                        $comment2 = $_GET['comment2'];
                        $comment3 = $_GET['comment3'];
                    }
                    $lettres = $_GET['lettres'];
                    $remise=$_GET['montremise'];
                    $txremise=$_GET['txremise'];
                    $sqlquery2 = "SELECT  L.ID_DV, sum((L.QTE_DV*A.QTE)*A.PV_HT) as 'THT', format(sum(A.VOL*L.QTE_DV),3,'fr_FR') as 'VOLDV'
               from CONTENIR_DV L, ARTICLE A
               where L.ID_DV='$ID_DV' AND A.ID_A=L.ID_A  ";
                    $result2 = mysqli_query($link, $sqlquery2);
                    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

                    $sqlquery1 = "SELECT D.ID_DV, D.REF_DV,  D.ID_C, D.DATE_DV, YEAR(D.DATE_DV) AS annee, CL.ID_C, CL.RAISSO_C, CL.ADRESSE_C, CL.ADRESSE1_C , CL.TEL_C, CL.EMAIL, CL.NIF, CL.STAT, DATE_FORMAT(D.DATE_DV, '%d/%m/%Y') AS date_fr
              FROM DEVIS D, CLIENT CL
              WHERE D.ID_DV='$ID_DV'  AND  CL.ID_C=D.ID_C";
                    $result1 = mysqli_query($link, $sqlquery1);
                    $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);

                    //The original date format.
                    $original = $row1['DATE_DV'];
                    list($year, $month, $day) = explode("-", $original);

                    //Explode the string into an array.
                    $exploded = explode("-", $original);

                    //Reverse the order.
                    $exploded = array_reverse($exploded);

                    //Convert it back into a string.
                    $newFormat = implode("/", $exploded);

                    ?>

                    <div class="row">
                        <div class="col-xs-5 ">
                            <div class="adresse">
                                <p><img src="../images/logo-lsb.png"  width="200px"/></p>
                                <div class="entete"> 
                                    B.P. 1140 - 301-Fianarantsoa <br>Madagascar<br>  
                                    +261 20 75 522 44 / 032 03 421 03<br>da.lsb@moov.mg - compta.lsb@moov.mg</div>
                            </div>
                        </div>
                        <div class="col-xs-3"> 
                            <!-- <h2 style="text-align: center;"><strong>Devis</strong></h2>-->
                        </div>
                        <div class="col-xs-4 ">
                            <span class="ligneCommande" style="text-align: left; top:0px;">Fianarantsoa le :<?php echo $newFormat; ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-5 ">
                            <h4><strong>Devis <span>N°:  <?php echo $row1['REF_DV'] . '/' . $year ?></span></strong></h4>
                        </div> 
                        <div class="col-xs-offset-3 col-xs-4">
                            <h4><?= $row1['RAISSO_C'] ?></h4>
                            <span class="ligneCommande"><?= $row1['ADRESSE_C'] ?></span><br>
                            <span class="ligneCommande"><?= $row1['ADRESSE1_C'] ?></span><br>
                            <span class="ligneCommande"><?= $row1['TEL_C'] ?></span><br>
                            <span class="ligneCommande"><?= $row1['EMAIL'] ?></span><br>
                            <span class="ligneCommande">NIF :<?= $row1['NIF'] ?></span><br>
                            <span class="ligneCommande">STAT :<?= $row1['STAT'] ?></span><br>
                            <span class="ligneCommande">RC :<?= $row1['NIF'] ?></span><br>
                            <span class="ligneCommande">CIF :<?= $row1['STAT'] ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <?php

                        $req = "select *  FROM UNITE ";
                        $res = mysqli_query($link, $req) or exit(mysql_error());
                        $rows = array();
                        while ($ligne = mysqli_fetch_array($res)) {
                            $rows[] = $ligne;
                        }
                        //pour chaque type d'unité
                        foreach ($rows as $ligne) {
                            $unite = $ligne['UNITE'];
                            switch ($unite) {
                                case "M3";
                                    //cas des bois brut
                                    $type1 = 1;

                                    $reqNLC = "SELECT A.UNITE, A.QTE, A.VOL, A.ID_A, A.ID_TYPE, A.DESIGNATION, A.LONGUEUR, A.LARGEUR, A.UNITE, A.EPAISSEUR, A.DIAMETRE, A.PV_HT, A.FAMILLE, A.TYPE, C.ID_DV, C.ID_DV_LIGNE, C.QTE_DV, C.RABOT, C.SEC, (C.QTE_DV*A.QTE)*A.PV_HT as 'MONTANT'
              FROM  ARTICLE A, CONTENIR_DV C
              WHERE  C.ID_DV='$ID_DV' AND A.ID_A=C.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$type1' order by A.A.LONGUEUR DESC";

                                    $resNLC = mysqli_query($link, $reqNLC);
                                    $nombreNLC = mysqli_num_rows($resNLC);
                                    if ($nombreNLC > 0) {

                                        ?>          
                                        <table class="info saut" border="1">
                                            <thead>  
                                                <tr class="info">
                                                    <th width="25%"><strong>Produit</strong></th>
                                                    <th width="6%"><strong>Quantité</strong></th>
                                                    <th width="7%"><strong>Longueur</strong></th>
                                                    <th width="7%"><strong>Largeur</strong></th>
                                                    <th width="7%"><strong>Epaisseur</strong></th>
                                                    <th width="7%"><strong></strong></th>
                                                    <th width="7%"><strong>M3</strong></th>
                                                    <th width="15%"><strong>Prix unitaire</strong></th>
                                                    <th width="15%"><strong>Montant</strong></th>


                                                </tr>
                                            </thead>
                                            <?php

                                            $MONTANTNLC = 0;
                                            $VOLUMENLC = 0;
                                            $suppNLC=0;
                                            while ($rowNLC = mysqli_fetch_array($resNLC, MYSQLI_ASSOC)) {

                                                    if($rowNLC['RABOT']==1){
                                                        $text= " (Raboté) ";
                                                    }
                                                     else {
                                                        $text="";
                                                    }   
                                                ?>
                                                <tr>
                                                    <td><?= $rowNLC['FAMILLE'].$text ?></td>
                                                    <td><?php echo $rowNLC['QTE_DV'] ?></td>
                                                    <td><?php echo $rowNLC['LONGUEUR'] ?></td>
                                                    <td><?php echo $rowNLC['LARGEUR'] ?></td>
                                                    <td><?php echo $rowNLC['EPAISSEUR'] ?></td>
                                                    <td></td>
                                                    <td style="text-align:right"> <?php echo number_format($rowNLC['VOL'] * $rowNLC['QTE_DV'], 3, ',', ' ') ?></td>
                                                    <td style="text-align:right"><?php echo number_format($rowNLC['PV_HT'], 0, ',', ' ') . " Ar" ?></td>
                                                    <?php if ($rowNLC['ID_TYPE']==="1") {
                    if ($rowNLC['RABOT']=='1'){  
                    $reqrab="SELECT * FROM TARIFS WHERE TARIF='Rabotage'";
                    $resrab=mysqli_query($link,$reqrab);
                    $rowrab= mysqli_fetch_array($resrab);
                    $montsupprabot=$rowrab['MONTANTHT'];
                    $textsupprabot='Rabotage ';
                    $montsupprabot=number_format($montsupprabot, 0, ',', ' ') .' Ar';
                    } 
                    else{
                     $montsupprabot=''  ;
                    $textsupprabot='';
                    } 
                    if ($rowNLC['SEC']=='1'){ 
                   
                    $textsuppsec='Bois sec';
                    $reqsec="SELECT * FROM TARIFS WHERE ID_TARIF=102";
                    $ressec=mysqli_query($link,$reqsec);
                    $rowsec= mysqli_fetch_array($ressec);
                    $montsuppsec=$rowsec['MONTANTHT'];
                    $textsuppsec='Bois sec ';
                     $montsuppsec= number_format($montsuppsec, 0, ',', ' ') .' Ar';
                    }
                    else {
                    $montsuppsec  =''; 
                    $textsuppsec='';
                        
                    } 
                    
                    }?>
                                                  
                                                    <td style="text-align:right"><?php echo number_format($rowNLC['MONTANT'], 0, ',', ' ') . " Ar" ?></td>
                                                </tr>
                                                <?php

                                                $VOLUMENLC = $VOLUMENLC + $rowNLC['VOL'] * $rowNLC['QTE_DV'];
                                                                    $suppNLC = $suppNLC + $rowNLC['VOL'] * $rowNLC['QTE_DV'] * 70000;
                                                                }
                                                                $sqlquery3NLC = "SELECT  A.UNITE, sum((L.QTE_DV*A.QTE)*A.PV_HT) as 'THT', sum((L.QTE_DV*A.QTE)*A.PV_HT*(1+0.20)) as 'TTC', sum(A.VOL*L.QTE_DV) as 'VOLDV'
               from CONTENIR_DV L, ARTICLE A
               where L.ID_DV='$ID_DV' AND A.ID_A=L.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$type1'";
                                                                $result3NLC = mysqli_query($link, $sqlquery3NLC);
                                                                $row3NLC = mysqli_fetch_array($result3NLC, MYSQLI_ASSOC);

                                                                ?>
                                                                <tr>
                                                                    <td colspan="6" class="success"><strong> <?=$textsupprabot.$textsuppsec?> </strong></td>
                                                                    <td></td>
                                                                    <td class="" style="text-align:right"><strong><?=$montsupprabot.$montsuppsec?></strong></td>
                                                                    <td class="" style="text-align:right"><strong><?php echo number_format($suppNLC, 0, ',', ' ') . " Ar" ?></strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6" class="success"><strong>Total</strong></td>
                                                                    <td class="" style="text-align:right"><strong><?php echo number_format($VOLUMENLC, 3, ',', ' ') ?></strong></td>
                                                                    <td></td>
                                                                    <td class="" style="text-align:right"><strong><?php echo number_format($row3NLC['THT'] + $suppNLC, 0, ',', ' ') . " Ar" ?></strong></td>
                                                                </tr>
                                                        </table>
                                                        <?php

                                                    }


                                                    $type6 = 6;

                                    $reqLC = "SELECT A.UNITE, A.QTE, A.VOL, A.ID_A, A.ID_TYPE, A.DESIGNATION, A.LONGUEUR, A.LARGEUR, A.UNITE, A.EPAISSEUR, A.DIAMETRE, A.PV_HT, A.FAMILLE, A.TYPE, C.ID_DV, C.ID_DV_LIGNE, C.QTE_DV, (C.QTE_DV*A.QTE)*A.PV_HT as 'MONTANT'
      FROM  ARTICLE A, CONTENIR_DV C
      WHERE  C.ID_DV='$ID_DV' AND A.ID_A=C.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$type6' order by A.LONGUEUR DESC";

                                    $resLC = mysqli_query($link, $reqLC);
                                    $nombreLC = mysqli_num_rows($resLC);

                                    if ($nombreLC > 0) {

                                        ?>          
                                        <table class="info saut" border="1">
                                            <thead>  
                                                <tr class="info">
                                                    <th width="25%"><strong>Produit</strong></th>
                                                    <th width="6%"><strong>Quantité</strong></th>
                                                    <th width="7%"><strong>Longueur</strong></th>
                                                    <th width="7%"><strong>Largeur</strong></th>
                                                    <th width="7%"><strong>Epaisseur</strong></th>
                                                    <th width="7%"><strong></strong></th>
                                                    <th width="7%"><strong>M3</strong></th>
                                                    <th width="15%"><strong>Prix unitaire</strong></th>
                                                    <th width="15%"><strong>Montant</strong></th>
                                                </tr>
                                            </thead>
                                            <?php

                                            $MONTANTLC = 0;
                                            $VOLUMELC = 0;
                                            while ($rowLC = mysqli_fetch_array($resLC, MYSQLI_ASSOC)) {

                                                ?>
                                                <tr>
                                                    <td><?= $rowLC['FAMILLE'] ?></td>
                                                    <td><?php echo $rowLC['QTE_DV'] ?></td>
                                                    <td><?php echo $rowLC['LONGUEUR'] ?></td>
                                                    <td><?php echo $rowLC['LARGEUR'] ?></td>
                                                    <td><?php echo $rowLC['EPAISSEUR'] ?></td>
                                                    <td></td>
                                                    <td style="text-align:right"> <?php echo number_format($rowLC['VOL'] * $rowLC['QTE_DV'], 3, ',', ' ') ?></td>
                                                    <td style="text-align:right"><?php echo number_format($rowLC['PV_HT'], 0, ',', ' ') . " Ar" ?></td>
                                                    <td style="text-align:right"><?php echo number_format($rowLC['MONTANT'], 0, ',', ' ') . " Ar" ?></td>
                                                </tr>
                                                <?php

                                                $VOLUMELC = $VOLUMELC + $rowLC['VOL'] * $rowLC['QTE_DV'];
                                            }
                                            $sqlquery3LC = "SELECT  A.UNITE, A.ID_TYPE ,  sum((L.QTE_DV*A.QTE)*A.PV_HT) as 'THT', sum((L.QTE_DV*A.QTE)*A.PV_HT*(1+0.20)) as 'TTC', sum(A.VOL*L.QTE_DV) as 'VOLDV'
               from CONTENIR_DV L, ARTICLE A
               where L.ID_DV='$ID_DV' AND A.ID_A=L.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$type6'";
                                            if ($result3LC = mysqli_query($link, $sqlquery3LC)) {
                                                $row3LC = mysqli_fetch_array($result3LC, MYSQLI_ASSOC);
                                            }

                                            ?>
                                            <td colspan="6" class="success"><strong>Total</strong></td>
                                            <td class="" style="text-align:right"><strong><?php echo number_format($VOLUMELC, 3, ',', ' ') ?></strong></td>
                                            <td></td>
                                            <td class="" style="text-align:right"><strong><?php echo number_format($row3LC['THT'], 0, ',', ' ') . " Ar" ?></strong></td>
                                            </tr>
                                        </table>
                                        
                                        <?php

                                    }

                                    break;
                                case "M2";
                                    //si M2 type egal a peindre
                                    $type9 = 9;
                                    for ($i = 35; $i <= 40; $i++) {

                                        $reqAP = "SELECT A.UNITE, A.QTE, A.VOL, A.ID_A, A.ID_TYPE, A.DESIGNATION, A.LONGUEUR, A.LARGEUR, A.UNITE, A.EPAISSEUR, A.DIAMETRE, A.PV_HT, A.FAMILLE, A.TYPE, C.ID_DV, C.ID_DV_LIGNE, C.QTE_DV, (C.QTE_DV*A.QTE)*A.PV_HT as 'MONTANT'
      FROM  ARTICLE A, CONTENIR_DV C
      WHERE  C.ID_DV='$ID_DV' AND A.ID_A=C.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$type9' AND A.ID_FAMILLE='$i' order by A.LONGUEUR DESC";

                                        $resAP = mysqli_query($link, $reqAP);
                                        $nombreAP = mysqli_num_rows($resAP);

                                        if ($nombreAP > 0) {

                                            ?>          
                                            <table class="info saut" border="1">
                                                <thead>  
                                                    <tr class="info">
                                                        <th width="25%"><strong>A peindre</strong></th>
                                                        <th width="6%"><strong>Quantité</strong></th>
                                                        <th width="7%"><strong>Longueur</strong></th>
                                                        <th width="7%"><strong>Largeur</strong></th>
                                                        <th width="7%"><strong>Epaisseur</strong></th>
                                                        <th width="7%"><strong>M2</strong></th>
                                                        <th width="7%"><strong>M3</strong></th>
                                                        <th width="15%"><strong>Prix unitaire</strong></th>
                                                        <th width="15%"><strong>Montant</strong></th>


                                                    </tr>
                                                </thead>
                                                <?php

                                                $MONTANT = 0;
                                                $VOLUME = 0;
                                                $SURFACE = 0;
                                                while ($rowAP = mysqli_fetch_array($resAP, MYSQLI_ASSOC)) {

                                                    ?>
                                                    <tr>
                                                        <td><?= $rowAP['FAMILLE'] ?></td>
                                                        <td><?php echo $rowAP['QTE_DV'] ?></td>
                                                        <td><?php echo $rowAP['LONGUEUR'] ?></td>
                                                        <td><?php echo $rowAP['LARGEUR'] ?></td>
                                                        <td><?php echo $rowAP['EPAISSEUR'] ?></td>
                                                        <td style="text-align:right"> <?php echo number_format($rowAP['QTE'] * $rowAP['QTE_DV'], 3, ',', ' ') ?></td>
                                                        <td style="text-align:right"> <?php echo number_format($rowAP['VOL'] * $rowAP['QTE_DV'], 3, ',', ' ') ?></td>
                                                        <td style="text-align:right"><?php echo number_format($rowAP['PV_HT'], 0, ',', ' ') ?></td>
                                                        <td style="text-align:right"><?php echo number_format($rowAP['MONTANT'], 0, ',', ' ') ?></td>
                                                    </tr>
                                                    <?php

                                                    $VOLUME = $VOLUME + $rowAP['VOL'] * $rowAP['QTE_DV'];
                                                    $SURFACE = $SURFACE + $rowAP['QTE'] * $rowAP['QTE_DV'];
                                                }
                                                $sqlqueryAP3 = "SELECT  A.UNITE, sum((L.QTE_DV*A.QTE)*A.PV_HT) as 'THT', sum((L.QTE_DV*A.QTE)*A.PV_HT*(1+0.20)) as 'TTC', sum(A.VOL*L.QTE_DV) as 'VOLDV'
               from CONTENIR_DV L, ARTICLE A
               where L.ID_DV='$ID_DV' AND A.ID_A=L.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$type9' AND A.ID_FAMILLE='$i'";
                                                if ($resultAP3 = mysqli_query($link, $sqlqueryAP3)) {
                                                    $rowAP3 = mysqli_fetch_array($resultAP3, MYSQLI_ASSOC);
                                                }

                                                ?>
                                                <td colspan="6" class="success"><strong>Total</strong></td>
                                                <td class="" style="text-align:right"><strong><?php echo number_format($VOLUME, 3, ',', ' ') ?></strong></td>
                                                <td></td>
                                                <td class="" style="text-align:right"><strong><?php echo number_format($rowAP3['THT'], 0, ',', ' ') ?></strong></td>
                                                </tr>
                                            </table>
                                            
                                            <?php

                                        }
                                    }
                                    //M2 type a vernir
                                    $type3 = 3;
                                    for ($i = 7; $i <= 14; $i++) {

                                        $reqAV = "SELECT A.UNITE, A.QTE, A.VOL, A.ID_A, A.ID_TYPE, A.DESIGNATION, A.LONGUEUR, A.LARGEUR, A.UNITE, A.EPAISSEUR, A.DIAMETRE, A.PV_HT, A.FAMILLE, A.TYPE, C.ID_DV, C.ID_DV_LIGNE, C.QTE_DV, (C.QTE_DV*A.QTE)*A.PV_HT as 'MONTANT'
      FROM  ARTICLE A, CONTENIR_DV C
      WHERE  C.ID_DV='$ID_DV' AND A.ID_A=C.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$type3' AND A.ID_FAMILLE='$i'  order by A.LONGUEUR DESC";

                                        $resAV = mysqli_query($link, $reqAV);
                                        $nombreAV = mysqli_num_rows($resAV);

                                        if ($nombreAV > 0) {

                                            ?>          
                                            <table class="info saut" border="1">
                                                <thead>  
                                                    <tr class="info">
                                                        <th width="25%"><strong>A vernir</strong></th>
                                                        <th width="6%"><strong>Quantité</strong></th>
                                                        <th width="7%"><strong>Longueur</strong></th>
                                                        <th width="7%"><strong>Largeur</strong></th>
                                                        <th width="7%"><strong>Epaisseur</strong></th>
                                                        <th width="7%"><strong>M2</strong></th>
                                                        <th width="7%"><strong>M3</strong></th>
                                                        <th width="15%"><strong>Prix unitaire</strong></th>
                                                        <th width="15%"><strong>Montant</strong></th>


                                                    </tr>
                                                </thead>
                                                <?php

                                                $MONTANT = 0;
                                                $VOLUME = 0;
                                                $SURFACE = 0;
                                                while ($rowAV = mysqli_fetch_array($resAV, MYSQLI_ASSOC)) {

                                                    ?>
                                                    <tr>
                                                        <td><?= $rowAV['FAMILLE'] ?></td>
                                                        <td><?php echo $rowAV['QTE_DV'] ?></td>
                                                        <td><?php echo $rowAV['LONGUEUR'] ?></td>
                                                        <td><?php echo $rowAV['LARGEUR'] ?></td>
                                                        <td><?php echo $rowAV['EPAISSEUR'] ?></td>
                                                        <td style="text-align:right"> <?php echo number_format($rowAV['QTE'] * $rowAV['QTE_DV'], 3, ',', ' ') ?></td>
                                                        <td style="text-align:right"> <?php echo number_format($rowAV['VOL'] * $rowAV['QTE_DV'], 3, ',', ' ') ?></td>
                                                        <td style="text-align:right"><?php echo number_format($rowAV['PV_HT'], 0, ',', ' ') ?></td>
                                                        <td style="text-align:right"><?php echo number_format($rowAV['MONTANT'], 0, ',', ' ') ?></td>
                                                    </tr>
                                                    <?php

                                                    $VOLUME = $VOLUME + $rowAV['VOL'] * $rowAV['QTE_DV'];
                                                    $SURFACE = $SURFACE + $rowAV['QTE'] * $rowAV['QTE_DV'];
                                                }
                                                $sqlqueryAV3 = "SELECT  A.UNITE, sum((L.QTE_DV*A.QTE)*A.PV_HT) as 'THT', sum((L.QTE_DV*A.QTE)*A.PV_HT*(1+0.20)) as 'TTC', sum(A.VOL*L.QTE_DV) as 'VOLDV'
               from CONTENIR_DV L, ARTICLE A
               where L.ID_DV='$ID_DV' AND A.ID_A=L.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$type3' AND A.ID_FAMILLE='$i'";
                                                $resultAV3 = mysqli_query($link, $sqlqueryAV3);
                                                $rowAV3 = mysqli_fetch_array($resultAV3, MYSQLI_ASSOC);

                                                ?>
                                                <td colspan="6" class="success"><strong>Total</strong></td>
                                                <td class="" style="text-align:right"><strong><?php echo number_format($VOLUME, 3, ',', ' ') ?></strong></td>
                                                <td></td>
                                                <td class="" style="text-align:right"><strong><?php echo number_format($rowAV3['THT'], 0, ',', ' ') ?></strong></td>
                                                </tr>
                                            </table>
                                            
                                            <?php

                                        }
                                    }
                                    break;
                                case "ML";
                                    // ML à peindre
                                    $typeML3 = 3;
                                    for ($i = 14; $i <= 21; $i++) {

                                        $reqML = "SELECT A.UNITE, A.QTE, A.VOL, A.ID_A, A.ID_FAMILLE, A.DESIGNATION, A.LONGUEUR, A.LARGEUR, A.UNITE, A.EPAISSEUR, A.DIAMETRE, A.PV_HT, A.FAMILLE, A.TYPE, C.ID_DV, C.ID_DV_LIGNE, C.QTE_DV, (C.QTE_DV*A.LONGUEUR)*A.PV_HT as 'MONTANT'
              FROM  ARTICLE A, CONTENIR_DV C
              WHERE  C.ID_DV='$ID_DV' AND A.ID_A=C.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$typeML3' AND A.ID_FAMILLE='$i' order by A.LONGUEUR DESC";

                                        $resML = mysqli_query($link, $reqML);
                                        $nombreML = mysqli_num_rows($resML);

                                        if ($nombreML > 0) {

                                            ?>          
                                            <table class="info saut" border="1">
                                                <thead>  
                                                    <tr class="info">
                                                        <th width="25%"><strong>A peindre</strong></th>
                                                        <th width="6%"><strong>Quantité</strong></th>
                                                        <th width="7%"><strong>Longueur</strong></th>
                                                        <th width="7%"><strong>Largeur</strong></th>
                                                        <th width="7%"><strong>Epaisseur</strong></th>
                                                        <th width="7%"><strong>ML</strong></th>
                                                        <th width="7%"><strong>M3</strong></th>
                                                        <th width="15%"><strong>Prix unitaire</strong></th>
                                                        <th width="15%"><strong>Montant</strong></th>


                                                    </tr>
                                                </thead>
                                                <?php

                                                $MONTANTML = 0;
                                                $VOLUMEML = 0;
                                                $LONGUEURML = 0;
                                                while ($rowML = mysqli_fetch_array($resML, MYSQLI_ASSOC)) {

                                                    ?>
                                                    <tr>
                                                        <td><?= $rowML['FAMILLE'] ?></td>
                                                        <td><?php echo $rowML['QTE_DV'] ?></td>
                                                        <td><?php echo $rowML['LONGUEUR'] ?></td>
                                                        <td><?php echo $rowML['LARGEUR'] ?></td>
                                                        <td><?php echo $rowML['EPAISSEUR'] ?></td>
                                                        <td style="text-align:right"> <?php echo number_format($rowML['LONGUEUR'] * $rowML['QTE_DV'], 3, ',', ' ') ?></td>
                                                        <td style="text-align:right"> <?php echo number_format($rowML['VOL'] * $rowML['QTE_DV'], 3, ',', ' ') ?></td>
                                                        <td style="text-align:right"><?php echo number_format($rowML['PV_HT'], 0, ',', ' ') . " Ar" ?></td>
                                                        <td style="text-align:right"><?php echo number_format($rowML['MONTANT'], 0, ',', ' ') . " Ar" ?></td>
                                                    </tr>
                                                    <?php

                                                    $VOLUMEML = $VOLUMEML + $rowML['VOL'] * $rowML['QTE_DV'];

                                                    $LONGUEURML = $LONGUEURML + $rowML['LONGUEUR'] * $rowML['QTE_DV'];
                                                }
                                                $sqlquery3ML = "SELECT  sum((L.QTE_DV*A.LONGUEUR)*A.PV_HT) as 'THT', sum((L.QTE_DV*A.LONGUEUR)*A.PV_HT*(1+0.20)) as 'TTC', sum(A.VOL*L.QTE_DV) as 'VOLDV', sum(A.QTE*L.QTE_DV) as 'QTEDV'
               from CONTENIR_DV L, ARTICLE A
               where L.ID_DV='$ID_DV' AND A.ID_A=L.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$typeML3' AND A.ID_FAMILLE='$i'";
                                                if ($result3ML = mysqli_query($link, $sqlquery3ML)) {
                                                    $row3ML = mysqli_fetch_array($result3ML, MYSQLI_ASSOC);
                                                }

                                                ?>
                                                <td colspan="5" class="success"><strong>Total</strong></td>
                                                <td class="" style="text-align:right"><strong><?php echo number_format($LONGUEURML, 3, ',', ' ') ?></strong></td>
                                                <td class="" style="text-align:right"><strong><?php echo number_format($VOLUMEML, 3, ',', ' ') ?></strong></td>
                                                <td></td>
                                                <td class="" style="text-align:right"><strong><?php echo number_format($row3ML['THT'], 0, ',', ' ') . " Ar" ?></strong></td>
                                                </tr>
                                            </table>
                                             
                                            <?php

                                        }
                                    }

                                    //pour ML à vernir type=9
                                    $typeML9 = 9;
                                    for ($i = 41; $i <= 48; $i++) {
                                        $reqT9 = "SELECT A.UNITE, A.QTE, A.VOL, A.ID_A, A.ID_FAMILLE, A.DESIGNATION, A.LONGUEUR, A.LARGEUR, A.UNITE, A.EPAISSEUR, A.DIAMETRE, A.PV_HT, A.FAMILLE, A.TYPE, C.ID_DV, C.ID_DV_LIGNE, C.QTE_DV, (C.QTE_DV*A.QTE)*A.PV_HT as 'MONTANT'
      FROM  ARTICLE A, CONTENIR_DV C
      WHERE  C.ID_DV='$ID_DV' AND A.ID_A=C.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$typeML9' AND A.ID_FAMILLE='$i' order by A.LONGUEUR DESC";

                                        $resT9 = mysqli_query($link, $reqT9);
                                        $nombreT9 = mysqli_num_rows($resT9);

                                        if ($nombreT9 > 0) {

                                            ?>          
                                            <table class="info saut" border="1">
                                                <thead>  
                                                    <tr class="info">
                                                        <th width="25%"><strong>A peindre</strong></th>
                                                        <th width="6%"><strong>Quantité</strong></th>
                                                        <th width="7%"><strong>Longueur</strong></th>
                                                        <th width="7%"><strong>Largeur</strong></th>
                                                        <th width="7%"><strong></strong></th>
                                                        <th width="7%"><strong>ML</strong></th>
                                                        <th width="7%"><strong>M3</strong></th>
                                                        <th width="15%"><strong>Prix unitaire</strong></th>
                                                        <th width="15%"><strong>Montant</strong></th>
                                                    </tr>
                                                </thead>
                                                <?php

                                                $MONTANTT9 = 0;
                                                $VOLUMET9 = 0;
                                                $LONGUEURT9 = 0;
                                                while ($rowT9 = mysqli_fetch_array($resT9, MYSQLI_ASSOC)) {

                                                    ?>
                                                    <tr>
                                                        <td><?= $rowT9['FAMILLE'] ?></td>
                                                        <td><?php echo $rowT9['QTE_DV'] ?></td>
                                                        <td><?php echo $rowT9['LONGUEUR'] ?></td>
                                                        <td><?php echo $rowT9['LARGEUR'] ?></td>
                                                        <td></td>
                                                        <td style="text-align:right"> <?php echo number_format($rowT9['LONGUEUR'] * $rowT9['QTE_DV'], 3, ',', ' ') ?></td>
                                                        <td style="text-align:right"> <?php echo number_format($rowT9['VOL'] * $rowT9['QTE_DV'], 3, ',', ' ') ?></td>
                                                        <td style="text-align:right"><?php echo number_format($rowT9['PV_HT'], 0, ',', ' ') . " Ar" ?></td>
                                                        <td style="text-align:right"><?php echo number_format($rowT9['MONTANT'], 0, ',', ' ') . " Ar" ?></td>
                                                    </tr>
                                                    <?php

                                                    $VOLUMET9 = $VOLUMET9 + $rowT9['VOL'] * $rowT9['QTE_DV'];
                                                    $LONGUEURT9 = $LONGUEURT9 + $rowT9['LONGUEUR'] * $rowT9['QTE_DV'];
                                                }
                                                $sqlquery3T9 = "SELECT  A.UNITE, A.ID_FAMILLE ,  sum((L.QTE_DV*A.QTE)*A.PV_HT) as 'THT', sum((L.QTE_DV*A.QTE)*A.PV_HT*(1+0.20)) as 'TTC', sum(A.VOL*L.QTE_DV) as 'VOLDV'
               from CONTENIR_DV L, ARTICLE A
               where L.ID_DV='$ID_DV' AND A.ID_A=L.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$typeML9' AND A.ID_FAMILLE='$i'";
                                                if ($result3T9 = mysqli_query($link, $sqlquery3T9)) {
                                                    $row3T9 = mysqli_fetch_array($result3T9, MYSQLI_ASSOC);
                                                }

                                                ?>
                                                <td colspan="5" class="success"><strong>Total</strong></td>
                                                <td class="" style="text-align:right"><strong><?php echo number_format($LONGUEURT9, 3, ',', ' ') ?></strong></td>
                                                <td class="" style="text-align:right"><strong><?php echo number_format($VOLUMET9, 3, ',', ' ') ?></strong></td>
                                                <td></td>
                                                <td class="" style="text-align:right"><strong><?php echo number_format($row3T9['THT'], 0, ',', ' ') . " Ar" ?></strong></td>
                                                </tr>
                                            </table>
                                            
                                            <?php

                                        }
                                    }

                                    $type7 = 7;
                                    for ($i = 32; $i <= 34; $i++) {
                                        $reqBR = "SELECT A.UNITE, A.QTE, A.VOL, A.ID_A, A.ID_FAMILLE, A.DESIGNATION, A.LONGUEUR, A.LARGEUR, A.UNITE, A.EPAISSEUR, A.DIAMETRE, A.PV_HT, A.FAMILLE, A.TYPE, C.ID_DV, C.ID_DV_LIGNE, C.QTE_DV, (C.QTE_DV*A.QTE)*A.PV_HT as 'MONTANT'
      FROM  ARTICLE A, CONTENIR_DV C
      WHERE  C.ID_DV='$ID_DV' AND A.ID_A=C.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$type7' AND A.ID_FAMILLE='$i' order by A.LONGUEUR DESC";

                                        $resBR = mysqli_query($link, $reqBR);
                                        $nombreBR = mysqli_num_rows($resBR);
                                        if ($nombreBR > 0) {

                                            ?>          
                                            <table class="info saut" border="1">
                                                <thead>  
                                                    <tr class="info">
                                                        <th width="25%"><strong>Produit</strong></th>
                                                        <th width="6%"><strong>Quantité</strong></th>
                                                        <th width="7%"><strong>Longueur</strong></th>
                                                        <th width="7%"><strong>Diametre</strong></th>
                                                        <th width="7%"><strong></strong></th>
                                                        <th width="7%"><strong>ML</strong></th>
                                                        <th width="7%"><strong>M3</strong></th>
                                                        <th width="15%"><strong>Prix unitaire</strong></th>
                                                        <th width="15%"><strong>Montant</strong></th>
                                                    </tr>
                                                </thead>
                                                <?php

                                                $MONTANTBR = 0;
                                                $VOLUMEBR = 0;
                                                $LONGUEURBR = 0;
                                                while ($rowBR = mysqli_fetch_array($resBR, MYSQLI_ASSOC)) {

                                                    ?>
                                                    <tr>
                                                        <td><?= $rowBR['FAMILLE'].'-'.$rowBR['DIAMETRE'] ?></td>
                                                        <td><?php echo $rowBR['QTE_DV'] ?></td>
                                                        <td><?php echo $rowBR['LONGUEUR'] ?></td>
                                                        <td><?php echo $rowBR['DIAMETRE'] ?></td>
                                                        <td></td>
                                                        <td style="text-align:right"> <?php echo number_format($rowBR['LONGUEUR'] * $rowBR['QTE_DV'], 3, ',', ' ') ?></td>
                                                        <td style="text-align:right"> <?php echo number_format($rowBR['VOL'] * $rowBR['QTE_DV'], 3, ',', ' ') ?></td>
                                                        <td style="text-align:right"><?php echo number_format($rowBR['PV_HT'], 0, ',', ' ') . " Ar" ?></td>
                                                        <td style="text-align:right"><?php echo number_format($rowBR['MONTANT'], 0, ',', ' ') . " Ar" ?></td>
                                                    </tr>
                                                    <?php

                                                    $VOLUMEBR = $VOLUMEBR + $rowBR['VOL'] * $rowBR['QTE_DV'];
                                                    $LONGUEURBR = $LONGUEURBR + $rowBR['LONGUEUR'] * $rowBR['QTE_DV'];
                                                }
                                                $sqlquery3BR = "SELECT  A.UNITE, A.ID_FAMILLE ,  sum((L.QTE_DV*A.QTE)*A.PV_HT) as 'THT', sum((L.QTE_DV*A.QTE)*A.PV_HT*(1+0.20)) as 'TTC', sum(A.VOL*L.QTE_DV) as 'VOLDV'
               from CONTENIR_DV L, ARTICLE A
               where L.ID_DV='$ID_DV' AND A.ID_A=L.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$type7' AND A.ID_FAMILLE='$i'";
                                                if ($result3BR = mysqli_query($link, $sqlquery3BR)) {
                                                    $row3BR = mysqli_fetch_array($result3BR, MYSQLI_ASSOC);
                                                }

                                                ?>
                                                <td colspan="5" class="success"><strong>Total</strong></td>
                                                <td class="" style="text-align:right"><strong><?php echo number_format($LONGUEURBR, 3, ',', ' ') ?></strong></td>
                                                <td class="" style="text-align:right"><strong><?php echo number_format($VOLUMEBR, 3, ',', ' ') ?></strong></td>
                                                <td></td>
                                                <td class="" style="text-align:right"><strong><?php echo number_format($row3BR['THT'], 0, ',', ' ') . " Ar" ?></strong></td>
                                                </tr>
                                            </table>
                                            
                                            <?php

                                        }
                                    }
                                    break;
                            }
                        }
$montHT=$row2['THT']-$remise;
$montTVA=($row2['THT']-$remise)*0.2;
$montTTC=$montHT+$montTVA;
                        ?>
                        <table class="info saut" border="1" >
                       <!--  <tr><td colspan="9">&nbsp;</td></tr>-->
                            <tr>
                                <td style="width:60%" class="success"><strong>TOTAL</strong></td>
                                <td style="text-align:right ;width:7%"><strong><?php echo $row2['VOLDV'] ?></strong></td>
                                <td  style="width:15%"></td>
                                <td  style="text-align:right; width:15%"><strong><?php echo number_format($row2['THT'], 0, ',', ' ') . " Ar" ?></strong></td>
                            </tr>
                            <tr>
                                <td style="width:60%" class="success noborder" style="border-right: none;"><strong>Remise <?=$txremise?>% </strong></td>
                                <td  style="width:7%" class="noborder"></td>
                                <td  style="width:15%" class="noborder"></td>
                                <td style="width:15%; text-align:right"><strong><?php echo number_format($remise, 0, ',', ' ') . " Ar" ?></strong></td>
                            </tr>
                            <tr>
                                <td style="width:60%" class="success noborder" style="border-right: none;"><strong>Total après Remise</strong></td>
                                <td  style="width:7%" class="noborder"></td>
                                <td  style="width:15%" class="noborder"></td>
                                <td style="width:15%; text-align:right"><strong><?php echo number_format($montHT, 0, ',', ' ') . " Ar" ?></strong></td>
                            </tr>
                            <tr>
                                <td style="width:60%" class="success noborder" style="border-right: none;"><strong>TVA 20%</strong></td>
                                <td  style="width:7%" class="noborder"></td>
                                <td  style="width:15%" class="noborder"></td>
                                <td style="width:15%; text-align:right"><strong><?php echo number_format($montTVA, 0, ',', ' ') . " Ar" ?></strong></td>
                            </tr>
                            <tr>
                                <td style="width:60%" class="success noborder"><strong>TOTAL TTC</strong></td>
                                <td  style="width:7%"  class="noborder"></td>
                                <td  style="width:15%"  class="noborder"></td>
                                <td style="width:15%; text-align:right"><strong><?php echo number_format($montTTC, 0, ',', ' ') . " Ar" ?></strong></td>
                            </tr>

                        </table>
                    </div>
                    <div class="row saut">
                        <div class="montant">Le montant du présent devis est arreté a la somme de : <h5><?= $lettres ?> (<?php echo number_format($montTTC, 0, ',', ' ') . " Ar" ?>)</h5></div>
                        <div class="montant">
                            <div> Délai de fabrication: <?= $comment1 ?></div> 
                            <div> Validité de l'offre: <?= $comment2 ?></div> 
                            <div> Conditions de paiement : <?= $comment3 ?></div> 
                        </div>
                        <div class="signature col-xs-12">
                            <div width="70%" style="text-align: center; ">Le Directeur </div>
                            <div width="70%" style="text-align: center; ">
                                <img src="../images/logo-lsb1.png" width="250px"/>
                            </div>
                            <div width="70%" style="text-align: center; ">
                                François Bueche
                            </div>
                        </div>
                    </div>
                <div class="foot">
                    <?php include('../modeles/pied-imp.php'); ?>
                </div>
                    <script> $(document).ready(function () {
                            $('.selectpicker').selectpicker();
                        });
                    </script>
            </div>
        </body>
    </html>