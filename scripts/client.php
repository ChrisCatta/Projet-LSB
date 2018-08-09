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
    bar_client();
   
  
   
    ?> 
       </div> 
      <div class="col-xs-9 well3">
     <div id="accordion6"><h5>Présentation de la partie Gestion des CLients</h5><div>

   <p><h2><img src="../images/fleche.gif" width="50" heigth="50" >&nbsp;&nbsp;&nbsp;Gestion des Client</h2></p>
    <p>
        Bienvenue dans la partie Gestion des Clients de l'application qui va vous permettre plusieurs options:
    
    <ul>
       <li>Lister les Clients</li>
       <li>Ajouter les Clients</li>
       <li>Supprimer les Clients</li>
       <li>Modifier les Clients</li>
       <li>Rechercher les Clients</li>
    </ul>
    
    </p>
  </div>
  <h5>Démonstration</h5><div>
   <p>
    <video controls poster="../images/VideoClient.PNG" width="800" height="400">
   <source src="../modeles/sintel.mp4" />
   <source src="../modeles/sintel.webm" />
   <source src="../modeles/sintel.avi" />
   </video>
    </p>
</div>
</div>
</div>
</div>
<?php 
include('../modeles/pied.php'); ?>