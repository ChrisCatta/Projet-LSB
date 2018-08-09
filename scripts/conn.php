  <?php
    session_start();
    
   function connexion()
   {
   // recuperation de la session
    $c=$_SESSION['categorie'];
    // prendre le login 
    $login=$_SESSION['LOGIN'];
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
    /* requete sql
    $sqlquery="select NOM, PRENOM, LOGIN, PW from UTILISATEUR where LOGIN='$login' and SERVICE='$t'";
    //resultat de la requette sql
    $result=mysqli_query($link,$sqlquery);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);*/
    return array($link);
}
?>