<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>
    <div class="row ">
      <div class="col-xs-3">
      
    
    <?php
   include('../scripts/connexionDB.php');
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
    
    include('../modeles/bar_menu.php'); 
    bar_sortie(3);
    echo ' </div> 

    <div class="col-xs-9 well3">';
   $ID_CO=$_POST['ID_CO'];
   
   $sqlquery2="SELECT C.ID_CO, sum((A.QTE*C.QTE_CO)*A.PV_HT) as 'THT', sum((A.QTE*C.QTE_CO)*A.PV_HT*(1+0.20)) as 'TTC' , format(sum(A.VOL*C.QTE_CO),3,'fr_FR') as 'VOLCO'
               from CONTENIR_CO C, ARTICLE A
               where C.ID_CO='$ID_CO' AND A.ID_A=C.ID_A";
               $result2=mysqli_query($link,$sqlquery2);
               $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
    
    $sqlquery1="SELECT *
              FROM  COMMANDE L, CLIENT C
              WHERE L.ID_CO='$ID_CO' AND C.ID_C=L.ID_C";
   $result1=mysqli_query($link,$sqlquery1);
   $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
     
             //The original date format.
          $original = $row1['DATE_CO'];
          list($year, $month, $day) = explode("-", $original);
          
          //Explode the string into an array.
          $exploded = explode("-", $original);
           
          //Reverse the order.
          $exploded = array_reverse($exploded);
           
          //Convert it back into a string.
          $newFormat = implode("/", $exploded);
  panel_tab_defaut('panel-success','<div class="row">')?>
          <div class="col-xs-12"> 
            <h2 class="text-center">
              <strong>
                <img src="../images/ajoutcommande.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;&nbsp;Lignes de Commande</strong>
              </h2> 
            </div>
        </div>
        <div class="row">
            <div class=" col-xs-4 ">Livraison :  <em class="ligneCommande"><?php echo $row1['REF_CO'].'/'.$year?></em> </div>
             <div class=" col-xs-4 ">Date :  <em class="ligneCommande"><?=$newFormat?></em> </div>
            <div class=" col-xs-4 ">Client :  <em class="ligneCommande"><?=$row1['RAISSO_C']?></em> </div>
        </div>

