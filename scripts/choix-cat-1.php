  <?php require_once('conn.php');
            $sql = "SELECT * FROM TYPE order by ID_TYPE";
            $res = mysqli_query($link,$sql) or exit(mysql_error());
  ?>
                <select id="select-type" name ="ID_TYPE" class="selectpicker">
                  <?php
                    while($data=mysqli_fetch_array($res)) 
                    {
                      if(isset($type)){
                        if($type=$data['type']){
                           echo '<option value="'.$data['ID_TYPE'].'" selected="selected">'.$data['TYPE'].'</option><br/>'; 
                        }
                        else{
                       echo '<option value="'.$data['ID_TYPE'].'">'.$data['TYPE'].'</option><br/>'; //Attention à ne pas oublier le . qui sert à concaténer ton expression
                      }
                    }
                     else{
                        echo '<option value="'.$data['ID_TYPE'].'">'.$data['TYPE'].'</option><br/>'; 
                     }
                   }
                    ?> 
                  </select>
                  <script> $(document).ready(function() {
                      $('.selectpicker').selectpicker();
                    });
                    </script>