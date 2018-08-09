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
    bar_entree(3);
    ?>
    <div class="col-xs-9 well3">
      <?php
      if(isset($_POST['ID_LIGNE']))
        {
        $id_liv_ligne=$_POST['ID_LIGNE'];
        }
      elseif(isset($_GET['ID_LIGNE']))
        {
        $id_liv_ligne=$_GET['ID_LIGNE'];
        }
 
        $sqlquery="delete from CONTENIR_BON_L WHERE ID_LIGNE=$id_liv_ligne";
        
        $result=mysqli_query($link,$sqlquery) or die()
    ?> 
    
</div>
<?php 
include('../modeles/pied.php'); ?>