<script type="text/javascript">
setInterval(function(){
    document.getElementById('afficherheure').innerHTML = new Date().toLocaleTimeString();
}, 1000);
</script>
<?php
include('../modeles/panels.php');
   function connexion()
   {
if(time()>($_SESSION['tps']+ $_SESSION['time'])){
    die('<META HTTP-equiv="refresh" content=0;URL=login.php>'); 
	/*session_destroy();
	header('Location:login.php');*/
}else{
$_SESSION['time']=time();
}
    
    //var_dump ($time,$tps);
    $host="localhost";
    $dbname="projet";
    $user="Madachri";
    $pass="madachri2017";
    /*if($c==1) { $t='ADMINISTRATION';}
    else { $t='EMPLOYE';}
    try {
    $link = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}*/
    // connection a phpmyadmin
    $link=mysqli_connect($host,$user,$pass,$dbname);
    mysqli_set_charset($link, "utf8");
    if(!$link) 
    { 
      die('<p>Connection Impossible : '.mysql_error().'</p>');
     }
    /* requete sql
  $sqlquery="select NOM, PRENOM, LOGIN, PW from UTILISATEUR where LOGIN='$login' and SERVICE='$t'";
   /* $sqlquery=$link ->query("select NOM, PRENOM, LOGIN, PW from UTILISATEUR where LOGIN='$login' and SERVICE='$t'");
   // $sqlquery -> execute();
    $row=$sqlquery->fetch();
    /*echo '<pre>';
    print_r($result);
    echo '</pre>';
    //resultat de la requette sql
   $result=mysqli_query($link,$sqlquery);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);*/
    ?>
   <div class="well3 logo">
     <!-- Default panel contents -->
    <div class="panel-heading">
      <h5 class="text-center"><strong>

     <div class="row">
       <div class="col-xs-4">
          <img src="../images/hor.PNG" width="40" heigth="40"> 
       </div>
       <div class="col-xs-8">
            <div id="afficherheure" style="line-height: 3em"></div>

         </div>
       </div>
       <p>Session de<br/>  <?php echo'<strong>' .$_SESSION['LOGIN'].'<span color="green"> <br> ( Connecté ) </span></strong>';?></p>
    </strong></h5>
    </div>
  </div>
   <?php
       return array($link);
    }
   ?>