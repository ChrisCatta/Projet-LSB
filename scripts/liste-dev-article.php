<?php

require_once('conn.php');

$retour = connexion();
//$c=$retour[0];
$link = $retour[0];

?>
<?php

if (isset($_GET['idDV'])) {
    $iddv = (int) $_GET['idDV'];
} else {
    echo ("rien trouve");
}
$req = "SELECT L.ID_DV_LIGNE, L.ID_DV, L.ID_A, L.QTE_DV, L.RABOT, L.SEC, A.ID_A, A.DESIGNATION, A.ID_TYPE, A.ID_FAMILLE,A.LONGUEUR,A.LARGEUR, A.EPAISSEUR, A.DIAMETRE, A.QTE_STO  FROM contenir_dv  L, ARTICLE A WHERE L.ID_DV='$iddv' AND A.ID_A=L.ID_A";
$res = mysqli_query($link, $req) or exit(mysql_error());
?>
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

            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $article = $row['ID_A'];

                $req1 = "SELECT ID_A, SUM(QTE_BON_L) AS QTE_ENTREE from contenir_bon_l where ID_A='$article'";
                $res1 = mysqli_query($link, $req1);
                $row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);

                $req2 = "SELECT ID_A, SUM(QTE_CO) AS QTE_SORTIE from contenir_co where ID_A='$article'";
                $res2 = mysqli_query($link, $req2);
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

                ?>
                <tr class="<?= $color ?>" id="<?php echo $row['ID_DV'] ?>" name="ID_DV">
                    <td ><button type="button" class="supprime supprimeLDV"  id="<?= $row['ID_DV_LIGNE'] ?>" name="ID_DV_LIGNE" ></button></td>
                    <td> <input  class="chiffre" name="ID_A" maxlength="30" value="<?php echo $row['ID_A']?>" disabled="disabled"></td>
                    <td> <input  name="DESIGNATION" maxlength="30" value="<?= $row['DESIGNATION'] ?>" disabled="disabled"></td>
                    <td> <input  class="chiffre" name="LONGUEUR[]" maxlength="10" value="<?php echo $row['LONGUEUR'] ?>" ></td>
                    <td> <input  class="chiffre" name="LARGEUR" maxlength="10" value="<?php echo $row['LARGEUR'] ?>" disabled="disabled"></td>
                    <td> <input  class="chiffre" name="EPAISSEUR" maxlength="10" value="<?php echo $row['EPAISSEUR'] ?>" disabled="disabled"></td>
                    <td> <input  class="chiffre" name="DIAMETRE" maxlength="10" value="<?php echo $row['DIAMETRE'] ?>" disabled="disabled"></td>
                    <td><?php echo $dispo ?></td>
                    <td><input id="spinner" type="spinner" name="QTE_DV[]" class="ui-spinner chiffre" max="<?php echo $dispo ?>" value="<?php echo $row['QTE_DV'] ?>"></td>
                    <td><?php if ($row['ID_TYPE']==="1"){ 
                    if ($row['RABOT']=='1'){  echo '<input type="checkbox" name="RABOT[]" value="r" checked="checked">'; } 
                    else{
                        echo '<input type="checkbox" name="RABOT[]" value="r" >';
                    } }?>
                        <input id="spinner" type="hidden" name="ID_DV_LIGNE[]"  value="<?php echo $row['ID_DV_LIGNE'] ?>"></td> 
                    <td><?php if ($row['ID_TYPE']==="1"){  
                    if ($row['SEC']=='1'){ 
                    echo '<input type="checkbox" name="SEC[]" value="s" checked="checked">';}
                    else {
                        echo '<input type="checkbox" name="SEC[]" value="s">';
                        
                    } }?>
                    <input id="spinner" type="hidden" name="ID_FAMILLE[]"  value="<?php echo $row['ID_FAMILLE'] ?>"></td>

                    <?php

                }

                ?>
            </tr>
        </tbody>

    </table>
    <input type="hidden" id="iddv" name="iddv" value="<?php echo $row['ID_DV'] ?>"/>
</div>