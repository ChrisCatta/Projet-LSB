<?php

require_once('conn.php');

$retour = connexion();
//$c=$retour[0];
$link = $retour[0];

if (isset($_GET['idDV'])) {
    $iddv = (int) $_GET['idDV'];
} else {
    echo ("rien trouve");
}
$req = "SELECT L.ID_DV_LIGNE, L.ID_DV, L.ID_A, L.QTE_DV, L.RABOT, L.SEC, A.ID_A, A.DESIGNATION, A.ID_TYPE, A.ID_FAMILLE,A.LONGUEUR,A.LARGEUR, A.EPAISSEUR, A.DIAMETRE, A.QTE_STO  FROM contenir_dv  L, ARTICLE A WHERE L.ID_DV='$iddv' AND A.ID_A=L.ID_A";
$res = mysqli_query($link, $req) or exit(mysql_error());

?>
<div class="row">
    <div class="col-xs-12">
            <div id="ligne-devis">
                <table  border="1"> 
                    <thead>
                        <tr>
                            <th><strong>supp</strong></th>
                            <th><strong>Id Art</strong></th>
                            <th><strong>Désignation</strong></th>
                            <th><strong>Long</strong></th>
                            <th><strong>Larg</strong></th>
                            <th><strong>Ep</strong></th>
                            <th><strong>Diam</strong></th>
                            <th><strong>QTe DISPO</strong></th>
                            <th><strong>QTe DV</strong></th>
                            <th><strong>R</strong></th>
                            <th><strong>S</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $num = 0;
                        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                            $article = $row['ID_A'];
                      $type =$row['ID_TYPE'];
                      $famille=$row['ID_FAMILLE'];

                            $req1 = "SELECT ID_A, SUM(QTE_BON_L) AS QTE_ENTREE from contenir_bon_l where ID_A='$article'";
                            $res1 = mysqli_query($link, $req1);
                            $row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);

                            $req2 = "SELECT ID_A, SUM(QTE_CO) AS QTE_SORTIE from contenir_co where ID_A='$article'";
                            $res2 = mysqli_query($link, $req2);
                            $nb = mysqli_num_rows($res2);
                            $row2 = mysqli_fetch_array($res2, MYSQLI_ASSOC);

                            $dispo = $row['QTE_STO'] + $row1['QTE_ENTREE'] - $row2['QTE_SORTIE'];
                            if ($dispo >= 5) {
                                $color = "stockOK";
                            } else {
                                if ((0 < $dispo) & ($dispo < 5)) {
                                    $color = "stockLimite";
                                } else {
                                    $color = "stockDown";
                                }
                            }
                    $req3="SELECT * from FAMILLE where ID_FAM='$famille'";
                                $res3=mysqli_query($link,$req3);
                               $row3=mysqli_fetch_array($res3,MYSQLI_ASSOC);
                            ?>
                            <tr class="<?= $color ?>" id="<?php echo $row['ID_DV'] . '-' . $row['ID_DV_LIGNE'] ?>" name="ID_DV">
                                <td ><button type="button" class="supprime supprimeLDV"  id="<?= $row['ID_DV_LIGNE'] ?>" name="ID_DV_LIGNE" ></button></td>
                                <td> <input  class="chiffre" name="ID_A" maxlength="30" value="<?php echo $row['ID_A'] ?>" disabled="disabled"></td>
                                <td> <input   maxlength="30" value="<?= $row['DESIGNATION'] ?>" disabled="disabled"></td>
                                <td> <input  class="chiffre"  maxlength="10" value="<?php echo $row['LONGUEUR'] ?>" ></td>
                                <td> <input  class="chiffre"  maxlength="10" value="<?php echo $row['LARGEUR'] ?>" disabled="disabled"></td>
                                <td> <input  class="chiffre"  maxlength="10" value="<?php echo $row['EPAISSEUR'] ?>" disabled="disabled"></td>
                                <td> <input  class="chiffre"  maxlength="10" value="<?php echo $row['DIAMETRE'] ?>" disabled="disabled"></td>
                                <td><?php echo $dispo ?></td>
                                <td><input id="spinner" type="spinner" name="QTE_DV[]" class="ui-spinner chiffre" max="<?= $dispo ?>" value="<?= $row['QTE_DV'] ?>" ></td>

                                <?php

                                if ($row['ID_TYPE'] == "1") {
                                    echo '<td><input id="r' . $num . '" type="checkbox" name="r[]"  onchange="rabot(this,' . $num . ')"';

                                    if ($row['RABOT'] == '1') {
                                        echo 'value="1" checked="checked" >';
                                        echo '<input type="hidden" id="rabot' . $num . '" name="rabot' . $num . '" value="1"></td>';
                                    } else {
                                        echo ' >';
                                        echo '<input type="hidden" id="rabot' . $num . '" name="rabot' . $num . '" value="0"></td>';
                                    }
                                    echo '<td><input id="s' . $num . '" type="checkbox" name="s[]"  onchange="sec(this,' . $num . ')"';

                                    if ($row['SEC'] == '1') {
                                        echo 'value="1" checked="checked" >';
                                        echo '<input type="hidden" id="sec' . $num . '" name="sec' . $num . '" value="1"></td>';
                                    } else {
                                        echo '  >';
                                        echo '<input type="hidden" id="sec' . $num . '" name="sec' . $num . '" value="0"></td>';
                                    }
                                } else {
                                    echo '
                         <input type="hidden" id="rabot' . $num . '" name="rabot' . $num . '" value="0">
                         <input type="hidden" id="sec' . $num . '" name="sec' . $num . '" value="0">';
                                }

                                ?> 


                        <input id="spinner" type="hidden" name="ID_DV_LIGNE[]"  value="<?php echo $row['ID_DV_LIGNE'] ?>">

                        <input id="spinner" type="hidden" name="ID_TYPE[]"  value="<?php echo $row['ID_TYPE'] ?>">

                        <?php

                        $num ++;
                    }

                    ?>
                    </tr>
                    </tbody>

                </table>
                <input type="hidden" id="iddv" name="ID_DV" value="<?php echo $row['ID_DV'] ?>">
            </div>
    </div>
</div>

<script type="text/javascript">

    function rabot(rabotage, num) {
        var rep = document.getElementById('rabot' + num).value;
        if (rabotage.checked === true) {
            document.getElementById('rabot' + num).value = '1';
        } else {
            document.getElementById('rabot' + num).value = '0';
        }
    }

    function sec(seche, num) {
        if (seche.checked === true) {
            var reps = document.getElementById('sec' + num).value;
            document.getElementById('sec' + num).value = '1';
        } else {
            document.getElementById('sec' + num).value = '0';
        }
    }
</script>