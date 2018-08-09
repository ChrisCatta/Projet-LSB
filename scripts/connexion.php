
<?php
session_start();
 include('../modeles/entete.php');
 include('../modeles/panels.php');
    $c=$_POST['categorie'];
    $host="localhost";
    $dbname="projet";
    $user="Madachri";
    $pass="madachri2017";
    if($c==1) { $t='ADMINISTRATION';}
   
    else { $t='EMPLOYE';}
    // connection a phpmyadmin
    $link=mysqli_connect($host,$user,$pass,$dbname);
    mysqli_set_charset($link, "utf8");
    if(!$link) { die('<p>Connection Impossible : '.mysql_error().'</p>');}
    // requete sql
    $sqlquery="select NOM, PRENOM, LOGIN, PW from UTILISATEUR where LOGIN='".$_POST['LOGIN']."' and SERVICE='$t' ";
    //resultat de la requette sql
    $result=mysqli_query($link,$sqlquery);
    $row=mysqli_fetch_array($result,MYSQL_ASSOC);
    $_SESSION['categorie']=$_POST['categorie'];
    $_SESSION['LOGIN']=mysqli_real_escape_string($link, $_POST['LOGIN']);
    $_SESSION['PW']=$_POST['PW'];
    $_SESSION['tps']=$_POST['tps'];
    $_SESSION['time']=$_POST['time'];
    $_SESSION['c']=$c;
    
       header("Location:menu.php");
    ?>
   
<div class="row">
    <div class="col-xs-2">
          <div class="panel panel-default logo">
               <!-- Default panel contents -->
              <div class="panel-heading">
                    <div class="row">
                         <div class="col-xs-4">
                            <img src="../images/hor.PNG" width="40" heigth="40"> 
                         </div>
                         <div class="col-xs-8">
                              <div id="afficherheure" style="line-height: 3em"></div>
                         </div>
                 </div>
                          <p>
                             Session de<br/>  <strong><?=$row['NOM'].' '.$row['PRENOM']?><br><span color="green">  ( Connecter ) </span></strong></p>
                </div>
            </div>
        </div>
        <div class="col-xs-7">
            <?php
                if(mysqli_num_rows($result)==0)
              {
                panel('panel-danger','Erreur d\'Authentification','<p> <img src="../images/ERREUR.gif"><strong>Identifiant Inconnu !</strong></p><br/><a href="login.php"><input type="submit" value="Retour"></a>');
                      }
              elseif($row['PW']!=$_POST['PW'])
                   {
                    panel('panel-danger','Erreur d\'Authentification','<p> <img src="../images/ERREUR.gif"><strong>Mot de Passe Incorrect !</strong></p><br/><a href="login.php"><input type="submit" value="Retour"></a>');
                   }
                   else
                   {
               ?>

                    
        </div>
             <div class="col-xs-3">
                 <div id="datepicker"></div>
              </div>
                 
  </div>
  <div class="row">
               <div class="col-xs-2">
                    <?php    include('../modeles/deconnexion.php'); ?>
                 </div>
                  <div class="col-xs-offset-7 col-xs-2">
                    
                  <p><a href=menu.php?SID> <button type="button" class="btn btn-primary" value="Continuer">Continuer</button></a></p>   
                  </div>
    </div>
          <?php
                   }
              
               ?>
  <script type="text/javascript">
setInterval(function(){
    document.getElementById('afficherheure').innerHTML = new Date().toLocaleTimeString();
}, 1000);
</script>           
          <?php 
          include('../modeles/pied.php'); 
          ?>