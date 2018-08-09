<?php
session_start();
   include('../modeles/enteteAdmin.php');
    
?>

    <div class="row">
      <div class="col-xs-3">
      

    <?php
   include('../scripts/connexionDB.php');
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0]; 
    include('../modeles/bar_menu.php'); 
    bar_stock(7);
    foreach($_POST as $key => $value)
   {
    $varname="_".$key;
    $$varname=$value;
   }
      // Debut de la partie page1 de la recherche par login //////////////////////////////////////////////////////////////////////////////////  
         echo ' </div> ';
   echo '<div class="col-xs-9 well3">';

   if($_PAGE==1)
 {

  $conditions = array();
        if ($_POST['DESIGNATION']<>"")
        {
            $conditions[] = "DESIGNATION LIKE '".$_POST['DESIGNATION']."'";  
        } 
        if ($_POST['FAMILLE']<>"")
        {
            $conditions[] = "FAMILLE = '".$_POST['FAMILLE']."'";  
        } 
        
        if (count($conditions) == 0)
        {
            $where = "";
        }
        else
        {
           $where = " WHERE ".implode(' AND ',$conditions);
        }
   $sqlquery="select * FROM ARTICLE " .$where ;
   if($result=mysqli_query($link,$sqlquery))
   {
   panel_tab('panel-success','<img src="../images/listeArticle.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;&nbsp;Resultat de La Recherche');
   ?>
   <table id="cherche1" class="display">
    <thead>
       <tr class="success">
          <th><strong>Modif</strong></th>
          <th><strong>Id</strong></th>
          <th><strong>Ref</strong></th>
          <th><strong>Type</strong></th>
          <th><strong>Famille</strong></th>
          <th><strong>Long</strong></th>
          <th><strong>UNITE</strong></th>
          <th><strong>Epais</strong></th>
          <th><strong>Qte/U</strong></th>
          <th><strong>Prix_Uni</strong></th>
          <th><strong>Qte_Stock</strong></th>
          <th><strong>Qte_Seuil</strong></th>
          <th><strong>Image</strong></th>
       </tr>
    </thead>
    <?php
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    if($row['CHEMIN_IMG']== NULL)
    {
      $row['CHEMIN_IMG']='../images/pasimage.PNG';
    }
    
                      $article=$row['ID_A'];
                      $type =$row['ID_TYPE'];
                      $famille=$row['ID_FAMILLE'];
                      $req1="SELECT ID_A, SUM(QTE_BON_L) AS QTE_ENTREE from contenir_bon_l where ID_A='$article'";
                      $res1=mysqli_query($link,$req1);
                     $row1=mysqli_fetch_array($res1,MYSQLI_ASSOC);

                      $req2="SELECT ID_A, SUM(QTE_CO) AS QTE_SORTIE from contenir_co where ID_A='$article'";
                      $res2=mysqli_query($link,$req2);
                     $row2=mysqli_fetch_array($res2,MYSQLI_ASSOC);
                     
                     //color ligne table
                     $dispo=$row['QTE_STO']+$row1['QTE_ENTREE']-$row2['QTE_SORTIE'];
                     $mini=$row['QTE_MIN'];
                     if($dispo>$mini){
                       $color="stockOK";
                       }
                       else{
                         if((0<$dispo)&($dispo<$mini)){
                           $color="stockLimite";
                           }
                           else{
                             $color="stockDown";
                             }
                         }
  ?>
    <tbody>
       <tr class="<?=$color?>" id="<?php echo $row['ID_A']?>" data-info="<?php echo $row['ID_A']?>">
      <td><form name="formafficher" action="modification_article1.php" method="post"><div class="affiche">
              <input type="hidden" id="ID_TYPE" name="ID_TYPE" value="<?=$row['ID_TYPE']?>" /><input name="ID_A" type="submit" class="ajoute" value="<?=$row['ID_A']?>" title="Détail Article"></div></form></td>
           <td><?=$row['ID_A']?></td>
           <td><?=$row['DESIGNATION']?></td>
           <td><?=$row['TYPE']?></td>
           <td><?=$row['FAMILLE']?></td>
           <td><?=$row['LONGUEUR']?></td>
           <td><?=$row['UNITE']?></td>
           <td><?=$row['EPAISSEUR']?></td>
           <td><?php echo ($row['QTE'])?></td>
           <td><?=$row['PRIX_U']?></td>
           <td><?php echo $dispo ?></td>
           <td><?=$row['QTE_MIN']?></td>
           <td><img src="<?php echo $row['CHEMIN_IMG']?>" width="50" height="50" align="center"></td>
       </tr>
    <?php
   }
   ?>
   </tbody></table>
   <?php
   }
     else 
       {
     panel('panel-danger','<p> <img src="../images/ERREUR.gif"><strong>panel-danger','Il n\'y a pas d\'enregistrements!</strong></p><br/>');
     }
    $req = "SELECT SUM( LONGUEUR*LARGEUR/1000*QTE_STO ) AS total FROM ARTICLE " .$where.  "AND QTE_STO>0 ";
    if($retour = mysqli_query ($link,$req)){
    $donnees = mysqli_fetch_array($retour);
  }
    $req1 = "SELECT SUM( LONGUEUR*LARGEUR/1000*EPAISSEUR/1000*QTE_STO ) AS total FROM ARTICLE " .$where.  "AND QTE_STO>0 ";
   if($retour1 = mysqli_query ($link,$req1)){
    $donnees1 = mysqli_fetch_array($retour1);
     }
    
   // FIN de la partie page2 de la recherche par login //////////////////////////////////////////////////////////////////////////////////  
}
 if($_PAGE==2)
{
           $conditions = array();
        if ($_POST['LONGUEUR']<>"")
        {
            $conditions[] = "LONGUEUR = ".$_POST['LONGUEUR'];  
        } 
        if ($_POST['LARGEUR']<>"")
        {
            $conditions[] = "LARGEUR = ".$_POST['LARGEUR'];  
        } 
        if ($_POST['EPAISSEUR']<>"")
        {
            $conditions[] = "EPAISSEUR = ".$_POST['EPAISSEUR'];  
        } 

        if (count($conditions) == 0)
        {
            $where = "";
        }
        else
        {
           $where = " WHERE ".implode($conditions,' AND ');
        }
   $sqlquery="select * FROM ARTICLE" .$where. " AND QTE_STO>0"  ;
   if($result=mysqli_query($link,$sqlquery)){
   panel_tab('panel-success','<img src="../images/listeArticle.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;&nbsp;Resultat de La Recherche');
   ?>
   <table id="cherche2" class="table table-bordered table-striped table-condensed">
        <thead>
          <tr class="success">
               <th><strong>Modif</strong></th>
                <th><strong>Id</strong></th>
                <th><strong>Ref</strong></th>
                <th><strong>Type</strong></th>
                <th><strong>Famille</strong></th>
                <th><strong>Long</strong></th>
                <th><strong>Lar</strong></th>
                <th><strong>Epais</strong></th>
                <th><strong>Qte/U</strong></th>
                <th><strong>Prix_Uni</strong></th>
                <th><strong>Qte_Stock</strong></th>
                <th><strong>Qte_Seuil</strong></th>
                <th><strong>Image</strong></th>
             </tr>
    </thead>
    <?php
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    if($row['CHEMIN_IMG']== NULL)
    {
      $row['CHEMIN_IMG']='../images/pasimage.PNG';
    }
                      $article=$row['ID_A'];
                      $type =$row['ID_TYPE'];
                      $famille=$row['ID_FAMILLE'];
                      $req1="SELECT ID_A, SUM(QTE_BON_L) AS QTE_ENTREE from contenir_bon_l where ID_A='$article'";
                      $res1=mysqli_query($link,$req1);
                     $row1=mysqli_fetch_array($res1,MYSQLI_ASSOC);

                      $req2="SELECT ID_A, SUM(QTE_CO) AS QTE_SORTIE from contenir_co where ID_A='$article'";
                      $res2=mysqli_query($link,$req2);
                     $row2=mysqli_fetch_array($res2,MYSQLI_ASSOC);
   ?>
    <tbody>
       <tr class="<?=$color?>" id="<?php echo $row['ID_A']?>" data-info="<?php echo $row['ID_A']?>">
      <td><form name="formafficher" action="modification_article1.php" method="post"><div class="affiche"><input name="ID_A" type="submit" class="ajoute" value="<?=$row['ID_A']?>" title="Détail Article"></div></form></td>
           <td><?=$row['ID_A']?></td>
           <td><?=$row['DESIGNATION']?></td>
           <td><?=$row['TYPE']?></td>
           <td><?=$row['FAMILLE']?></td>
           <td><?=$row['LONGUEUR']?></td>
           <td><?=$row['LARGEUR']?></td>
           <td><?=$row['EPAISSEUR']?></td>
           <td><?php echo ($row['QTE'])*($row['QTE_STO']+$row1['QTE_ENTREE']-$row2['QTE_SORTIE'])?></td>
           <td><?=$row['PRIX_U']?></td>
           <td><?=$row['QTE_STO']?></td>
           <td><?=$row['QTE_MIN']?></td>
           <td><img src="<?=$row['CHEMIN_IMG']?> " width="50" height="50" align="center"></td>
       </tr>
     </tbody>
   <?php
   }
   ?>
   </table>
   <?php
 }
 else 
       {
     panel('panel-danger','<p> <img src="../images/ERREUR.gif"><strong>panel-danger','Il n\'y a pas d\'enregistrements!</strong></p><br/>');
     }
    $req = "SELECT SUM(LONGUEUR*LARGEUR/1000*QTE_STO) AS total FROM ARTICLE   " .$where. " AND QTE_STO>0 ";
    $retour = mysqli_query ($link,$req);
    $donnees = mysqli_fetch_array($retour);
    $req1 = "SELECT SUM(LONGUEUR*LARGEUR/1000*EPAISSEUR/1000*QTE_STO) AS total FROM ARTICLE  " .$where. " AND QTE_STO>0 ";
    $retour1 = mysqli_query ($link,$req1);
    $donnees1 = mysqli_fetch_array($retour1);
}
  
    
   if($_PAGE==3)
{

           $conditions = array();
        if ($_POST['LONGUEUR']<>"")
        {
            $conditions[] = "LONGUEUR = ".$_POST['LONGUEUR'];  
        } 
        if ($_POST['DIAMETRE']<>"")
        {
            $conditions[] = "DIAMETRE = ".$_POST['DIAMETRE'];  
        } 

        if (count($conditions) == 0)
        {
            $where = "";
        }
        else
        {
           $where = " WHERE ".implode($conditions,' AND ');
        }
   $sqlquery="select * FROM ARTICLE" .$where. " AND QTE_STO>0"  ;
   if($result=mysqli_query($link,$sqlquery)){
   panel_tab('panel-success','<img src="../images/listeArticle.PNG" class="img-circle" width="100" heigth="100">&nbsp;&nbsp;&nbsp;Resultat de La Recherche');
?>
   <table id="cherche3" class="table table-bordered table-striped table-condensed">
        <thead>
             <tr class="success">
                <th><strong>Modif</strong></th>
                <th><strong>Id</strong></th>
                <th><strong>Ref</strong></th>
                <th><strong>Type</strong></th>
                <th><strong>Famille</strong></th>
                <th><strong>Long</strong></th>
                <th><strong>Diametre</strong></th>
                <th><strong>Qte/U</strong></th>
                <th><strong>Prix_Uni</strong></th>
                <th><strong>Qte_Stock</strong></th>
                <th><strong>Qte_Seuil</strong></th>
                <th><strong>Image</strong></th>
             </tr>
    </thead>
    <?php
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    if($row['CHEMIN_IMG']== NULL)
    {
      $row['CHEMIN_IMG']='../images/pasimage.PNG';
    }
                      $article=$row['ID_A'];
                      $type =$row['ID_TYPE'];
                      $famille=$row['ID_FAMILLE'];
                      $req1="SELECT ID_A, SUM(QTE_BON_L) AS QTE_ENTREE from contenir_bon_l where ID_A='$article'";
                      $res1=mysqli_query($link,$req1);
                     $row1=mysqli_fetch_array($res1,MYSQLI_ASSOC);

                      $req2="SELECT ID_A, SUM(QTE_CO) AS QTE_SORTIE from contenir_co where ID_A='$article'";
                      $res2=mysqli_query($link,$req2);
                     $row2=mysqli_fetch_array($res2,MYSQLI_ASSOC);
    ?>
    <tbody>
       <tr class="<?=$color?>" id="<?php echo $row['ID_A']?>" data-info="<?php echo $row['ID_A']?>">
      <td><form name="formafficher" action="modification_article1.php" method="post"><div class="affiche"><input name="ID_A" type="submit" class="ajoute" value="<?=$row['ID_A']?>" title="Détail Article"></div></form></td>
           <td><?=$row['ID_A']?></td>
           <td><?=$row['DESIGNATION']?></td>
           <td><?=$row['TYPE']?></td>
           <td><?=$row['FAMILLE']?></td>
           <td><?=$row['LONGUEUR']?></td>
           <td><?=$row['DIAMETRE']?></td>
           <td><?php echo ($row['QTE'])*($row['QTE_STO']+$row1['QTE_ENTREE']-$row2['QTE_SORTIE'])?></td>
           <td><?=row['PRIX_U']?></td>
           <td><?=$row['QTE_STO']?></td>
           <td><?=$row['QTE_MIN']?></td>
           <td><img src="<?=$row['CHEMIN_IMG']?> " width="50" height="50" align="center"></td>
       </tr>
     </tbody>
   <?php
   }
   echo'</table>';
 }
 else 
       {
     panel('panel-danger','<p> <img src="../images/ERREUR.gif"><strong>panel-danger','Il n\'y a pas d\'enregistrements!</strong></p><br/>');
     }
    $req = "SELECT SUM(((DIAMETRE/1000/2)*(DIAMETRE/1000/2))*3.14*QTE_STO) AS total FROM ARTICLE   " .$where. " AND QTE_STO>0  ";
    $retour = mysqli_query ($link,$req);
    $donnees = mysqli_fetch_array($retour);
    $req1 = "SELECT SUM(LONGUEUR*((DIAMETRE/1000/2)*(DIAMETRE/1000/2))*3.14*QTE_STO) AS total FROM ARTICLE  " .$where. " AND QTE_STO>0  ";
    $retour1 = mysqli_query ($link,$req1);
    $donnees1 = mysqli_fetch_array($retour1);
}

      ?> 
    <label for="input" >Surface :</label>
            <input type="text" value="<?php echo round($donnees['total'],2);?>">
    <label for="input" >Volume :</label>
            <input type="text" value="<?php echo round($donnees1['total'],2);?>">
            </div>
<!-- div de la fonction panel_tab -->
    </div>
      <div class="form-group">
            <a href="RechercheStock.php"><input type="submit" name="Submit" value="Retour" class=" pull-right btn btn-primary"></a>
      </div>
</div>
<?php 
include('../modeles/pied.php'); ?>