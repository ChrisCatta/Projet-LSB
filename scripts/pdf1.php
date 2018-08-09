   <!DOCTYPE html>
        <html>
              <head>
              <meta charset="utf-8">
                <title>test Pdf</title>
                 <link rel="stylesheet" type="text/css" href="../jquery/css/jquery-ui.css">
                 <link rel="stylesheet" type="text/css" href="../bootstrap/dist/css/bootstrap.min.css">
                 <link rel="stylesheet" type="text/css" href="../DataTables/jquery.dataTables.min.css">
           <link rel="stylesheet" type="text/css" href="../bootstrap/dist/css/bootstrap-select.min.css">
           <style>
     td ,th{
        border:1px dotted grey;
     }          
   .facture{
    border: 1px solid #3a3a3a;
    border-radius: 3px;
    margin-bottom: 20px;
    margin-top: 20px;
   }
           </style>
              </head>
        <body>
<?php
$link=mysqli_connect('localhost','root','','projet');
session_start();
?>
    <div id="#pdf2htmldiv">
   <div class="col-xs-10 well3 ">
    <?php
   $ID_FA=9;
   $sqlquery="SELECT A.ID_A, A.DESIGNATION, A.FAMILLE, C.QTE_CO, A.PRIX_U, C.QTE_CO * A.PRIX_U as 'MONTANT'
              FROM COMMANDE CO, ARTICLE A, CONTENIR_CO C, FACTURE F
              WHERE F.ID_FA='$ID_FA' AND CO.ID_CO=F.ID_CO AND C.ID_CO=CO.ID_CO AND A.ID_A=C.ID_A ";
     $result=mysqli_query($link,$sqlquery);
   $sqlquery2="SELECT  F.ID_FA,  sum(C.QTE_CO*A.PRIX_U) as 'THT', sum(C.QTE_CO*A.PRIX_U)*(1+0.20) as 'TTC'
               from CONTENIR_CO C, ARTICLE A, FACTURE F
               where F.ID_FA='$ID_FA' AND A.ID_A=C.ID_A";
               $result2=mysqli_query($link,$sqlquery2);
               $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
   $sqlquery1="SELECT F.ID_FA, F.REF_FACT,  CL.ID_C, CL.RAISSO_C, CO.ID_C, CO.ID_CO
              FROM FACTURE F, COMMANDE CO, CLIENT CL
              WHERE F.ID_FA='$ID_FA' AND CO.ID_CO=F.ID_CO AND  CL.ID_C=CO.ID_C";
   $result1=mysqli_query($link,$sqlquery1);
   $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
   ?>
                    <div class="row">
                                <div class="col-xs-4"> <img src="../images/logo-lsb.png" width="150px" ><br><h3>Les Sieries du Betsileo</h3>Zorozorona<br>FIANARANTSOA</div><div class="col-xs-8"><h2 class="text-center"><strong>Facture</strong></h2> </div>
                    </div>
                     <div class="row">
                                <div class="facture col-xs-4">Facture N°:  <em class="ligneCommande"><?=$row1['ID_FA']?><br>Intitulé :<?=$row1['REF_FACT']?> </em> </div>
                                <div class="facture col-xs-offset-2 col-xs-4">ID Client :  <em class="ligneCommande"><?=$row1['ID_C']?><br>Nom client  :<?=$row1['RAISSO_C']?></em> </div>
                    </div>
                     <div class="row">
                        <div class=" col-xs-10 ">
                         <table class="display" width="100%">
                            <thead>
                               <tr class="info">
                                  <th><strong>ID_Article</strong></th>
                                  <th><strong>Désignation</strong></th>
                                  <th><strong>Famille</strong></th>
                                  <th><strong>Quantité</strong></th>
                                  <th><strong>Prix Vente</strong></th>
                                  <th><strong>Montant</strong></th>
                                </tr>
                         </thead>
                               <?php
                               while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                               {
                                 ?>
                                 <tbody>
                                   <tr>
                                       <td><?=$row['ID_A']?></td>
                                       <td><?=$row['DESIGNATION']?></td>
                                       <td><?=$row['FAMILLE']?></td>
                                       <td><?=$row['QTE_CO']?></td>
                                       <td><?php echo number_format($row['PRIX_U'],0,',',' ')?></td>
                                       <td><?php echo number_format($row['MONTANT'],0,',',' ')?></td>
                                   </tr>
                              <?php
                               }
                            ?>
                             <tr>
                                          <td colspan="5" class="success"><strong>Montant hors Taxe</strong></td>
                                          <td class=""><strong><?php echo number_format($row2['THT'],0,',',' ')?></strong></td>
                                      </tr>
                                      <tr>
                                          <td colspan="5" class="success"><strong>Montant tous taxes comprises</strong></td>
                                          <td class=""><strong><?php echo number_format($row2['TTC'],0,',',' ')?></strong></td>
                                      </tr>
                                 </tbody>
                            </table>
                    </div>
        </div>
    </div>
    <!--Div de la fonction panel_tab-->
    <a href="" onclick="pdfToHTML();">save doc</a>



 
   <script type="text/javascript" src="../jquery/js/jquery-3.2.1.min.js"></script>
                 <script type="text/javascript"  src="../jquery/js/jquery-ui.js"></script>
                 <script type="text/javascript"  src="../jquery/js/jspdf.js"></script>
                 <script  type="text/javascript" src="../jquery/js/pdfFromHTML.js"></script>
                 <script type="text/javascript"  src="../DataTables/jquery.dataTables.min.js"></script>
           <script type="text/javascript" src="../bootstrap/dist/js/bootstrap.min.js"></script>
           <script type="text/javascript" src="../bootstrap/dist/js/bootstrap-select.js"></script>
                 <script type="text/javascript" src="test-ajax.js"></script>
                <script> $(document).ready(function() {
  $('.selectpicker').selectpicker();
});

</script>
</body>
</html>