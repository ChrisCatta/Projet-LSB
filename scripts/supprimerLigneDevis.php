  <?php require_once('conn.php');
    
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
    
     if(isset($_GET['iddv']) ){
        
        $id_dv_ligne=(int) $_GET['idLDV'];
        $idDV=(int) $_GET['iddv'];
         }      
        else{
                echo("rien trouve");
               }
        
        $sqlquery="DELETE  FROM contenir_dv WHERE ID_DV_LIGNE='$id_dv_ligne' ";
        
        $result=mysqli_query($link,$sqlquery) or  exit(mysql_error());
    ?> 