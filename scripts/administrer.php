<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>
    <div class="row">
      <div class="col-xs-3">
      <?php
            include('../modeles/bar_menu.php'); 
           include('../scripts/connexionDB.php');
            $retour=connexion();
            //$c=$retour[0];
           $link=$retour[0];

           if($c==1)
           {
             bar_administration(0);
             ?>
      </div> 
     <div class="col-xs-9">
      <div id="accordion6"><h5>Présentation de la partie Administration</h5><div>
          <p><h2><img src="../images/fleche.gif" width="50" heigth="50" >&nbsp;&nbsp;&nbsp;Administration</h2></p>
          <p>Bienvenue dans la partie administration de l\'application qui va vous permettre plusieurs options:
            <ul>
               <li>Lister les Utilisateurs</li>
               <li>Ajouter les Utilisateurs</li>
               <li>Supprimer les Utilisateurs</li>
               <li>Modifier les Utilisateurs</li>
               <li>Rechercher les Utilisateurs</li>
            </ul>
           </p>
      </div>
        <h5>Démonstration</h5>
      <div>
          <p>
              <video controls poster="../images/VideoAdministration.PNG" width="800" height="400">
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
   }    
   else
   {
      
       bar_menu(2) ;
echo '     
    <div class="col-xs-8">';
   
     panel('panel-danger','<h2><strong>Aucun droit</strong></h2>','<p> <strong>Cette partie de l\'administration est réservé vous ne pouvez pas y accéder pour les raisons suivantes:</p>
      <p><img src="../images/interdit.PNG" alt="interdit"></p>
      <p class="interdit">
          Vous n\'avez pas les droits requis
     <br/> Vous utilisez un mauvais compte d\'administration</strong>

      </p>');

  

      
      
      
   echo '</div>

     </div>';
   }
   
    ?> 
       

   
 </td>

  </tr>

  

</table>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>