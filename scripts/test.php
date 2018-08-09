<?php 
   $link=mysqli_connect('localhost','root','','projet');
    if(!$link) { die('<p>Connection Impossible : '.mysql_error().'</p>');}
    //connection a la base de données
    $db=mysqli_select_db($link,'projet');
    if(!$db) { die('<p>Impossible de se connecter à la base de données : '.mysql_error().'</p>');}
   
    $sqlquery="select * FROM ARTICLE  ORDER BY DESIGNATION";
    $result=mysqli_query($link,$sqlquery);
    
       
 ?>
<!DOCTYPE html>
<html lang="fr">
      <head>
	       <meta charset="utf-8" />
           <link rel="shortcut icon" href="../bootsrap/docs/assets/ico/repro.PNG">
		   <title>Stock LSB </title>
           <link rel="stylesheet" type="text/css" href="../DataTables/jQueryUI-1.11.4/jquery-ui.min.css"/>
           <link rel="stylesheet" type="text/css" href="../DataTables/DataTables-1.10.15/css/dataTables.jqueryui.min.css"/>

           <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
           <script type="text/javascript" src="../tablesorter/jquery.tablesorter.js"></script>
           <script type="text/javascript" src="../DataTables/jQueryUI-1.11.4/jquery-ui.min.js"></script>
           <script type="text/javascript" src="../DataTables/jquery.dataTables.min.js"></script>
           <script type="text/javascript" src="../DataTables/DataTables-1.10.15/js/dataTables.jqueryui.min.js"></script>
    <!-- <script type="text/javascript" charset="UTF_8">

	    $(document).ready(function() {
    $('#test').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "post.php",
            "type": "POST"
        },
        "columns": [
            { "data": "ID_A" },
            { "data": "DESIGNATION" },
            { "data": "TYPE" },
            { "data": "FAMILLE" },
            { "data": "LONGUEUR" },
            { "data": "LARGEUR" },
            { "data": "LONGUEUR"*"LARGEUR" },
            { "data": "EPAISSEUR" },
            { "data": "PRIX_U" },
        ]
    } );
} );
     </script>-->
    <script type="text/javascript" charset="UTF_8">
     $(document).ready(function() 
    { 
        $("#test").tablesorter(); 
    } 
); 
</script>
  

    </head>
    <body>  
  
      <div class="col-xs-8 ">
        <table id="test" class="display"> 
          <thead>
           <tr>
              <th><strong>Id</strong></th>
              <th><strong>Désignation</strong></th>
              <th><strong>Type</strong></th>
              <th><strong>Famille</strong></th>
              <th><strong>Long</strong></th>
              <th><strong>Lar</strong></th>
              <th><strong>Epais</strong></th>
              <th><strong>Surface</strong></th>
              <th><strong>Volume</strong></th>
              <th><strong>Prix_Uni</strong></th>
              <th><strong>Qte_Stock</strong></th>
              <th><strong>Qte_Seuil</strong></th>
              <th><strong>Image</strong></th>
           </tr>
          </thead>
      <?php
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
   {
    if($row['CHEMIN_IMG']== NULL)
    {
      $row['CHEMIN_IMG']='../images/pasimage.PNG';
    }
    echo '
    <tbody>
       <tr>
           <td>'.$row['ID_A'].'</td>
           <td>'.$row['DESIGNATION'].'</td>
           <td>'.$row['TYPE'].'</td>
           <td>'.$row['FAMILLE'].'</td>
           <td>'.$row['LONGUEUR'].'</td>
           <td>'.$row['LARGEUR'].'</td>
           <td>'.$row['EPAISSEUR'].'</td>
           <td>'.$row['LONGUEUR']*($row['LARGEUR']/1000)*$row['QTE_STO'].'</td>
           <td>'.$row['LONGUEUR']*($row['LARGEUR']/1000)*($row['EPAISSEUR']/1000)*$row['QTE_STO'].'</td>
           <td>'.$row['PRIX_U'].'</td>
           <td>'.$row['QTE_STO'].'</td>
           <td>'.$row['QTE_MIN'].'</td>
           <td><img src="'.$row['CHEMIN_IMG'].' " width="50" height="50" align="center"></td>
       </tr>
      </tbody>
    ';
   }
   ?>
   </table>
   </div>
 </body>
</html>