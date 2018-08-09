  <?php require_once('conn.php');
    
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
     if(isset($_GET['idtype']))
              {
                $type=$_GET['idtype'];
              }
             elseif(isset($_POST['ID_TYPE'] ))
               {
                    $type=$_POST['ID_TYPE'];
                }
                  elseif(isset($type))
                  {
                    $type=$type;
                  }
                  else
                    {
                    $type=1;
                    }
            $sqltype = "SELECT * FROM TYPE order by TYPE";
            $restype = mysqli_query($link,$sqltype) or exit(mysql_error());
  ?>
                <select id="select-type" name ="ID_TYPE"  class="selectpicker">
                  <?php
                    while($datatype=mysqli_fetch_array($restype,MYSQLI_ASSOC)) 
                    { 
                    var_dump($datatype);
                      
                        
                       echo '<option value="'.$datatype['ID_TYPE'].'">'.$datatype['TYPE'].'</option><br/>'; //Attention à ne pas oublier le . qui sert à concaténer ton expression
                      }
                    
                     
                    ?> 
                  </select>
                  <script> $(document).ready(function() {
                      $('.selectpicker').selectpicker();
                    });</script>