  <?php require_once('conn.php');
    
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
        if (isset($_GET['idDV'])) {
            $iddv = (int)$_GET['idDV'];
        } else {
            echo("rien trouve");
        }
        if (isset($_GET['idA'])) {
            $idA = (int)$_GET['idA'];
        } else {
            echo("article non trouve");
        }
        $qte = (int)$_GET['qteDV'];

                $reqref= "SELECT  ID_DV, ID_A FROM contenir_dv  WHERE ID_DV='$iddv' AND ID_A='$idA' ";  
                var_dump($reqref);          
                $resref = mysqli_query($link,$reqref);
                $nombreref= mysqli_num_rows($resref);
                if($nombreref==1)
                  {
                    $requpdate = "UPDATE contenir_dv SET QTE_DV='$qte' WHERE ID_DV='$iddv' AND ID_A='$idA'";
                    $resupdate = mysqli_query($link,$requpdate) or exit(mysql_error());
                  }
                  if($nombreref==0)
                  {
                    $reqinsert="INSERT INTO contenir_dv SET ID_DV='$iddv',ID_A='$idA' ,QTE_DV='$qte'";
                    $resinsert = mysqli_query($link,$reqinsert) or exit(mysql_error());
                  }
                
 ?>
               