 
  <?php require_once('conn.php');
    
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
    ?>
  <?php
              if(isset($_GET['idBL']))
              {
              $idbl=$_GET['idBL'];
              echo $idbl ;
               }
               else{
                echo("rien trouve");
               }
                    if(isset($_GET['idA']))
                    {
                    $idA=$_GET['idA'];
               }
               else{
                echo("article non trouve");
               }
               $qte=$_GET['qtebl'];
               
             echo("Bon N°"+$idbl+"Article :"+$idA+"qte="+$qte);
             
                $reqref= "SELECT L.ID_LIGNE, L.ID_BONL, L.ID_A, L.QTE_BON_L, A.ID_A, A.DESIGNATION FROM contenir_bon_l  L, ARTICLE A WHERE ID_BONL='$idbl' AND A.ID_A='$idA";
                
                  if($resref = mysqli_query($link,$reqref))
                  {
                    $sql = "UPDATE contenir_bon_l SET QTE_BON_L='$qte' WHERE ID_LIGNE='$idbl'";
                    $res = mysqli_query($link,$sql) or exit(mysql_error());
                    $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
                  }
                  else
                  {
                    $req="INSERT INTO contenir_bon_l (ID_BONL, QTE_BON_L,ID_A) VALUES ('$idbl','$qte','$idA')";
                    $res = mysqli_query($link,$req) or exit(mysql_error());
                    $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
                  }
          ?>
               