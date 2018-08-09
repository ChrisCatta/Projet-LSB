<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>

<!--div class="row">
  <div class="col-xs-offset-2 col-xs-8">
      <h3>Système de gestion des stages</h3>
      </div>
    </div>-->
    <div class="row">
      <div class="col-xs-2">
      

    <?php
   include('../scripts/connexionDB.php');
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
  
    include('../modeles/bar_menu.php'); 
    bar_entree(3);
    echo ' </div> ';
   foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
   
    echo '<div class="col-xs-8">';
    
 
     $sqlquery1="select distinct A.PRIX_U, C.QTE_BON_L from ARTICLE A, CONTENIR_BON_L C where A.ID_A=$_ID_A AND C.ID_A=A.ID_A";
     $result1=mysqli_query($link,$sqlquery1);
     $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
     $qte=$row1['QTE_BON_L'];
     $prix=$row1['PRIX_U'] - (0.2*$row1['PRIX_U']);
     $sqlquery="insert into CONTENIR_BON_L values ($_ID_BONL, $_ID_A,$qte,$prix)";
     $result=mysqli_query($link,$sqlquery) or die(panel('panel-danger','Erreur d\'enregistrement ','<p> <img src="../images/ERREUR.gif"><strong>Echec de l\'enregistrement</strong></p>'));

     panel('panel-success','Enregistrement réussi','<p> <img src="../images/ok.PNG">La Ligne de Livraison a été enregistré correctement.</p>');
     $sqlquery2="select count(*) as 'n' from CONTENIR_BON_L WHERE ID_BONL=$_ID_BONL";
     $result2=mysqli_query($link,$sqlquery2);
     $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);


     $sqlquery3="select count(distinct C.ID_A) as 'n' from CONTENIR_BON_L C, LIV_BON L WHERE L.ID_BONL=$_ID_BONL AND L.ID_BONL=C.ID_BONL";
     $result3=mysqli_query($link,$sqlquery3);
     $row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);

     if( $row2['n']==$row3['n'])
     {
      $sqlquery4="update LIV_BON SET SOLDE='OUI' WHERE ID_BONL=$_ID_BONL";
     $result4=mysqli_query($sqlquery4) ;

     //panel('panel-success','Enregistrement réussi','<p> <img src="../images/ok.PNG">La Ligne de Livraison a été enregistré correctement.</p>');
     }
     $sqlquery5="update ARTICLE SET QTE_STO=QTE_STO+$qte WHERE ID_A IN(SELECT ID_A FROM CONTENIR_BON_L C, LIV_BON L WHERE L.ID_BONL=$_ID_BONL AND L.ID_BONL=C.ID_BONL)";
     $result5=mysqli_query($sqlquery5) ;
   echo '</div>';
     
   
      
    ?> 



</div>
 
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>