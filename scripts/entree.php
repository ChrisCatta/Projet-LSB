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
    bar_entree(0);
   
  
   
    ?> 
       </div> 
     <div class="col-xs-9 well3">
     <div id="accordion6"><h5>Présentation de la partie Gestion des Entrées</h5><div>

     <p><h2><img src="../images/fleche.gif" width="50" heigth="50" >&nbsp;&nbsp;&nbsp;Gestion des entrées</h2></p>
    <p>
        Bienvenu dans la partie qui va vous permettre de gerer vos Entrées:
    
    <ul>
       <li>Lister les commandes, les lignes de commandes, les livraisons et les lignes de livraisons</li>
       <li>Ajouter les commandes, les lignes de commandes, les livraisons et les lignes de livraisons</li>
       <li>Supprimer les commandes, les lignes de commandes, les livraisons et les lignes de livraisons</li>
       <li>Réaliser vos listes d'entrées</li>
       <li>Visualiser les listes existantes</li>
        <li>Imprimer un etat par entrées au format PDF</li>
        
    </ul>
    
    </p>
  </div>
  <h5>Démonstration</h5><div>
   <p>
    <video controls poster="../images/VideoEntree.PNG" width="800" height="400">
   <source src="../modeles/sintel.mp4" />
   <source src="../modeles/sintel.webm" />
   <source src="../modeles/sintel.avi" />
   </video>
    </p>
</div>
</div>
</div>
     </div>


 </td>

  </tr>

  

</table>
<?php 
include('../modeles/pied.php'); ?>