 
  <?php require_once('conn.php');
    
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
    ?>
  <?php
                    if(isset($_GET['idCO']))
                    {
                    $idco=$_GET['idCO'];
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
               $qte=$_GET['qteCO'];
             
                $reqref= "SELECT C.ID_CO_LIGNE, C.ID_CO, C.ID_A, C.QTE_CO, A.ID_A, A.DESIGNATION FROM contenir_co C, ARTICLE A WHERE ID_CO='$idco' AND A.ID_A='$idA";
                
                  if($resref = mysqli_query($link,$reqref))
                  {
                    $sql = "UPDATE contenir_co SET QTE_CO='$qte' WHERE ID_CO_LIGNE='$idco'";
                    $res = mysqli_query($link,$sql) or exit(mysql_error());
                    $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
                  }
                  else
                  {
                    $req="INSERT INTO contenir_co (ID_CO, QTE_CO,ID_A) VALUES ('$idco','$qte','$idA')";
                    $res = mysqli_query($link,$req) or exit(mysql_error());
                    $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
                  }
          ?>
               