  <?php require_once('conn.php')?>
                <select id="select-art"  class="selectpicker" name="Art" >
                  <option value=""></option>
                  <?php
                  if(isset($_GET['idfamille']))
                    {
                    $famille=$_GET['idfamille'];
               }
               else{
                $famille=1;
               }
                    $req="select ID_A, DESIGNATION,TYPE   FROM ARTICLE WHERE ID_FAMILLE='$famille'";
                    $res = mysqli_query($link,$req) or exit(mysql_error());
                    while($art=mysqli_fetch_array($res)) 
                    {
                       echo '<option value="'.$art['ID_A'].'">'.$art['DESIGNATION'].'</option><br/>'; //Attention à ne pas oublier le . qui sert à concaténer ton expression
                    }
                     
                    ?> 
                  </select>
              