<div class="row">
    <div class="form-group">
      <div class="col-xs-12">
      
    <?php
     $req="select *  FROM UNITE ";
            $res = mysqli_query($link,$req) or exit(mysql_error());
            $rows = array();
            while($row=mysqli_fetch_array($res)){
              $rows[] = $row;
              }
              foreach($rows as $row){
             $unite=$row['UNITE'];
             
   $sqlquery="SELECT A.UNITE, A.QTE, A.VOL, A.ID_A, A.DESIGNATION,A.LONGUEUR, A.LARGEUR, A.UNITE, A.EPAISSEUR, A.DIAMETRE, A.PV_HT, A.FAMILLE, A.TYPE, C.ID_CO, C.ID_CO_LIGNE, C.QTE_CO, (C.QTE_CO*A.QTE)*A.PV_HT as 'MONTANT'
              FROM  ARTICLE A, CONTENIR_CO C
              WHERE  C.ID_CO='$ID_CO' AND A.ID_A=C.ID_A AND A.UNITE='$unite' order by DESIGNATION ASC";
     
   $result=mysqli_query($link,$sqlquery);
   $nombre=mysqli_num_rows($result);
   if($nombre!=0)
     {
     if($unite=="M3")
       {
   ?>          
 <!--<form name="listArt" method="POST" action="update-comm.php">-->
   <table class="info" border="1">
     <thead>  
         <tr class="info">
            <th></th><th><strong>Désignation</strong></th>
              <th><strong>Long</strong></th>
              <th><strong>Larg</strong></th>
              <th><strong>Ep</strong></th>
              <th><strong>Quantité</strong></th>
              <th><strong>M3</strong></th>
              <th><strong>Prix_Vente</strong></th>
              <th><strong>Montant</strong></th>
           
           
         </tr>
     </thead>
   <?php
   $MONTANT =0;
    $VOLUME=0;
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
 ?>
       <tr>
           <td>
             <form name="formsupprimer" action="supprimerLigneCommande.php" method="post"><div class="supprime"><input type="hidden" name="ID_CO" value="<?=$row1['ID_CO']?>"><input name="ID_CO_LIGNE" type="submit" class="ajoute" value="<?=$row['ID_CO_LIGNE']?>" title="Supprimer Commande"></div></form></td>
           
           <td><?=$row['DESIGNATION']?></td>
           <td><?php echo $row['LONGUEUR']?></td>
           <td><?php echo $row['LARGEUR']?></td>
           <td><?php echo $row['EPAISSEUR']?></td>
           <td><?php echo $row['QTE_CO']?></td>
           <td style="text-align:right"> <?php echo number_format($row['QTE']*$row['QTE_CO'],3,',',' ')?></td>
           <td style="text-align:right"><?php echo  number_format($row['PV_HT'],0,',',' ')?></td>
           <td style="text-align:right"><?php echo number_format($row['MONTANT'],0,',',' ')?></td>
       </tr>
   <?php
     $VOLUME=$VOLUME+$row['QTE']*$row['QTE_CO'];
   }
    $sqlquery3="SELECT  A.UNITE, sum((L.QTE_CO*A.QTE)*A.PV_HT) as 'THT', sum((L.QTE_CO*A.QTE)*A.PV_HT*(1+0.20)) as 'TTC', sum(A.VOL*L.QTE_CO) as 'VOLCO'
               from CONTENIR_CO L, ARTICLE A
               where L.ID_CO='$ID_CO' AND A.ID_A=L.ID_A AND A.UNITE='$unite'";
    if($result3=mysqli_query($link,$sqlquery3)){
    $row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
     }
  ?>
              <td colspan="6" class="success"><strong>Volume et Montant hors Taxe</strong></td>
              <td class="" style="text-align:right"><strong><?php echo number_format($VOLUME,3,',',' ')?></strong></td>
              <td></td>
              <td class="" style="text-align:right"><strong><?php echo number_format($row3['THT'],0,',',' ')?></strong></td>
          </tr>
          </table>
          <hr>
   <?php
     }
     elseif($unite=="M2")
       {
   ?>           <table class="info" border="1" >
              <!--<tr>
                <td width="20%"><strong><?=$row['UNITE']?></strong></td>
              </tr>-->
            <thead>  
   <tr class="success">
      <th></th>
      <th><strong>Désignation</strong></th>
      <th><strong>Long</strong></th>
      <th><strong>Larg</strong></th>
      <th><strong>Ep</strong></th>
      <th><strong>Quantité</strong></th>
      <th><strong>M2</strong></th>
      <th><strong>M3</strong></th>
      <th><strong>Prix_Vente</strong></th>
      <th><strong>Montant</strong></th>
     </tr>
     </thead>
   <?php
    $VOLUME=0;
    $SURFACE=0;
      while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
 ?>
   <tr>
           <td>
             <form name="formsupprimer" action="supprimerLigneDevis.php" method="post">
               <div class="supprime">
                 <input type="hidden" name="ID_CO" value="<?=$row['ID_CO']?>">
                 <input name="idlCO" type="submit" class="ajoute" value="<?=$row['ID_CO_LIGNE']?>" title="Supprimer Devis">
               </div>
             </form>
           </td>
           
           <td> <?php echo $row['DESIGNATION']?></td>
           <td><?php echo $row['LONGUEUR']?></td>
           <td><?php echo $row['LARGEUR']?></td>
           <td><?php echo $row['EPAISSEUR']?></td>
           <td><?php echo $row['QTE_CO']?></td>
           <td style="text-align:right"> <?php echo number_format($row['QTE']*$row['QTE_CO'],3,',',' ')?></td>
           <td style="text-align:right"> <?php echo number_format($row['VOL']*$row['QTE_CO'],3,',',' ')?></td>
           <td style="text-align:right"><?php echo number_format($row['PV_HT'],0,',',' ')?></td>
           <td style="text-align:right"><?php echo number_format($row['MONTANT'],0,',',' ')?></td>
       </tr>
       <tr>
   <?php
     $VOLUME=$VOLUME+$row['VOL']*$row['QTE_CO'];
     $SURFACE=$SURFACE+$row['QTE']*$row['QTE_CO'];
       }
    $sqlquery3="SELECT  A.UNITE, sum((L.QTE_CO*A.QTE)*A.PV_HT) as 'THT', sum((L.QTE_CO*A.QTE)*A.PV_HT*(1+0.20)) as 'TTC', sum(A.VOL*L.QTE_CO) as 'VOLCO'
               from CONTENIR_CO L, ARTICLE A
               where L.ID_CO='$ID_CO' AND A.ID_A=L.ID_A AND A.UNITE='$unite'";
    if($result3=mysqli_query($link,$sqlquery3)){
    $row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
     }
     ?>
              <td colspan="6" class="success"><strong>Volume et Montant hors Taxe</strong></td>
              <td class="" style="text-align:right"><strong><?php echo number_format($SURFACE,3,',',' ')?></strong></td>
              <td class="" style="text-align:right"><strong><?php echo number_format($VOLUME,3,',',' ')?></strong></td>
              <td></td>
              <td class="" style="text-align:right"><strong><?php echo number_format($row3['THT'],0,',',' ')?></strong></td>
          </tr>
         </table>
         <hr>
   <?php
       }
     elseif($unite=="ML")
       {
   ?>
            <table class="info" border="1" width="100%" >
              <!--<tr>
                <td width="20%"><strong><?=$row['UNITE']?></strong></td>
              </tr>-->
            <thead>  
   <tr class="success">
      <th></th>
      <th><strong>Désignation</strong></th>
      <th><strong>Long</strong></th>
      <th><strong>Diam</strong></th>
      <th><strong>Quantité</strong></th>
      <th><strong>ML</strong></th>
      <th><strong>M3</strong></th>
      <th><strong>Prix_Vente</strong></th>
      <th><strong>Montant</strong></th>
     </tr>
     </thead>
   <?php
    $VOLUME=0;
    $QUANTITE=0;
      while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
 ?>
       <tr>
           <!--td><form name="formafficher" action="afficheLivraison.php" method="post"><div class="affiche"><input name="afficheLivraison" type="submit" class="ajoute" value="'.$row['ID_A'].'" title="Détail Livraison"></div></form></td-->

           <td>
             <form name="formsupprimer" action="supprimerLigneDevis.php" method="post">
               <div class="supprime">
                 <input type="hidden" name="ID_CO" value="<?=$row['ID_CO']?>">
                 <input name="idlCO" type="submit" class="ajoute" value="<?=$row['ID_CO_LIGNE']?>" title="Supprimer Devis">
               </div>
             </form>
           </td>
           
           <td> <?php echo $row['DESIGNATION']?></td>
           <td><?php echo $row['LONGUEUR']?></td>
           <td><?php echo $row['DIAMETRE']?></td>
           <td><?php echo $row['QTE_CO']?></td>
           <td style="text-align:right"> <?php echo number_format($row['QTE']*$row['QTE_CO'],0,',',' ')?></td>
           <td style="text-align:right"> <?php echo number_format($row['VOL']*$row['QTE_CO'],3,',',' ')?></td>
           <td style="text-align:right"><?php echo number_format($row['PV_HT'],0,',',' ')?></td>
           <td style="text-align:right"><?php echo number_format($row['MONTANT'],0,',',' ')?></td>
       </tr>
       <tr>
   <?php
     $VOLUME=$VOLUME+$row['VOL']*$row['QTE_CO'];
     $QUANTITE=$QUANTITE+$row['QTE']*$row['QTE_CO'];
       }
       
    $sqlquery3="SELECT  A.UNITE, sum((L.QTE_CO*A.QTE)*A.PV_HT) as 'THT', sum((L.QTE_CO*A.QTE)*A.PV_HT*(1+0.20)) as 'TTC', sum(A.VOL*L.QTE_CO) as 'VOLCO', sum(A.QTE*L.QTE_CO) as 'QTECO'
               from CONTENIR_CO L, ARTICLE A
               where L.ID_CO='$ID_CO' AND A.ID_A=L.ID_A AND A.UNITE='$unite'";
    if($result3=mysqli_query($link,$sqlquery3)){
    $row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
     }
     ?>
              <td colspan="5" class="success"><strong>Volume et Montant hors Taxe</strong></td>
              <td class="" style="text-align:right"><strong><?php echo number_format($QUANTITE,0,',',' ')?></strong></td>
              <td class="" style="text-align:right"><strong><?php echo number_format($VOLUME,2,',',' ')?></strong>
              <td></td>
              <td class="" style="text-align:right"><strong><?php echo number_format($row3['THT'],0,',',' ')?></strong></td>
          </tr>
         </table>
       <?php
          }
       }
     }
   ?>
   <hr>
   <table>
          <tr>
              <td colspan="7" width="60%"><strong>Volume et Montant hors Taxe</strong></td>
              <td width="10%" style="text-align:right"><strong><?php echo $row2['VOLCO']?></strong></td>
              <td width="15%">&nbsp;</td>
              <td class="" style="text-align:right"><strong><?php echo number_format($row2['THT'],0,',',' ')?></strong></td>
          </tr>
          <tr>
                <td colspan="9" class="success"><strong>Montant TVA</strong></td>
                <td class="" style="text-align:right"><strong><?php echo number_format($row2['TTC']-$row2['THT'],0,',',' ')?></strong></td>
          </tr>
          <tr>
              <td colspan="9" class="success"><strong>Montant tous taxes comprises</strong></td>
              <td class="" style="text-align:right"><strong><?php echo number_format($row2['TTC'],0,',',' ')?></strong></td>
          </tr>
   </table>
    </div>
    </div>
    </div>
   <div class="row"> 
     <div class="form-group">
      <div class="col-xs-2">
         <a href="commande_sortie.php"><button class="btn btn-primary" type="button">Retour</button></a>
        </div>
      <!-- <input type="hidden" name="ID_CO_LIGNE" value="<?php echo $row2['ID_CO_LIGNE']?>" >-->
       <input  type="hidden" name="ID_CO"  value="<?php echo $row2['ID_CO']?>" >
        <div class="col-xs-offset-8 col-xs-2">
          <button type="submit" name="Submit" value="Valider" class="  btn btn-primary ">Valider</button> 
      </div>
    </div>
  </div>
 
    <!--Div de la fonction panel_tab-->
  </div>
 </div>
    </div>

<?php 
include('../modeles/pied.php'); ?>