<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>
    <div class="row">
      <div class="col-xs-3">
      

    <?php
    include('../scripts/connexionDB.php');
    $retour=connexion();
//$c=$retour[0];
$link=$retour[0];
   
    include('../modeles/bar_menu.php'); 
    bar_stock(0);
    echo ' ';
  
   
    ?> 
       </div>
         <div class="col-xs-9">
     <div id="accordion6"><h5>Présentation de la partie Gestion du Stock</h5><div>

    <p><h2><img src="../images/fleche.gif" width="50" heigth="50" >&nbsp;&nbsp;&nbsp;Gestion du Stock</h2></p>
    <p>
        Bienvenu dans la partie qui va vous permettre de gerer votre stock:
    
    <ul>
       <li>Lister les Articles</li>
       <li>Ajouter les Articles</li>
       <li>Supprimer les Articles</li>
       <li>Modifier les Articles</li>
       <li>Rechercher les Articles</li>
        <li>Visualiser des état de Stocks</li>
        <ul>
          <li>Articles en rupture</li>
          <li>Articles en Stock minimum</li>
        </ul>
    </ul>
    
    </p>
  </div>

</div>
</div>

</div>
<?php 
include('../modeles/pied.php'); ?>