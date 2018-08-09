 <?php require_once('conn.php');
    
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
    
     if(isset($_GET['idco']) ){
        
        $id_co_ligne=(int) $_GET['idLCO'];
        $idCO=(int) $_GET['idco'];
         }      
        else{
                echo("rien trouve");
               }
     echo ("Voulez vous vraiment supprimer la ligne CO ="+$idCO +" et "+$id_co_ligne);
      
        $sqlquery="DELETE  FROM contenir_co WHERE ID_CO_LIGNE='$id_co_ligne' ";
          $result=mysqli_query($link,$sqlquery) or die();
          ?> 