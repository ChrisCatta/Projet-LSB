<?php include('../modeles/entete.php'); ?>

      <!--h3>Connexion au systéme de gestion</h3-->
      
        <div class="row">
         
          <div class=" col-xs-offset-3 col-xs-6">
              <form name="form1" method="post" action="connexion.php" class="well3">
                  <p>
             <div class="row">
                  <div class="col-xs-2">
                        <img src="../images/identification.PNG" class="img-circle" width="100" height="100">
                  </div>
                 <div class="col-xs-10">
                      <h1>Authentification</h1>
                </div>
            </div>
            
    <fieldset>
          <div class="row">
              <div class="form-group">
                      <label for="texte" class="col-xs-2">Login</label>
                      <div class="col-xs-10">
                            <input type="text" name="LOGIN" id="texte" class="form-control " maxlength="20" placeholder="Login">
                      </div>
              </div>
        </div>
        <div class="row">
              <div class="form-group">
                      <label for="PW" class="col-xs-2">password</label>
                      <div class="col-xs-10">
                            <input type="password" name="PW" id="PW" class="form-control" maxlength="20" placeholder="Password">
                      </div>
              </div>
        </div>
        <div class="row">
             <div class="form-group">
                  <label for="select" class="col-xs-2">Catégorie</label>
                  <div class="col-xs-10">
                            <select id="select" name="categorie" class="form-control ">
                                  <option value="1">Administration</option>
                                  <option value="2">Employé</option>
                              </select>
                  </div>
          </div>
    </div>
     <div class="row">
          <div class="form-group">
                <input type="hidden" name="time"  value="<?php echo  time() ?>" >
                <input type="hidden" name="tps" value="2400">
                <input type="submit" name="Submit" class="btn btn-primary" value="Se connecter" class=" pull-right">
          </div>
    </div>
  </fieldset>
          
      </form>
       </div>
     </div>