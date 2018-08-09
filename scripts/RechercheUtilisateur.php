<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>
    <div class="row">
      <div class="col-xs-3">
      

    <?php
   include('../modeles/bar_menu.php'); 
    bar_administration(5);
    ?>
    </div> 

    <div class="col-xs-9 ">
  
  <div id="tabs" class="well3">
        <ul>
          <li><a href="#tabs-1">Rechercher Par Login</a></li>
          <li><a href="#tabs-2">Rechercher Par Nom et Pr√©nom</a></li>
          <li><a href="#tabs-3">Rechercher DÈtaillÈe</a></li>
        </ul>
              <div id="tabs-1">
               <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
                <form name="form1" method="post" action="RechercheUtilisateurResultat.php" >
                    
                    <p>
                       <div class="row">
                              <div class="col-xs-2">
                                <img src="../images/utilisateurRecherche.PNG" class="img-circle" width="100" height="100">
                              </div>
                              <div class=" col-xs-10">
                                  <h1>Recherche Par Login</h1>
                               </div>
                       </div>
                        
                <fieldset>
                  <div class="row">
                        <div class="form-group">
                                <label for="texte" class="col-xs-3">Login</label>
                                <div class="col-xs-9">
                                     <input type="text" name="LOGIN" id="texte" class="form-control" maxlength="30">
                                </div>
                          
                        </div>
                </div>
               
               
                <div class="form-group">
                  
                  <input type="submit" name="Submit" value="Rechercher" class=" pull-right btn btn-primary">
                  <input type="hidden" name="PAGE" value="1">
                </div>
                </fieldset>
                  </form>
                <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
              </div>
  <div id="tabs-2">
    <form name="form1" method="post" action="RechercheUtilisateurResultat.php">
        
        <p>
           <div class="row">
            <div class="col-xs-1">
              <img src="../images/utilisateurRecherche.PNG" class="img-circle" width="100" height="100">
            </div>
            <div class="col-xs-offset-1 col-xs-10">
         		<h1>Recherche Par Nom et PrÈnom</h1>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">Nom</label>
      <div class="col-xs-8">
      <input type="text" name="NOM" id="texte" class="form-control" maxlength="30">
      </div>
      
    </div>
    </div>
     <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">PrÈnom</label>
      <div class="col-xs-8">
      <input type="text" name="PRENOM" id="texte" class="form-control" maxlength="30">
      </div>
      
    </div>
    </div>
    <div class="row">
    <div class="form-group">
             <label for="select" class="col-xs-2">Sexe</label>
            <div class="col-xs-8">
            <select id="select" name="SEXE" class="form-control ">
                  <option value="F">Femme</option>
                  <option value="M">Homme</option>
              </select>
        </div>
     </div>
    </div>
       

    <div class="row">
       <div class="form-group">
          <label for="select" class="col-xs-2">Cat√©gorie</label>
          <div class="col-xs-8">
          <select id="select" name="SERVICE" class="form-control ">
          <option value="ADMINISTRATION">Administration</option>
          <option value="EMPLOYE">Employ√©</option>
          </select>
      </div>
      </div>
    </div>
   
    <div class="form-group">
       <input type="submit" name="Submit" value="Rechercher" class=" pull-right btn btn-primary">
      <input type="hidden" name="PAGE" value="2">
    </div>
    </fieldset>
        
        </p>
      </form>
  </div>
  <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
  <div id="tabs-3">
     <form name="form1" method="post" action="RechercheUtilisateurResultat.php" >
        
        <p>
           <div class="row">
            <div class="col-xs-1">
                           <img src="../images/utilisateurRecherche.PNG" class="img-circle" width="100" height="100">

            </div>
            <div class="col-xs-offset-1 col-xs-10">
            <legend><h1>Recherche DÈtaillÈe</h1></legend>
          </div>
           </div>
            
    <fieldset>
      <div class="row">
    <div class="form-group">
      <label for="texte" class="col-xs-2">Nom</label>
      <div class="col-xs-4">
      <input type="text" name="NOM" id="texte" class="form-control" maxlength="30">
      </div>
      <label for="texte" class="col-xs-2">Prenom</label>
      <div class="col-xs-4">
      <input type="text" name="PRENOM" id="texte" class="form-control " maxlength="30">
      </div>
    </div>
    </div>
    <div class="row">
    <div class="form-group">

      <label for="texte" class="col-xs-2">Date de Naissance</label>
      <div class="col-xs-4">
      <input type="date" name="DATENAIS" id="texte" class="form-control " >
      </div>

      <label for="select" class="col-xs-2">Sexe</label>
      <div class="col-xs-4">
      <select id="select" name="SEXE" class="form-control ">
        <option value="F">Femme</option>
        <option value="M">Homme</option>
        
      </select>
    </div>
     </div>
    </div>
        <div class="row">
       <div class="form-group">
        <label for="textarea" class="col-xs-2">Adresse</label>
      <div class="col-xs-4">
      <textarea  id="textarea" name="ADRESSE" class="form-control" cols="50" rows="4" maxlength="100" ></textarea>
      </div>

      <label for="texte" class="col-xs-2">Tel</label>
      <div class="col-xs-4">
      <input type="tel" name="TEL1" id="texte" class="form-control " maxlength="10">
      </div>
    </div>
    </div>



    <div class="row">
       <div class="form-group">
          <label for="select" class="col-xs-2">Cat√©gorie</label>
          <div class="col-xs-4">
          <select id="select" name="SERVICE" class="form-control ">
          <option value="ADMINISTRATION">Administration</option>
          <option value="EMPLOYE">Employ√©</option>
        
      </select>
      </div>
      <label for="texte" class="col-xs-2">Login</label>
      <div class="col-xs-4">
      <input type="text" name="LOGIN" id="texte" class="form-control" maxlength="30">
      </div>
     
       </div>
    </div>
   
    <div class="form-group">
     
      <input type="submit" name="Submit" value="Rechercher" class=" pull-right btn btn-primary">
      <input type="hidden" name="PAGE" value="3">
    </div>
    </fieldset>
        
        </p>
      </form>
  </div>
</div>
 
     </div>
      
     </div>

 
<?php 
include('../modeles/pied.php'); ?>