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
<!DOCTYPE html>
<html lang="fr">
      <head>
	       <meta charset="utf-8" />
           <title>Stock LSB</title>
           <link rel="stylesheet" type="text/css" href="../bootstrap/dist/css/bootstrap.min.css">
           <!--
           <link rel="stylesheet" type="text/css" href="../cefis.css">
           <link rel="stylesheet" type="text/css" href="../jquery/development-bundle/themes/base/jquery.ui.all.css">
           <link rel="stylesheet" type="text/css" href="../jquery/css/dark-hive/jquery-ui-1.10.4.custom.min.css">-->
           <link rel="stylesheet" type="text/css" href="../jquery/css/jquery-ui.css">
           <link rel="stylesheet" type="text/css" href="../DataTables/jquery.dataTables.min.css">
           <link rel="stylesheet" type="text/css" href="../bootstrap/dist/css/bootstrap-select.min.css">
           <link rel="stylesheet" type="text/css" href="../LSB.css">
           <!--////////////////////-->
 
           <script type="text/javascript" src="../jquery/js/jquery-3.2.1.min.js"></script>
           <script type="text/javascript" src="../jquery/js/jquery-ui.js"></script>
           <script type="text/javascript" src="../jquery/development-bundle/ui/jquery.ui.core.js"></script>
           <script type="text/javascript" src="../jquery/development-bundle/ui/jquery.ui.widget.js"></script>
           <script type="text/javascript" src="../jquery/development-bundle/ui/jquery.ui.accordion.js"></script>
           <script type="text/javascript" src="../jquery/development-bundle/ui/jquery.ui.datepicker.js"></script>
           <script type="text/javascript" src="../jquery/development-bundle/ui/jquery.ui.mouse.js"></script>
           <script type="text/javascript" src="../jquery/development-bundle/ui/jquery.ui.sortable.js"></script>
           <script type="text/javascript" src="../jquery/development-bundle/ui/jquery.ui.tabs.js"></script>
           <script type="text/javascript" src="../bootstrap/dist/js/bootstrap.min.js"></script>
           <script type="text/javascript" src="../bootstrap/dist/js/bootstrap-select.js"></script>
           <script type="text/javascript" src="../DataTables/jquery.dataTables.min.js"></script>
           <script type="text/javascript" src="test-ajax.js"></script>
            <script type="text/javascript" >
             $(function() {

   $( "#accordion" ).accordion({
      heightStyle: "content"
      
    });
   $( "#accordion1" ).accordion({
      heightStyle: "content"
    });
   $( "#accordion2" ).accordion({
      heightStyle: "content"
    });
   $( "#accordion3" ).accordion({
      heightStyle: "content"
    });
   $( "#accordion4" ).accordion({
      heightStyle: "content"
    });
   $( "#accordion5" ).accordion({
      heightStyle: "content"
    });
   $( "#accordion6" ).accordion({
      heightStyle: "content"
    });
     $( "#datepicker" ).datepicker();
    var tabs = $( "#tabs" ).tabs();
    tabs.find( ".ui-tabs-nav" ).sortable({
      axis: "x",
      stop: function() {
        tabs.tabs( "refresh" );
      }
    });
  });
</script>
   <script>
  $( function() {
    var spinner = $( ".spinner" ).spinner();
 
    $( "#disable" ).on( "click", function() {
      if ( spinner.spinner( "option", "disabled" ) ) {
        spinner.spinner( "enable" );
      } else {
        spinner.spinner( "disable" );
      }
    });
    $( "#destroy" ).on( "click", function() {
      if ( spinner.spinner( "instance" ) ) {
        spinner.spinner( "destroy" );
      } else {
        spinner.spinner();
      }
    });
    $( "#getvalue" ).on( "click", function() {
      alert( spinner.spinner( "value" ) );
    });
    $( "#setvalue" ).on( "click", function() {
      spinner.spinner( "value", 5 );
    });
    });
  $( function() {
    $( ".selectmenu" ).selectmenu();
  } );
  $(document).ready(function() {
  $('.selectpicker').selectpicker();
});
  </script>
  
	  </head>

	  <body >
	  	
	       <div class="container">
	       	<div class="row">
	       			<img src="../images/logo-lsb.png" width="400" heigth="150" >
	       		</div>
	       		<div class="row">
	       		
                     <nav class="navbar navbar-inverse">
                     	
                        <ul class="nav navbar-nav" id="logo">
                        <li > <a href="menu.php">ACCEUIL</a> </li>

                        <li> <a href="administrer.php">ADMINISTRER</a></li>
                        <li> <a href="listefournisseur.php">FOURNISSEUR</a></li>
                        <li><a href="listeclient.php">CLIENT</a></li>
                        <li><a href="listearticle.php">STOCK</a></li>
                        <li><a href="livraison_entree1.php">ENTREE</a><li>
                          <li><a href="commande_sortie.php">SORTIE</a><li>
                          <li><a href="listetarifs.php">TARIFS</a><li>

                        </ul>
