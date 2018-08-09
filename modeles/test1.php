
<!doctype html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../jquery/development-bundle/themes/base/jquery.ui.all.css">
	<script src="../jquery/development-bundle/jquery-1.10.2.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.ui.tabs.js"></script>
	<script src="../jquery/development-bundle/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../jquery/development-bundle/demos/demos.css">
	<script>
	$(function() {
		$( "#tabs" ).tabs({
			beforeLoad: function( event, ui ) {
				ui.jqXHR.error(function() {
					ui.panel.html(
						"Couldn't load this tab. We'll try to fix this as soon as possible. " +
						"If this wouldn't be a demo." );
				});
			}
		});
	});
	</script>
</head>
<body>

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Preloaded</a></li>
		<li><a href="#tabs-2">Idriss</a></li>
	</ul>
	<div id="tabs-1">
		

    <div class="col-xs-8 ">
  
  
 
      <form name="form1" method="post" action="SortieAjoutLigneCommande2.php" class="well5">
        
        <p>
           <div class="row">
            <div class="col-xs-1">
              <img src="../images/ajoutcommande.PNG" width="100" heigth="100" class="img-circle">
            </div>
            <div class="col-xs-offset-1 col-xs-10">
            <legend><h1>Ajout d'une Ligne de Commande <h1></legend>
          </div>
           </div>
            
    <fieldset>
     
       <?php
    
              echo '
              <div class="row">
             <div class="form-group">
                 <label for="select" class="col-xs-3">Identifiant Commande</label>
                  <div class="col-xs-3">
                     <input type="text"  class="form-control" name="ID_BON"  value="" disabled>
                  </div>
                  <label for="select" class="col-xs-3">Réference Commande</label>
                  <div class="col-xs-3">
                     <input type="text"  class="form-control" name="REFERENCE"  value="" disabled>
                  </div>
             </div>
             </div>
           <div class="row">
             <div class="form-group">
          <label for="select" class="col-xs-3">Article  </label>
          <div class="col-xs-3">
          <select id="select" name="ID_A" class="form-control ">';
         
            echo '<option value="">mphi</option>';
            echo '<option value="">mphi</option>';
            echo '<option value="">mphi</option>';
         
          echo '</select> </div> 



          <label  class="col-xs-3">Quantité</label>
             <div class=" col-xs-3">
             
             <input type="number" min="0" max= "2000000000" class="form-control" name="QTE_CO"  >
             </div>

          </div> </div>';
       
      
       ?>
          
        

<div class="row">
           
            <div class="col-xs-12">
            <legend></legend>
          </div>
           </div>

         <div class="row">
       <div class="form-group">
          
     
      <div class="col-xs-1">
      
      <?php echo '<input type="hidden" name="NEW_OLD" id="texte" class="form-control"  value="">';
            echo '<input type="hidden" name="ID_CO" id="texte" class="form-control"  value="">';
              ?>
      </div>
     
       </div>
    </div>
   
    <div class="form-group">
      <div class="col-xs-offset-10 col-xs-2">
       <input type="submit" name="Submit" value="Ajouter" class=" pull-right btn btn-primary">
    </div>
     
    </div>

      
    
    </fieldset>
        
        </p>
      </form>
       </div>
     </div>

	</div>
	<div id="tabs-2">
		<p>ùp^ks^dpk^sdpgk^pksdg^pksdg^pksg^p</p>
		</div>
</div>

<div class="demo-description">
<p>Fetch external content via Ajax for the tabs by setting an href value in the tab links.  While the Ajax request is waiting for a response, the tab label changes to say "Loading...", then returns to the normal label once loaded.</p>
<p>Tabs 3 and 4 demonstrate slow-loading and broken AJAX tabs, and how to handle serverside errors in those cases. Note: These two require a webserver to interpret PHP. They won't work from the filesystem.</p>
</div>
</body>
</html>
