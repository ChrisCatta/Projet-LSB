  <?php require_once('conn.php');
    
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
    ?>
                <select id="select-famille"  onclick="famille()" class="selectpicker" name="ID_FAM" >
  <?php
                  if(isset($_GET['idtype']))
                  {
                    $type=$_GET['idtype'];
                  }
                  else{
                    $type=1;
                  }
            $sql ="SELECT * FROM FAMILLE WHERE ID_TYPE='$type' ORDER BY ID_FAM ASC";
            $res = mysqli_query($link,$sql) or exit(mysql_error());
                    while($data=mysqli_fetch_array($res)) 
                    {
                       echo '<option value="'.$data['ID_FAM'].'">'.$data['FAMILLE'].'</option><br/>'; //Attention à ne pas oublier le . qui sert à concaténer ton expression
                    }
                     ?> 
                <input type="hidden" id="FAMILLE" name="FAMILLE" value="<?=$data['FAMILLE']?>" />
                  </select>
                  
                  <script> $(document).ready(function() {
                  $('.selectpicker').selectpicker();
                  });
                  </script>