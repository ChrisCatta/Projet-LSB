<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>

<div class="row">
    <div class="col-xs-2">
       <?php
             include('../scripts/connexionDB.php');
              $retour=connexion();
              //$c=$retour[0];
              $link=$retour[0];
             include('../modeles/bar_menu.php'); 
              bar_stock(7);
              ?> 
              </div> 
              <div class="col-xs-9 well3 ">
            <div id="tabs">
            <ul>
              <li><a href="#tabs-1">Désignation et Famille</a></li>
              <li><a href="#tabs-2">Dimension carre</a></li>
              <li><a href="#tabs-3">Dimension rond</a></li>
            </ul>
            
             <div id="tabs-1">
             <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
              <form name="form1" method="post" action="RechercheArticleResultat.php" >
                  
                  <p>
                     <div class="row">
                          <div class="col-xs-2">
                            <img src="../images/RechercheArticle.PNG" class="img-circle" width="100" heigth="100">
                          </div>
                          <div class="col-xs-10">
                                <legend><h3 >Recherche Par Désignation et Famille</h3></legend>
                          </div>
                     </div>
                      
              <fieldset>
                <div class="row">
                     <div class="form-group">
                             <label for="select" class="col-xs-5">Désignation (% comme joker)</label>
                          <div class="col-xs-7">
                             <input  type="text" class="spinner" name="DESIGNATION" maxlength="30">
                          </div>
                     </div>
                </div>
                <div class="row">
                  <div class="form-group">
                    <label for="select" class="col-xs-5">Choix de La Famille</label>
                  
                              <div class="col-xs-7">
                                  <select id="select" name="FAMILLE" class="form-control ">
                                          <option value=""></option>
                                         <?php
                                          $sql = "SELECT * FROM FAMILLE";
                                          $res = mysqli_query($link,$sql) or exit(mysql_error());
                                          while($data=mysqli_fetch_array($res,MYSQLI_ASSOC)) {
                                             echo '<option>'.$data['FAMILLE'].'</option><br/>'; //Attention à ne pas oublier le . qui sert à concaténer ton expression
                                          }
                                           
                                          ?> 
                                          
                                  </select> 
                              </div>
                  </div>
              </div>
                <div class="row">
                    <div class="form-group">
                      <div class="col-xs-offset-10 col-xs-2">
                          <input type="submit" name="Submit" value="Rechercher" class="btn btn-primary">
                          <input type="hidden" name="PAGE" value="1">
                      </div>
                  </div>
                </div>
              </fieldset>
                  
                  </p>
                </form>
              <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
            </div>
            <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
            <div id="tabs-2">
              <form name="form1" method="post" action="RechercheArticleResultat.php" class="well3">
                  
                  <p>
                     <div class="row">
                      <div class="col-xs-2">
                        <img src="../images/RechercheArticle.PNG" class="img-circle" width="100" heigth="100">
                      </div>
                      <div class="col-xs-10">
                      <legend><h1>Recherche Par Dimension<h1></legend>
                    </div>
                     </div>
                      
              <fieldset>
                <div class="row">
              <div class="form-group">
                <label for="texte" class="col-xs-5">Longueur</label>
                <div class="col-xs-7">
                <input type="number" name="LONGUEUR" id="longueur"  step="0.1" class="spinner" >
                </div>
                
              </div>
              </div>
             <div class="row">
              <div class="form-group">
                <label  class="col-xs-5">Largeur</label>
                <div class="col-xs-7">
                <input type="number" name="LARGEUR" id="largeur"    class="spinner"  >
                </div>
              </div>
            </div>
             <div class="row">
              <div class="form-group">
                <label for="texte" class="col-xs-3">Epaisseur</label>
                <div class="col-xs-7">
                <input type="number" name="EPAISSEUR" id="epaisseur"   class="spinner" >
                </div>
              </div>
            </div>
           <div class="row">
                    <div class="form-group">
                      <div class="col-xs-offset-10 col-xs-2">
                          <input type="submit" name="Submit" value="Rechercher" class="btn btn-primary">
                          <input type="hidden" name="PAGE" value="2">
                      </div>
                  </div>
                </div>
              </fieldset>
                  
                  </p>
                </form>
            </div>
   <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
            <div id="tabs-3">
              <form name="form1" method="post" action="RechercheArticleResultat.php" class="well3">
                  
                  <p>
                     <div class="row">
                      <div class="col-xs-2">
                        <img src="../images/RechercheArticle.PNG" class="img-circle" width="100" heigth="100">
                      </div>
                      <div class="col-xs-10">
                      <legend><h1>Recherche Par Dimension<h1></legend>
                    </div>
                     </div>
                      
              <fieldset>
                <div class="row">
              <div class="form-group">
                <label for="texte" class="col-xs-3">Longueur</label>
                <div class="col-xs-7">
                <input  name="LONGUEUR" id="longueur"  step="0.1" class="spinner" >
                </div>
                
              </div>
              </div>
             <div class="row">
              <div class="form-group">
                <label for="texte" class="col-xs-3">Diametre</label>
                <div class="col-xs-7">
                <input  name="DIAMETRE" id="diametre"   class="spinner" >
                </div>
              </div>
            </div>
              <div class="row">
                    <div class="form-group">
                      <div class="col-xs-offset-10 col-xs-2">
                          <input type="submit" name="Submit" value="Rechercher" class="btn btn-primary">
                          <input type="hidden" name="PAGE" value="3">
                      </div>
                  </div>
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