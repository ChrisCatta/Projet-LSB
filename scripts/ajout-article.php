<?php

session_start();
include('../modeles/enteteAdmin.php');

?>
<div class="row">
    <div class="col-xs-3">

        <script type="text/javascript">
            $(document).ready(function () {
                chargerCategories();
                chargerFamille(1);
            });
        </script>  

        <?php

        include('../scripts/connexionDB.php');
        $retour = connexion();
        //$c=$retour[0];
        $link = $retour[0];
        include('../modeles/bar_menu.php');
        bar_stock();

        ?> 
    </div> 

    <div class="col-xs-9 well3">
        <form name="form1" method="post" action="ajout-article2.php" enctype="multipart/form-data"  onSubmit="return verification()">

            <p>
            <div class="row">
                <div class="col-xs-1">
                    <img src="../images/article.JPG" class="img-circle " width="100" heigth="100">
                </div>
                <div class="col-xs-offset-1 col-xs-10">
                    <legend><h1>Ajout d'un Article</h1></legend>
                </div>
            </div>

            <fieldset>


                <div class="row">
                    <div class="form-group">
                        <label for="select" class="col-xs-2">Désignation</label>
                        <div class="col-xs-4">
                            <input  pattern=".{3,30}" required title="La désignation contient minimum 3 caractères et maximum 30 caractères." class="form-control" name="DESIGNATION" maxlength="30">
                        </div>
                    </div>
                </div>
                <div class="row">

                    <fieldset>
                        <div class="row">
                            <div class="col-xs-2">
                                Select Type :
                            </div>
                            <div class="col-xs-3">
                                <div id="div-type">
                                </div>
                            </div>    
                            <div class="col-xs-2">
                                Select Famille :
                            </div>    
                            <div class="col-xs-3">
                                <div id="div-famille">
                                </div>
                            </div>
                        </div>
                    </fieldset>

                </div>

                <div class="row">
                    <div class="form-group">
                        <label  class="col-xs-2">Quantité Stock</label>
                        <div class=" col-xs-4">
                            <input type="number" min="0" max= "2000000000" class="form-control" name="QTE_STO"  value=0 >
                        </div>
                        <label  class="col-xs-2">Quantité Seuil</label>
                        <div class="col-xs-4">
                            <input  type="number" min="0" max= "2000000000" class="form-control" name="QTE_MIN"  value=0>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label  class="col-xs-2">Prix Unitaire</label>
                        <div class=" col-xs-4">
                            <select id="select-tarif"  class="selectpicker" name="ID_TARIF" >

                                <?php

                                $sqltarif = "SELECT * FROM TARIFS ORDER BY ID_TARIF ASC";
                                $restarif = mysqli_query($link, $sqltarif) or exit(mysql_error());
                                while ($datatarif = mysqli_fetch_array($restarif)) {
                                    echo '<option value="' . $datatarif['ID_TARIF'] . '">' . $datatarif['MONTANTHT'] . '</option><br/>'; //Attention à ne pas oublier le . qui sert à concaténer ton expression
                                }

                                ?> 
                            </select>
                           <!-- <input type="hidden" id="ID_TARIF" name="ID_TARIF" value="<?= $tarif ?>" />
                            <input type="hidden" id="TARIF" name="TARIF" value="<?= $datatarif['MONTANTHT'] ?>" />-->
                        </div>
                        <label  class="col-xs-2">Taux</label>
                        <div class=" col-xs-4">
                            <input type="number" id="TX" name="TX"  value=0/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label  class="col-xs-2">Unité</label>
                        <div class=" col-xs-4">
                            <select id="UNITE" name="UNITE"  >
                                <?php

                                $requnit = "SELECT * FROM UNITE ORDER BY UNITE ASC";
                                $resunit = mysqli_query($link, $requnit) or exit(mysql_error());
                                while ($rowunit = mysqli_fetch_array($resunit)) {
                                    echo '<option value="' . $rowunit['UNITE'] . '">' . $rowunit['UNITE'] . '</option><br/>'; //Attention à ne pas oublier le . qui sert à concaténer ton expression
                                }

                                ?> 
                            </select>
                           <!-- <input type="hidden" id="ID_UNITE" name="ID_UNITE" value="<?= $unite ?>" />
                            <input type="hidden" id="UNITE" name="UNITE" value="<?= $rowunit['UNITE'] ?>" />-->
                        </div>

                        <label  class="col-xs-2">Choisir Une Image</label>
                        <div class=" col-xs-4">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="input" class="col-xs-2">Longueur</label>
                        <div class="col-xs-4">
                            <input type="number" step="0.1" id="longueur" name="LONGUEUR" class="form-control "  value=0>
                        </div>
                        <label for="input" class="col-xs-2">Largeur</label>
                        <div class="col-xs-4">
                            <input type="number"  id="largeur" name="LARGEUR" class="form-control " value=0>
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="form-group">
                        <label for="input" class="col-xs-2">Epaisseur</label>
                        <div class="col-xs-4">
                            <input type="number"  id="epaisseur" name="EPAISSEUR" class="form-control" value=0>
                        </div>
                        <label for="input" class="col-xs-2">Hauteur</label>
                        <div class="col-xs-4">
                            <input type="number" step="0.01" id="hauteur" name="HAUTEUR" class="form-control " value=0>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group">
                        <label for="input" class="col-xs-2">Diametre</label>
                        <div class="col-xs-4">
                            <input type="number"  id="diametre" name="DIAMETRE" class="form-control " value=0>
                        </div>
                        <label for="input" class="col-xs-2">Unité/paquet</label>
                        <div class="col-xs-4">
                            <input type="number"  id="U_Pqt" name="U_Pqt" class="form-control " value=0>
                        </div>
                    </div>
                </div> 



                <div class="row">

                    <div class="col-xs-12">
                        <legend></legend>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-xs-2">
                            <a href="ajoutarticle.php"><button class="btn btn-primary" type="button">Retour</button></a>
                        </div>

                        <div class="col-xs-offset-7 col-xs-2">
                            <button type="submit" name="Submit" value="Ajouter" class="btn btn-primary ">Ajouter</button>
                        </div>
                    </div>
                </div>
            </fieldset>

            </p>
          <!-- <script language="javascript" type="text/javascript">
                                function verification()
                                {
                                 
                                    if(document.forms["form1"].elements["QTE_STO"].value=="")
                                    {
                                      alert("Vous avez laissez le champs de la quantité du stock vide");
                                      return false;
    
                                    }
                                    if(document.forms["form1"].elements["QTE_MIN"].value=="")
                                    {
                                      alert("Vous avez laissez le champs de la quantité minimum vide");
                                      return false;
    
                                    }
                                    if(document.forms["form1"].elements["PRIX_U"].value=="")
                                    {
                                      alert("Vous avez laissez le champs du prix unitaire vide");
                                      return false;
    
                                    }
                                    else 
                                    {
                                      return true;
                                    }
                                }
                              </script>-->
        </form>
    </div>
