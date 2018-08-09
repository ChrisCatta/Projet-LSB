<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>
    <div class="row">
      <div class="col-xs-3">
      

    <?php
  include('../scripts/connexionDB.php');
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
    include('../modeles/bar_menu.php'); 
    bar_tarif();
    
    $req="SELECT COUNT(*) AS total FROM Tarifs";
    $res = mysqli_query($link,$req) OR die(mysql_error());
    $row = mysqli_fetch_array($res,MYSQLI_ASSOC);
    $total = $row['total']+1;
      ?> 
    </div> 

    <div class="col-xs-9 ">'; 

      <form name="form1" method="post" action="ajout_tarif2.php" class="well3" >
        <div class="row">
           <div class="col-xs-1">
              <img src="../images/modiclient.PNG" class="img-circle">
           </div>
           <div class="col-xs-10">
            <legend><h1>Ajout d'un Tarif<h1></legend>
          </div>
         </div>
            
    <fieldset>
      <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">Ref tarif</label>
      <div class="col-xs-4">
      <input pattern=".{3,30}" required title="" name="TARIF" id="texte" class="form-control" maxlength="30" value="<?php echo 'Tarif'.$total ;?>">
      </div>
    </div>
    </div>
    <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">Montant HT</label>
      <div class="col-xs-4">
        <input  required title="" name="MONTANTHT"  class="form-control" maxlength="10" 
        value="">
      </div>
      <label for="texte" class="col-xs-2">TVA</label>
      <div class="col-xs-4">
      <input type="number" name="TVA" class="form-control " value="20" maxlength="30">
      </div>
     </div>
    </div>
    <div class="row">
    <div class="form-group">
        <div class="col-xs-2">
                    Montant HT :
         </div>    
         <div class="col-xs-4">
               <select id="select-tarif"  class="selectpicker" name="ID_TARIF" >
  <?php
                 
            $sql ="SELECT * FROM TARIFS ";
            $res = mysqli_query($link,$sql) or exit(mysql_error());
                    while($data=mysqli_fetch_array($res)) 
                    {
                      if(isset($tarif)){
                        if($data['ID_TARIF']==$tarif){
                           echo '<option value="'.$data['ID_TARIF'].'" selected="selected">'.$data['MONTANTHT'].'</option><br/>'; 
                        }
                        else{
                       echo '<option value="'.$data['ID_TARIF'].'">'.$data['MONTANTHT'].'</option><br/>'; //Attention à ne pas oublier le . qui sert à concaténer ton expression
                      }
                    }
                     else{
                        echo '<option value="'.$data['ID_TARIF'].'">'.$data['MONTANTHT'].'</option><br/>'; 
                     }
                  }
                  ?>
                  </select>
          </div>
        </div>
     </div>
    <div class="row">
      <div class="form-group">
          <div class="col-xs-2">
              <a href="listetarifs.php"><button class="btn btn-primary" type="button">Retour</button></a>
           </div>
          <div class="col-xs-offset-8 col-xs-2">
              <button type="submit" name="Submit" value="Ajouter" class="btn btn-primary ">Ajouter</button>
          </div>
        </div>
      </div>
    </fieldset>
        
       
       </form>
       </div>
     </div>
        <script> 
   $(document).ready(function() {
  $('.selectpicker').selectpicker();
});
</script>  
<?php 
include('../modeles/pied.php'); ?>