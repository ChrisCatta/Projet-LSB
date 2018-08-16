<?php

session_start();
include('../modeles/enteteAdmin.php');

?>
<div class="row">
    <div class="col-xs-3">

        <?php

        include('../scripts/connexionDB.php');
        $retour = connexion();
//$c=$retour[0];
        $link = $retour[0];

        include('../modeles/bar_menu.php');
        bar_sortie(4);
        include('calcultxt.php');

        echo ' </div> 

    <div class="col-xs-9 well3 ">';
        $ID_DV = $_POST['ID_DV'];
        //selection ligne de devis
        $sqlquery2 = "SELECT  L.ID_DV, sum((L.QTE_DV*A.QTE)*A.PV_HT) as 'THT', sum((L.QTE_DV*A.QTE)*A.PV_HT*(1+0.20)) as 'TTC', format(sum(A.VOL*L.QTE_DV),3,'fr_FR') as 'VOLDV'
               from CONTENIR_DV L, ARTICLE A
               where L.ID_DV='$ID_DV' AND A.ID_A=L.ID_A  ";
        $result2 = mysqli_query($link, $sqlquery2);
        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);


        //selection client
        $sqlquery1 = "SELECT * , DATE_FORMAT(D.DATE_DV, '%d/%m/%Y') AS date_fr
              FROM  DEVIS D, CLIENT C
              WHERE D.ID_DV='$ID_DV' AND C.ID_C=D.ID_C";

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
        panel_tab_defaut('panel-info', '<div class="row">')

        ?>
        <div class="col-xs-12"> <h2 class="text-center"><img src="../images/facture.gif" width="100px" heigth="100" class="img-circle">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Liste du devis</strong></h2> </div>
    </div>
    <div class="row">
        <div class=" col-xs-4 ">Devis :  <em class="ligneCommande"><?php echo $row1['REF_DV'] . '/' . $year ?></em> </div>
        <div class=" col-xs-4 ">Date :  <em class="ligneCommande"><?= $newFormat ?></em> </div>
        <div class="col-xs-4">Client :  <em class="ligneCommande"><?= $row1['RAISSO_C'] ?></em> </div>

    </div>
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

                                    $reqNLC = "SELECT A.UNITE, A.QTE, A.VOL, A.ID_A, A.ID_TYPE, A.DESIGNATION, A.LONGUEUR, A.LARGEUR, A.UNITE, A.EPAISSEUR, A.DIAMETRE, A.PV_HT, A.FAMILLE, A.TYPE, C.ID_DV, C.ID_DV_LIGNE, C.QTE_DV,C.RABOT, C.SEC, (C.QTE_DV*A.QTE)*A.PV_HT as 'MONTANT'
              FROM  ARTICLE A, CONTENIR_DV C
              WHERE  C.ID_DV='$ID_DV' AND A.ID_A=C.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$type1' order by DESIGNATION ASC";

                                    $resNLC = mysqli_query($link, $reqNLC);
                                    $nombreNLC = mysqli_num_rows($resNLC);
                                    if ($nombreNLC > 0) {

                                        ?>          
                                        <table class="info saut" border="1" style="width:100%">
                                            <thead>  
                                                <tr class="info">
                                                    <th width="30%"><strong>Produit</strong></th>
                                                    <th width="6%"><strong>Qté</strong></th>
                                                    <th width="7%"><strong>Long</strong></th>
                                                    <th width="7%"><strong>Larg</strong></th>
                                                    <th width="7%"><strong>Ep</strong></th>
                                                    <th width="7%"><strong></strong></th>
                                                    <th width="7%"><strong>M3</strong></th>
                                                    <th width="15%"><strong>Prix unitaire</strong></th>
                                                    <th width="15%"><strong>Montant</strong></th>


                                                </tr>
                                            </thead>
                                            <?php

                                            $MONTANTNLC = 0;
                                            $VOLUMENLC = 0;
                                            $supprabotNLC=0;
                                            $suppsecNLC=0;
                                            $VolrabotNLC=0;
                                            $VolsecNLC=0;
                                            while ($rowNLC = mysqli_fetch_array($resNLC, MYSQLI_ASSOC)) {
                                                    if($rowNLC['RABOT']==1){
                                                        $text= " (Raboté) ";
                                                    }
                                                     else {
                                                        $text="";
                                                    }    
                                                    if($rowNLC['SEC']==1){
                                                        $text=$text. " (Sec) ";
                                                    }
                                                     else {
                                                        $text=$text."";
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
                                                    <td style="text-align:right"><?php echo number_format($rowNLC['MONTANT'], 0, ',', ' ') . " Ar" ?></td>
                                                </tr>
                                                    <?php 
                                                    if ($rowNLC['ID_TYPE']==="1") {
                    $reqrab="SELECT * FROM TARIFS WHERE TARIF='Rabotage'";
                    $resrab=mysqli_query($link,$reqrab);
                    $rowrab= mysqli_fetch_array($resrab);
                    $montsupprabot=$rowrab['MONTANTHT'];
                    $textsupprabot='Rabotage ';
                    
                    if ($rowNLC['RABOT']=='1'){  
                    $volrabot=$rowNLC['VOL']*$rowNLC['QTE_DV'];
                    $supprabot=$montsupprabot*$volrabot;
                    $montsupprabot=number_format($montsupprabot, 0, ',', ' ') .' Ar';
                    } 
                    else{
                    $supprabot='';
                    $volrabot='';    
                    }
                   
                    $reqsec="SELECT * FROM TARIFS WHERE TARIF='Bois sec'";
                    $ressec=mysqli_query($link,$reqsec);
                    $rowsec= mysqli_fetch_array($ressec);
                    $montsuppsec=$rowsec['MONTANTHT'];
                    $textsuppsec='Bois sec ';
                    if ($rowNLC['SEC']=='1'){
                    $volsec=($rowNLC['VOL']*$rowNLC['QTE_DV']);
                    $suppsec=$montsuppsec*$volsec;
                    $montsuppsec= number_format($montsuppsec, 0, ',', ' ') .' Ar';
                    }
                    else{
                    $suppsec ='';
                    $volsec ='';
                    }
                    }
                    else {
                    $supprabot ='';
                    $suppsec ='';
                    $volrabot ='';    
                    $volsec ='';
                    }                
                            $VOLUMENLC = $VOLUMENLC + $rowNLC['VOL'] * $rowNLC['QTE_DV'];
                            $supprabotNLC = $supprabotNLC + $supprabot ;
                            $VolrabotNLC = $VolrabotNLC + $volrabot;
                            $suppsecNLC = $suppsecNLC + $suppsec ;
                            $VolsecNLC = $VolsecNLC +  $volsec;
                                                
                 }
                                                                $sqlquery3NLC = "SELECT  A.UNITE, sum((L.QTE_DV*A.QTE)*A.PV_HT) as 'THT', sum((L.QTE_DV*A.QTE)*A.PV_HT*(1+0.20)) as 'TTC', sum(A.VOL*L.QTE_DV) as 'VOLDV'
               from CONTENIR_DV L, ARTICLE A
               where L.ID_DV='$ID_DV' AND A.ID_A=L.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$type1'";
                                                                $result3NLC = mysqli_query($link, $sqlquery3NLC);
                                                                $row3NLC = mysqli_fetch_array($result3NLC, MYSQLI_ASSOC);
                             if($supprabotNLC!='')        {                           
                                 ?>
                       <tr>
                            <td colspan="6" class="success"><strong> <?=$textsupprabot?> </strong></td>
                            <td class="" style="text-align:right"><?php echo number_format($VolrabotNLC, 3, ',', ' ')?></td>
                            <td class="" style="text-align:right"><strong><?=$montsupprabot?></strong></td>
                            <td class="" style="text-align:right"><strong><?php echo number_format($supprabotNLC, 0, ',', ' ') . " Ar" ?></strong></td>
                        </tr>
                        <?php
                             }
                             if($suppsecNLC!='')        {  
                             ?>
                                  
                        <tr>
                            <td colspan="6" class="success"><strong> <?=$textsuppsec?> </strong></td>
                            <td class="" style="text-align:right"><?php echo number_format($VolsecNLC, 3, ',', ' ')?></td>
                            <td class="" style="text-align:right"><strong><?=$montsuppsec?></strong></td>
                            <td class="" style="text-align:right"><strong><?php echo number_format($suppsecNLC, 0, ',', ' ') . " Ar" ?></strong></td>
                        </tr> 
                        <?php
                             }
                             ?>
                                                                <tr>
                                                                    <td colspan="6" class="success"><strong>Total</strong></td>
                                                                    <td class="" style="text-align:right"><strong><?php echo number_format($VOLUMENLC, 3, ',', ' ') ?></strong></td>
                                                                    <td></td>
                                                                    <td class="" style="text-align:right"><strong><?php echo number_format($row3NLC['THT'] + $supprabotNLC +$suppsecNLC, 0, ',', ' ') . " Ar" ?></strong></td>
                                                                </tr>
                                                        </table>
                                                        <?php

                                                    }


                                                    $type6 = 6;

                                    $reqLC = "SELECT A.UNITE, A.QTE, A.VOL, A.ID_A, A.ID_TYPE, A.DESIGNATION, A.LONGUEUR, A.LARGEUR, A.UNITE, A.EPAISSEUR, A.DIAMETRE, A.PV_HT, A.FAMILLE, A.TYPE, C.ID_DV, C.ID_DV_LIGNE, C.QTE_DV, (C.QTE_DV*A.QTE)*A.PV_HT as 'MONTANT'
      FROM  ARTICLE A, CONTENIR_DV C
      WHERE  C.ID_DV='$ID_DV' AND A.ID_A=C.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$type6' order by A.LONGUEUR DESC, A.LARGEUR DESC, A.EPAISSEUR DESC";

                                    $resLC = mysqli_query($link, $reqLC);
                                    $nombreLC = mysqli_num_rows($resLC);

                                    if ($nombreLC > 0) {

                                        ?>          
                                        <table class="info saut" border="1" style="width:100%">
                                            <thead>  
                                                <tr class="info">
                                                    <th width="30%"><strong>Produit</strong></th>
                                                    <th width="6%"><strong>Qté</strong></th>
                                                    <th width="7%"><strong>Long</strong></th>
                                                    <th width="7%"><strong>Larg</strong></th>
                                                    <th width="7%"><strong>Ep</strong></th>
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
      WHERE  C.ID_DV='$ID_DV' AND A.ID_A=C.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$type9' AND A.ID_FAMILLE='$i' order by A.LONGUEUR DESC, A.LARGEUR DESC, A.EPAISSEUR DESC";

                                        $resAP = mysqli_query($link, $reqAP);
                                        $nombreAP = mysqli_num_rows($resAP);

                                        if ($nombreAP > 0) {

                                            ?>          
                                            <table class="info saut" border="1" style="width:100%">
                                                <thead>  
                                                    <tr class="info">
                                                        <th width="30%"><strong>Produit, qualité à peindre</strong></th>
                                                        <th width="6%"><strong>Qté</strong></th>
                                                        <th width="7%"><strong>Long</strong></th>
                                                        <th width="7%"><strong>Larg</strong></th>
                                                        <th width="7%"><strong>Ep</strong></th>
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
      WHERE  C.ID_DV='$ID_DV' AND A.ID_A=C.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$type3' AND A.ID_FAMILLE='$i'  order by A.LONGUEUR DESC, A.LARGEUR DESC, A.EPAISSEUR DESC";

                                        $resAV = mysqli_query($link, $reqAV);
                                        $nombreAV = mysqli_num_rows($resAV);

                                        if ($nombreAV > 0) {

                                            ?>          
                                            <table class="info saut" border="1" style="width:100%">
                                                <thead>  
                                                    <tr class="info">
                                                        <th width="30%"><strong>produit, qualité à vernir</strong></th>
                                                        <th width="6%"><strong>Qté</strong></th>
                                                        <th width="7%"><strong>Long</strong></th>
                                                        <th width="7%"><strong>Larg</strong></th>
                                                        <th width="7%"><strong>Ep</strong></th>
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
                                    // ML à vernir
                                    $typeML3 = 3;
                                    for ($i = 14; $i <= 21; $i++) {

                                        $reqML = "SELECT A.UNITE, A.QTE, A.VOL, A.ID_A, A.ID_FAMILLE, A.DESIGNATION, A.LONGUEUR, A.LARGEUR, A.UNITE, A.EPAISSEUR, A.DIAMETRE, A.PV_HT, A.FAMILLE, A.TYPE, C.ID_DV, C.ID_DV_LIGNE, C.QTE_DV, (C.QTE_DV*A.LONGUEUR)*A.PV_HT as 'MONTANT'
              FROM  ARTICLE A, CONTENIR_DV C
              WHERE  C.ID_DV='$ID_DV' AND A.ID_A=C.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$typeML3' AND A.ID_FAMILLE='$i' order by A.LONGUEUR DESC, A.LARGEUR DESC, A.EPAISSEUR DESC";

                                        $resML = mysqli_query($link, $reqML);
                                        $nombreML = mysqli_num_rows($resML);

                                        if ($nombreML > 0) {

                                            ?>          
                                            <table class="info saut" border="1" style="width:100%">
                                                <thead>  
                                                    <tr class="info">
                                                        <th width="30%"><strong>Produit, qualité à vernir</strong></th>
                                                        <th width="6%"><strong>Qté</strong></th>
                                                        <th width="7%"><strong>Long</strong></th>
                                                        <th width="7%"><strong>Larg</strong></th>
                                                        <th width="7%"><strong>Ep</strong></th>
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

                                    //pour ML à peindre type=9
                                    $typeML9 = 9;
                                    for ($i = 41; $i <= 48; $i++) {
                                        $reqT9 = "SELECT A.UNITE, A.QTE, A.VOL, A.ID_A, A.ID_FAMILLE, A.DESIGNATION, A.LONGUEUR, A.LARGEUR, A.UNITE, A.EPAISSEUR, A.DIAMETRE, A.PV_HT, A.FAMILLE, A.TYPE, C.ID_DV, C.ID_DV_LIGNE, C.QTE_DV, (C.QTE_DV*A.QTE)*A.PV_HT as 'MONTANT'
      FROM  ARTICLE A, CONTENIR_DV C
      WHERE  C.ID_DV='$ID_DV' AND A.ID_A=C.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$typeML9' AND A.ID_FAMILLE='$i' order by A.LONGUEUR DESC, A.LARGEUR DESC, A.EPAISSEUR DESC";

                                        $resT9 = mysqli_query($link, $reqT9);
                                        $nombreT9 = mysqli_num_rows($resT9);

                                        if ($nombreT9 > 0) {

                                            ?>          
                                            <table class="info saut" border="1" style="width:100%">
                                                <thead>  
                                                    <tr class="info">
                                                        <th width="30%"><strong>Produit, qualité à peindre</strong></th>
                                                        <th width="6%"><strong>Qté</strong></th>
                                                        <th width="7%"><strong>Long</strong></th>
                                                        <th width="7%"><strong>Larg</strong></th>
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
      WHERE  C.ID_DV='$ID_DV' AND A.ID_A=C.ID_A AND A.UNITE='$unite' AND A.ID_TYPE='$type7' AND A.ID_FAMILLE='$i' order by A.LONGUEUR DESC, A.DIAMETRE DESC";

                                        $resBR = mysqli_query($link, $reqBR);
                                        $nombreBR = mysqli_num_rows($resBR);
                                        if ($nombreBR > 0) {

                                            ?>          
                                            <table class="info saut" border="1" style="width:100%">
                                                <thead>  
                                                    <tr class="info">
                                                        <th width="30%"><strong>Produit</strong></th>
                                                        <th width="6%"><strong>Qté</strong></th>
                                                        <th width="7%"><strong>Long</strong></th>
                                                        <th width="7%"><strong>Diam</strong></th>
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
                        $totHT=$row2['THT']+$supprabotNLC+$suppsecNLC;
                        $totTVA=$totHT*0.2;
                        $totTTC=$totHT+$totTVA;
                        ?>
    <table class="info saut" border="1" style="width:100%">
   <!--  <tr><td colspan="9">&nbsp;</td></tr>-->
        <tr>
            <td style="width:60%" class="success"><strong>TOTAL</strong></td>
            <td style="text-align:right ;width:7%"><strong><?php echo $row2['VOLDV'] ?></strong></td>
            <td style="width:15%"></td>
            <td style="text-align:right; width:15%"><?php echo number_format($totHT, 0, ',', ' ') . " Ar" ?>"<input type="hidden" id="tht" value="<?=$row2['THT']?>"></td>
        </tr>
        <tr>
            <td style="width:60%" class="success noborder" style="border-right: none;"><strong>TVA 20%</strong></td>
            <td style="width:7%" class="noborder"></td>
            <td style="width:15%" class="noborder"></td>
            <td style="width:15%; text-align:right"><strong><?php echo number_format($totTVA, 0, ',', ' ') . " Ar" ?></strong></td>
        </tr>
        <tr>
            <td style="width:60%" class="success noborder"><strong>REMISE</strong></td>
            <td style="width:7%"  class="noborder"><button id="test" name="remise" onclick="remise()">Calcul</button></td>
            <td style="width:15%"  class="noborder"></td>
            <td style="width:15%; text-align:right"><input id="remise" placeholder="taux remise" value="0"</td>
        <tr>
        <tr>
            <td style="width:60%" class="success noborder"><strong>TOTAL TTC</strong></td>
            <td  style="width:7%"  class="noborder"></td>
            <td  style="width:15%"  class="noborder"></td>
            <td style="width:15%; text-align:right"><strong><?php echo number_format($totTTC, 0, ',', ' ') . " Ar" ?></strong></td>
        </tr>
        <tr>
            <td style="width:60%">  
                <form name="lettrespdf" type="post" target="_blank" action="SortieDetailDevis2.php"> 
                <input id="monttht" type="text" value=""/>
                <input id="txremise" type="text" name="txremise" value="0"/>
            </td>
            <td style="width:7%">
                <input id="montremise" name="montremise"type="text" value="0"/>
            </td>
            <td style="width:15%">
                <input id="t" type="text" value="<?php echo round($totTTC, 0) ?>"/> 
            </td>
            <td style="width:15%">  
                    <input id='lettres'  type="text" name="lettres" value="&nbsp;" style='font-family:verdana; font-size:11px;'>
                    </td>
                    </tr>
                    </table>
                    <div class="row">
                        <div class="col-xs-3">
                            <label for="text" >Délai</label>
                        </div>
                        <div class="col-xs-9">
                            <input type="text" style="width: 450px;" max-lenght="400" name="comment1" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <label for="text" >Validité</label>
                        </div>
                        <div class="col-xs-9">
                            <input type="text" style="width: 450px;" max-lenght="400" name="comment2" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <label for="text" >Conditions de paiement</label>
                        </div>
                        <div class="col-xs-8">
                            <input type="text" style="width: 450px;" max-lenght="400" name="comment3">
                        </div>
                    </div>
                    <!--Div de la fonction panel_tab-->
                    </div>
                    <a href="../scripts/SortieDevis.php"><input type="image" src="../images/retour2.PNG" width="70" heigth="70" title="Retour aux Devis"></a>
                    <Button type="submit" name="ID_DV"  class="pull-right"  value="<?= $row1['ID_DV'] ?>"><img src="../images/avant.PNG" width="70" heigth="70" style="background:transparent ;" /></Button></form>
                </div>
                </div>



                <script type="text/javascript">
                    
           window.onload =remise          
   function remise() {
            var txremise= document.getElementById("remise").value;
            var tht = document.getElementById("tht").value;
            var montremise=Math.round(tht*(txremise/100));
            var monttht= Math.round(tht-montremise,0);
            var monttva =Math.round(monttht*0.2,0);
            var montttc= Math.round(monttht +monttva,0);
            document.getElementById("monttht").value=monttht;
            document.getElementById("montremise").value=montremise;
            document.getElementById("txremise").value= txremise;
            document.getElementById("t").value= montttc;
            document.getElementById("lettres").value = trans(montttc);
        }
   

                    var res, plus, diz, s, un, mil, mil2, ent, deci, centi, pl, pl2, conj;

                    var t = ["", "Un", "Deux", "Trois", "Quatre", "Cinq", "Six", "Sept", "Huit", "Neuf"];
                    var t2 = ["Dix", "Onze", "Douze", "Treize", "Quatorze", "Quinze", "Seize", "Dix-sept", "Dix-huit", "Dix-neuf"];
                    var t3 = ["", "", "Vingt", "Trente", "Quarante", "Cinquante", "Soixante", "Soixante", "Quatre-vingt", "Quatre-vingt"];
                  
                   

                    window.onload = calcule

                    function calcule() {
                        document.getElementById("t").onfocus = function () {
                            document.getElementById("lettres").value = trans(this.value)
                        }
                    }

                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                // traitement des deux parties du nombre;
                    function decint(n) {

                        switch (n.length) {
                            case 1 :
                                return dix(n);
                            case 2 :
                                return dix(n);
                            case 3 :
                                return cent(n.charAt(0)) + " " + decint(n.substring(1));
                            default:
                                mil = n.substring(0, n.length - 3);
                                if (mil.length < 4) {
                                    un = (mil == 1) ? "" : decint(mil);
                                    return un + mille(mil) + " " + decint(n.substring(mil.length));
                                } else {
                                    mil2 = mil.substring(0, mil.length - 3);
                                    return decint(mil2) + million(mil2) + " " + decint(n.substring(mil2.length));
                                }
                        }
                    }



                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                // traitement des nombres entre 0 et 99, pour chaque tranche de 3 chiffres;
                    function dix(n) {
                        if (n < 10) {
                            return t[parseInt(n)]
                        } else if (n > 9 && n < 20) {
                            return t2[n.charAt(1)]
                        } else {
                            plus = n.charAt(1) == 0 && n.charAt(0) != 7 && n.charAt(0) != 9 ? "" : (n.charAt(1) == 1 && n.charAt(0) < 8) ? " et " : "-";
                            diz = n.charAt(0) == 7 || n.charAt(0) == 9 ? t2[n.charAt(1)] : t[n.charAt(1)];
                            s = n == 80 ? "s" : "";

                            return t3[n.charAt(0)] + s + plus + diz;
                        }
                    }


                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                // traitement des mots "cent", "mille" et "million"
                    function cent(n) {
                        return n > 1 ? t[n] + " Cent" : (n == 1) ? " Cent" : "";
                    }

                    function mille(n) {
                        return n >= 1 ? " Mille" : "";
                    }

                    function million(n) {
                        return n >= 1 ? " Millions" : " Million";
                    }


                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                // conversion du nombre
                    function trans(n) {

                        // vérification de la valeur saisie
                        if (!/^\d+[.,]?\d*$/.test(n)) {
                            return "L'expression entrée n'est pas un nombre."
                        }

                        // séparation entier + décimales
                        n = n.replace(/(^0+)|(\.0+$)/g, "");
                        n = n.replace(/([.,]\d{2})\d+/, "$1");
                        n1 = n.replace(/[,.]\d*/, "");
                        n2 = n1 != n ? n.replace(/\d*[,.]/, "") : false;

                        // variables de mise en forme
                        ent = !n1 ? "" : decint(n1);
                        deci = !n2 ? "" : decint(n2);
                        if (!n1 && !n2) {
                            return  "Entrez une valeur non nulle!"
                        }
                        conj = !n2 || !n1 ? "" : "  et ";
                        euro = !n1 ? "" : !/[23456789]00$/.test(n1) ? " Ariary" : " ";
                        centi = !n2 ? "" : " centime";
                        pl = n1 > 1 ? "" : "";
                        pl2 = n2 > 1 ? "s" : "";

                        // expression complète en toutes lettres
                        return (" " + ent + euro + pl + conj + deci  + pl2).replace(/\s+/g, " ").replace("cent s E", "cents E");

                    }

                </script>
                <?php include('../modeles/pied.php'); ?>