        <!DOCTYPE html>
        <html>
              <head>
              <meta charset="utf-8">
                <title>test ajax</title>
                 <link rel="stylesheet" type="text/css" href="../jquery/css/jquery-ui.css">
                 <link rel="stylesheet" type="text/css" href="../bootstrap/dist/css/bootstrap.min.css">
                 <link rel="stylesheet" type="text/css" href="../DataTables/jquery.dataTables.min.css">
           <link rel="stylesheet" type="text/css" href="../bootstrap/dist/css/bootstrap-select.min.css">
                 <link rel="stylesheet" type="text/css" href="../LSB.css">
              </head>
        <body>
         <div class="row">
              <div class="col-xs-2">
                <img src="../images/modifarticle.PNG" class="img-circle" width="100" height="100">
              </div>
              <div class="col-xs-10 well3">
                  <legend><h1>Modification d'un Article</h1></legend>
              </div>
          </div>
            
    <fieldset>
      <div class="row">
              <div class="col-xs-2">
                      Select Type :
              </div>
              <div class="col-xs-3">
                        <div id="div-type">
                        </div>
              </div>    
              <div class="col-xs-2">
                    Select Famille :
              </div>    
              <div class="col-xs-3">
                        <div id="div-famille">
                        </div>
                </div>
         </div>
    </fieldset>
      <div class="row">
          <div class="col-xs-10">
              List articles :
                <div  id="div-list-art">
                 </div>
          </div>
      </div>     
      
    <form name="listArt" method="POST" action="update-liv.php">
      <div class="row">
          <div class="col-xs-10">
              List livraison articles :
                <div  id="div-liv-art">
                 </div>
          </div>
      </div>
      <div>
        <button id="ajouter" type="button" name="Ajouter" value="Ajouter" onclick="afficheLivraison(1)" class=" pull-left btn btn-primary">Ajouter</button>
        <button type="submit" name="Submit" value="Valider" class=" pull-right btn btn-primary">Valider</button> 
        </div>
      </form>

                 <script src="../jquery/js/jquery-3.2.1.min.js"></script>
                 <script src="../jquery/js/jquery-ui.js"></script>
                 <script src="../DataTables/jquery.dataTables.min.js"></script>
           <script type="text/javascript" src="../bootstrap/dist/js/bootstrap.min.js"></script>
           <script type="text/javascript" src="../bootstrap/dist/js/bootstrap-select.js"></script>
                 <script type="text/javascript" src="test-ajax.js"></script>
                <script> $(document).ready(function() {
  $('.selectpicker').selectpicker();
});
</script>
                 <!--<script src="../DataTables/jquery.dataTables.min.js"></script>
                 <script type="text/javascript">
                   $(document).ready(function(){
                  $('#Article').DataTable();
                  });
                 </script>-->
    </body>
</html>