</div>

         <!--  <script type="text/javascript">
                   $(document).ready(function(){
                  chargerCategories();
                  chargerFamille(1);
                  });
          </script>    --> 

<script>

 /*   $('#select-type').on('changed.bs.select', function (e) {

        var idtype = $("select[name=select-type] option[]").val();
        var type = $("select[name=select-type] option[]").text();
        console.log(idtype);
        console.log(type);
        $('#ID_TYPE').val(idtype);
        $('#TYPE').val(type);
        document.getElementById("affichage").innerHTML = "le type est :" + idtype + type + ".";

    });
    $('#select-type').click(function () {
        $('select[name=select-type]').val(1);
        $('select[name=select-type]').change();
        $('select[name=select-type]').selectpicker('refresh');
    });
    $('#select-famille').on('changed.bs.select', function (idtype) {
        var selectElmt = document.getElementById('select-famille');
        var idfamille = selectElmt.options[selectElmt.selectedIndex].value;
        var famille = selectElmt.options[selectElmt.selectedIndex].text;
        console.log(idfamille);
        console.log(famille);
        $('#ID_FAMILLE').val(idfamille);
        $('#FAMILLE').val(famille);
        document.getElementById("selfamille").innerHTML = "le famille est :" + idfamille + famille + ".";
    }

    });*/
    $('#TX').on('change', calcultarif());
    function calcultarif() {
        var montHT = +$('#select-tarif').val();
        var tx = $('#TX').val();
        var tarif = montHT + (montHT * tx) / 100;
        console.log(tx);
        console.log(montHT);
        console.log(tarif);
        $('#TARIF').val(tarif);
    }
    $('#QTE').on('click', calculquantite);
    function calculquantite() {
        var selectElmt = document.getElementById("UNITE");
        var valeurselectionnee = selectElmt.options[selectElmt.selectedIndex].value;
        var unit = selectElmt.options[selectElmt.selectedIndex].text;
        var longueur = parseFloat($('#longueur').val());
        var largeur = $('#largeur').val();
        var epaisseur = $('#epaisseur').val();
        var diametre = $('#diametre').val();
        if (unit === "M3") {
            var quantite = longueur * (largeur / 1000) * (epaisseur / 1000);
            quantite = quantite.toFixed(3);
        } else {
            if (unit === "M2") {
                var quantite = longueur * (largeur / 1000);
                quantite = quantite.toFixed(3);
            } else {
                if (unit === "ML") {
                    var quantite = longueur;
                }
                quantite = 0;
            }
        }
        console.log(unit);
        console.log(quantite);
        console.log(longueur);
        $('#QTE').val(quantite);
    }

    function famille(idtype) {
        var selectElmt = document.getElementById('select-famille');
        var idfamille = selectElmt.options[selectElmt.selectedIndex].value;
        var famille = selectElmt.options[selectElmt.selectedIndex].text;
        console.log(idfamille);
        console.log(famille);
        $('#ID_FAMILLE').val(idfamille);
        $('#FAMILLE').val(famille);
    }

    function type() {
        var selectElmt = document.getElementById('select-type');
        var idtype = selectElmt.options[selectElmt.selectedIndex].value;
        var type = selectElmt.options[selectElmt.selectedIndex].text;
        console.log(idtype);
        console.log(type);
        $('#ID_TYPE').val(idtype);
        $('#TYPE').val(type);
        document.getElementById("affichage").innerHTML = "le type est :" + idtype + type + ".";
    }
</script>
<?php include('../modeles/pied.php'); ?>