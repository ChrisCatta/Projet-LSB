<?php
session_start();
 include('../modeles/enteteAdmin.php'); ?>

<!--div class="row">
  <div class="col-xs-offset-2 col-xs-8">
      <h3>Ajout Article</h3>
      </div>
    </div-->
    <div class="row">
      <div class="col-xs-2">
      

    <?php
    include('../scripts/connexionDB.php');
    $retour=connexion();
    //$c=$retour[0];
    $link=$retour[0];
   include('../modeles/bar_menu.php'); 
    bar_entree(2);
    echo ' </div> 

    <div class="col-xs-8 ">';   ?> 
  
  
 
      <form name="form1" method="post" action="ajoutLigneCommande2.php" class="well3" onSubmit="return verification()">
        
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
        $id_bonc=$_POST['ID_BONC']; 
        $ligne= $_POST['ligne'];
        $sqlquery1="select REFERENCE from BON_COM where ID_BONC=$id_bonc";
           $result1=mysqli_query($link,$sqlquery1);
           $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
       if($ligne==1)
       {
             
             $sqlquery="select ID_A,DESIGNATION,TYPE
                        FROM BON_COM B, ARTICLE A 
                        WHERE TYPE=$_TYPE AND B.ID_BONC=$id_bonc and  ID_A NOT IN (
                              SELECT C.ID_A
                              FROM CONTENIR_BON C
                              WHERE ID_BONC=$id_bonc)";
             $result=mysqli_query($link,$sqlquery);
              echo '
              <div class="row">
             <div class="form-group">
                 <label for="select" class="col-xs-3">Identifiant Commande</label>
                  <div class="col-xs-3">
                     <input type="text"  class="form-control" name="ID_BON"  value="'.$id_bonc.'" disabled>
                  </div>
                  <label for="select" class="col-xs-3">Réference Commande</label>
                  <div class="col-xs-3">
                     <input type="text"  class="form-control" name="REFERENCE"  value="'.$row1['REFERENCE'].'" disabled>
                  </div>
             </div>
             </div>
           <div class="row">
             <div class="form-group">
          <label for="select" class="col-xs-3">Article du Fournisseur </label>
          <div class="col-xs-3">
          <select id="select" name="ID_A" class="form-control ">';
          while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
          {
            echo '<option value="'.$row['ID_A'].'"> '.$row['ID_A'].'  - '.$row['DESIGNATION'].'</option>';
          }
          echo '</select> </div> 



          <label  class="col-xs-3">Quantité</label>
             <div class=" col-xs-3">
             
             <input type="number" min="0" max= "2000000000" class="form-control" name="QTE_BON"  >
             </div>

          </div> </div>';
       }
       else
       {
         $sqlquery="select A.ID_A, A.DESIGNATION 
                    FROM ARTICLE A, CONTENIR_BON C
                    WHERE C.ID_BONC=$id_bonc and C.ID_A=A.ID_A";
          $result=mysqli_query($link,$sqlquery);
          echo '
               

          <div class="row">
             <div class="form-group">
                 <label for="select" class="col-xs-3">Identifiant Commande</label>
                  <div class="col-xs-3">
                     <input type="text"  class="form-control" name="ID_BON"  value="'.$id_bonc.'" disabled>
                  </div>
                  <label for="select" class="col-xs-3">Réference Commande</label>
                  <div class="col-xs-3">
                     <input type="text"  class="form-control" name="reference"  value="'.$row1['REFERENCE'].'" disabled>
                  </div>
             </div>
             </div>

           <div class="row">
             <div class="form-group">
          <label for="select" class="col-xs-3">Choix de l\'article</label>
          <div class="col-xs-3">
          <select id="select" name="ID_A" class="form-control ">';
          while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
          {
            echo '<option value="'.$row['ID_A'].'"> '.$row['ID_A'].'  - '.$row['DESIGNATION'].'</option>';
          }
          echo '</select> </div>
          <label for="select" class="col-xs-3">Quantité à Ajouter</label>
          <div class=" input-group col-xs-3">
             
               <input id="input" type="number" min="0" max="2000000000" class="form-control" name="QTE_BON" style="text-align:right" maxlength="8">
             <span class="input-group-addon" ><label for="input">Unités</label></span>
            
          </div>
          </div></div>';

          
       } 
       ?>
          
        

<div class="row">
           
            <div class="col-xs-12">
            <legend></legend>
          </div>
           </div>

         <div class="row">
       <div class="form-group">
          
     
      <div class="col-xs-1">
      
      <?php echo '<input type="hidden" name="NEW_OLD" id="texte" class="form-control"  value="'.$ligne.'">';
            echo '<input type="hidden" name="ID_BONC" id="texte" class="form-control"  value="'.$id_bonc.'">';
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
        <script language="javascript" type="text/javascript">
                            function verification()
                            {
                             
                                if(document.forms["form1"].elements["ID_A"].value=="")
                                {
                                  alert("Le fournisseur ne dispose plus d'articles. Pour valider il faut affecter au fournisseur des Articles.");
                                  return false;

                                }
                                if(document.forms["form1"].elements["QTE_BON"].value=="")
                                {
                                  alert("Vous avez laissez le champs de la quantité du stock vide");
                                  return false;

                                }
                                else 
                                {
                                  return true;
                                }
                            }
                          </script>
      </form>
       </div>
     </div>

    

 </td>

  </tr>

  

</table>
<?php 
include('../modeles/deconnexion.php');
include('../modeles/pied.php'); ?>