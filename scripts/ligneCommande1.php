<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>
<script>
  $(document).ready(function(){
                  chargerCategories();
                  chargerFamille(1);
                  chargerListeCommType(1);
  });
</script>
    <div class="row">
      <div class="col-xs-3">
      
    
    <?php
   include('../scripts/connexionDB.php');
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
    
    include('../modeles/bar_menu.php'); 
    bar_sortie();
    echo ' </div> 

    <div class="col-xs-9 well3">';
   $ID_CO=$_POST['ID_CO'];
   $sqlquery1="SELECT * FROM COMMANDE  WHERE  ID_CO='$ID_CO'   ";
   $result1=mysqli_query($link,$sqlquery1);
   $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
   
   ?>
    <div class="row ">
        <div class="col-xs-12"> 

        <input type="hidden" id="idco" value="<?php echo $row1['ID_CO']?>"/>
          <h2 class="text-center">
          <strong><img src="../images/ajoutcommande.PNG" width="100" heigth="100" class="img-circle">&nbsp;&nbsp;&nbsp;Liste Des lignes de Commande</strong>
          </h2> 
         </div>
      </div>
    <div class="row">
    <div class=" col-xs-6 ">Livraison :  <em class="ligneCommande"><?=$row1['ID_CO']?></em> </div>
    <div class=" col-xs-6">Date :  <em class="ligneCommande"><?=$row1['DATE_CO'].' - '.$row1['REF_CO']?></em> </div>
    </div>
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

      <div class="row">
          <div class="col-xs-12">
              Liste articles :
                <div  id="div-list-comm">
                 </div>
          </div>
      </div>     
      
    <form name="listArt" method="POST" action="update-comm.php">
      <div class="row">
          <div class="col-xs-12">
              Liste de Commande:
                <div  id="div-comm-art">
                 </div>
          </div>
      </div>
        
  </div>
    </div>
</div>
<script type="text/javascript">
  var idco='<?=$row1['ID_CO']?>';
  afficheCommande(idco);
  </script>
<?php 
include('../modeles/pied.php'); ?>