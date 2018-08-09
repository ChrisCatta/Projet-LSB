<!DOCTYPE html>
<html lang="fr">
      <head>
	       <meta charset="utf-8" />
           <title>Stock LSB</title>
           <link rel="stylesheet" type="text/css" href="../bootstrap/dist/css/bootstrap.min.css">
           <!--
           <link rel="stylesheet" type="text/css" href="../cefis.css">
           <link rel="stylesheet" type="text/css" href="../jquery/development-bundle/themes/base/jquery.ui.all.css">
           <link rel="stylesheet" type="text/css" href="../jquery/css/dark-hive/jquery-ui-1.10.4.custom.min.css">-->
           <link rel="stylesheet" type="text/css" href="../jquery/css/jquery-ui.css">
           <link rel="stylesheet" type="text/css" href="../DataTables/jquery.dataTables.min.css">
           <link rel="stylesheet" type="text/css" href="../bootstrap/dist/css/bootstrap-select.min.css">
           <link rel="stylesheet" type="text/css" href="../LSB.css">
           <!--////////////////////-->
 
           <script type="text/javascript" src="../jquery/js/jquery-3.2.1.min.js"></script>
           <script type="text/javascript" src="../jquery/js/jquery-ui.js"></script>
           <script type="text/javascript" src="../jquery/development-bundle/ui/jquery.ui.core.js"></script>
           <script type="text/javascript" src="../jquery/development-bundle/ui/jquery.ui.widget.js"></script>
           <script type="text/javascript" src="../jquery/development-bundle/ui/jquery.ui.accordion.js"></script>
           <script type="text/javascript" src="../jquery/development-bundle/ui/jquery.ui.datepicker.js"></script>
           <script type="text/javascript" src="../jquery/development-bundle/ui/jquery.ui.mouse.js"></script>
           <script type="text/javascript" src="../jquery/development-bundle/ui/jquery.ui.sortable.js"></script>
           <script type="text/javascript" src="../jquery/development-bundle/ui/jquery.ui.tabs.js"></script>
           <script type="text/javascript" src="../bootstrap/dist/js/bootstrap.min.js"></script>
           <script type="text/javascript" src="../bootstrap/dist/js/bootstrap-select.js"></script>
           <script type="text/javascript" src="../DataTables/jquery.dataTables.min.js"></script>
           <script type="text/javascript" src="test-ajax.js"></script>
            <script type="text/javascript" >
             $(function() {

   $( "#accordion" ).accordion({
      heightStyle: "content"
      
    });
   $( "#accordion1" ).accordion({
      heightStyle: "content"
    });
   $( "#accordion2" ).accordion({
      heightStyle: "content"
    });
   $( "#accordion3" ).accordion({
      heightStyle: "content"
    });
   $( "#accordion4" ).accordion({
      heightStyle: "content"
    });
   $( "#accordion5" ).accordion({
      heightStyle: "content"
    });
   $( "#accordion6" ).accordion({
      heightStyle: "content"
    });
     $( "#datepicker" ).datepicker();
    var tabs = $( "#tabs" ).tabs();
    tabs.find( ".ui-tabs-nav" ).sortable({
      axis: "x",
      stop: function() {
        tabs.tabs( "refresh" );
      }
    });
  });
</script>
   <script>
  $( function() {
    var spinner = $( ".spinner" ).spinner();
 
    $( "#disable" ).on( "click", function() {
      if ( spinner.spinner( "option", "disabled" ) ) {
        spinner.spinner( "enable" );
      } else {
        spinner.spinner( "disable" );
      }
    });
    $( "#destroy" ).on( "click", function() {
      if ( spinner.spinner( "instance" ) ) {
        spinner.spinner( "destroy" );
      } else {
        spinner.spinner();
      }
    });
    $( "#getvalue" ).on( "click", function() {
      alert( spinner.spinner( "value" ) );
    });
    $( "#setvalue" ).on( "click", function() {
      spinner.spinner( "value", 5 );
    });
    });
  $( function() {
    $( ".selectmenu" ).selectmenu();
  } );
  $(document).ready(function() {
  $('.selectpicker').selectpicker();
});
  </script>
  
	  </head>

	  <body >
	  	
	       <div class="container">
	       	<div class="row">
	       			<img src="../images/logo-lsb.png" width="400" heigth="150" >
	       		</div>
	       		<div class="row">
	       		
                     <nav class="navbar navbar-inverse">
                     	
                        <ul class="nav navbar-nav" id="logo">
                        <li > <a href="menu.php">ACCEUIL</a> </li>

                        <li> <a href="administrer.php">ADMINISTRER</a></li>
                        <li> <a href="listefournisseur.php">FOURNISSEUR</a></li>
                        <li><a href="listeclient.php">CLIENT</a></li>
                        <li><a href="listearticle.php">STOCK</a></li>
                        <li><a href="livraison_entree1.php">ENTREE</a><li>
                          <li><a href="commande_sortie.php">SORTIE</a><li>
                          <li><a href="listetarifs.php">TARIFS</a><li>

                        </ul>
<form class="navbar-form pull-right" action="login.php">
<!--input type="text" style="width:150px" class="input-small"
placeholder="Recherche"-->
<button type="submit" class="btn btn-primary"><em class="glyphicon glyphicon-off">&nbsp;Se deconnecter</button></em>
</form>
</nav>
      </div>
                                
			
			