<form class="navbar-form pull-right" action="login.php">
<!--input type="text" style="width:150px" class="input-small"
placeholder="Recherche"-->
<button type="submit" class="btn btn-primary"><em class="glyphicon glyphicon-off">&nbsp;Se deconnecter</button></em>
</form>
</nav>
      </div>
                                
			
			

    <form name="listArt" id="listArt" method="POST" action="update-dev.php">
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
            $num=0;
            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $article = $row['ID_A'];

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

                ?>
                <tr class="<?= $color ?>" id="<?php echo $row['ID_DV'].'-'.$row['ID_DV_LIGNE']?>" name="ID_DV">
                    <td ><button type="button" class="supprime supprimeLDV"  id="<?= $row['ID_DV_LIGNE'] ?>" name="ID_DV_LIGNE" ></button></td>
                    <td> <input  class="chiffre" name="ID_A" maxlength="30" value="<?php echo $row['ID_A']?>" disabled="disabled"></td>
                    <td> <input   maxlength="30" value="<?= $row['DESIGNATION'] ?>" disabled="disabled"></td>
                    <td> <input  class="chiffre"  maxlength="10" value="<?php echo $row['LONGUEUR'] ?>" ></td>
                    <td> <input  class="chiffre"  maxlength="10" value="<?php echo $row['LARGEUR'] ?>" disabled="disabled"></td>
                    <td> <input  class="chiffre"  maxlength="10" value="<?php echo $row['EPAISSEUR'] ?>" disabled="disabled"></td>
                    <td> <input  class="chiffre"  maxlength="10" value="<?php echo $row['DIAMETRE'] ?>" disabled="disabled"></td>
                    <td><?php echo $dispo ?></td>
                    <td><input id="spinner" type="spinner" name="QTE_DV[]" class="ui-spinner chiffre" max="<?=$dispo ?>" value="<?=$row['QTE_DV']?>" ></td>
                    
                    <?php 
                    if ($row['ID_TYPE']=="1"){ 
                        echo '<td><input id="r'.$num.'" type="checkbox" name="r[]"  onchange="rabot(this,'.$num.')"';
                              
                     if ($row['RABOT']=='1'){ 
                         echo 'value="1" checked="checked" ></td>';
                      }
                      else{ echo ' ></td>';
                      }
                        echo '<td><input id="s'.$num.'" type="checkbox" name="s[]"  onchange="sec(this,'.$num.')"';
                      
                        if ($row['SEC']=='1'){ 
                        echo 'value="1" checked="checked" ></td>';
                            }
                           else{
                        echo '  ></td>';
                             }
                    }else{
                        echo '<td></td><td></td>';
                    }
?> 

             <td><input type="text" id="rabot<?=$num?>" name="rabot<?=$num?>" value="0"></td>
                <td><input type="text" id="sec<?=$num?>" name="sec<?=$num?>"  value="0"></td>
        
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
        
     <div class="form-group">
            <div class="col-xs-2">
                  <button id="ajouter" type="button" name="idDV" value="Ajouter" onclick="afficheDevis(<?=$row['ID_DV']?>)" class=" pull-left btn btn-primary">Ajouter</button>
            </div>
            <div class="col-xs-offset-8 col-xs-2">
                <button type="submit" name="Submit" value="Valider" class=" btn btn-primary">Valider</button> 
            </div>
        </div>
        </div>
      </form>
                   <script type="text/javascript">
  
      function rabot(rabotage,num){
                var rep = document.getElementById('rabot'+num).value;
            if(rabotage.checked === true){
                document.getElementById('rabot'+num).value='1';
            alert(rep);
        }else{
            document.getElementById('rabot'+num).value='0';
            alert(rep);
        }
        }
 
       function sec(seche,num){
            if(seche.checked === true){
                var reps=document.getElementById('sec'+num).value;
                document.getElementById('sec'+num).value='1';
            alert(reps);
        }else{
            document.getElementById('sec'+num).value='0';
            alert(reps);
        }
        }
        </script>