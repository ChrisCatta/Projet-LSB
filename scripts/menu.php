<?php
session_start();

 include('../modeles/enteteAdmin.php'); 
 ?>
    <div class="row">
      <div class="col-xs-3">
 <?php
   include('../scripts/connexionDB.php');
    $retour=connexion();
    ////$c=$retour[0];
    $link=$retour[0];
    include('../modeles/bar_menu.php'); 
    bar_menu()
  ?> 
       </div>
       <div class="col-xs-9  well3">
            <div id="accordion6"><h5>Menu Principal</h5><div>
             <p> 
             <div class="row">
         
           <div class="col-xs-4 "><div id="accordion"><h5>Administration</h5><div><a href="administrer.php"><p align="center"><img src="../images/admin1.PNG" class="img-circle" width="100" heigth="100"></p></a></div></div></div>
           <div class="col-xs-4 "><div id="accordion1"><h5>Gestion Des Fournisseurs</h5><div><a href="fournisseur.php"><p align="center"><img src="../images/gestionFour.PNG" class="img-circle" ></p></a></div></div></div>
          
           <div class="col-xs-4 "><div id="accordion2"><h5>Gestion Des Clients</h5><div><a href="client.php"><p align="center"><img src="../images/client.JPG" class="img-circle" ></p></a></div></div></div>

          
        </div>
        <div class="row">
           <div class="col-xs-4 "><div id="accordion3"><h5>Gestion Du Stock</h5><div><a href="stock.php"><p align="center"><img src="../images/stock.PNG" class="img-circle" ></p></a></div></div></div>
           
           <div class="col-xs-4 "><div id="accordion4"><h5>Gestion Des Entrées</h5><div><a href="entree.php"><p align="center"><img src="../images/entree.PNG" class="img-circle" ></p></a></div></div></div>
          
        <div class="col-xs-4 "><div id="accordion5"><h5>Gestion Des Sorties</h5><div><a href="sortie.php"><p align="center"><img src="../images/sortie.PNG" class="img-circle" ></p></a></div></div></div>
            </div>
      
      </p>
  </div>
</div>
</div>
</div>
<?php 
include('../modeles/pied.php'); ?>