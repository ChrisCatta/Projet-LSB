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
    bar_entree(3);
    echo ' </div> 

    <div class="col-xs-8 ">';   ?> 
  
  
 
      <form name="form1" method="post" action="ajoutLigneLivraison2.php" class="well3" onSubmit="return verification()">
        
        <p>
           <div class="row">
              <div class="col-xs-2">
                  <img src="../images/Livraison.JPG" width="100" heigth="100" class="img-circle">
                </div>
                <div class="col-xs-10">
                <legend><h1>Ajout d'une Ligne de Livraison <h1></legend>
              </div>
           </div>
            
    <fieldset>
     
       <?php
        $id_bonl=$_POST['ID_BONL']; 
        
        $sqlquery1="select * from LIV_BON where ID_BONL=$id_bonl";
           $result1=mysqli_query($link,$sqlquery1);
           $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
     
             
             $sqlquery="select A.ID_A,A.DESIGNATION,A.TYPE,L.TYPE_LIV,L.DATE_BONL,L.REF_LIV
                        FROM  ARTICLE A, LIV_BON L
                        WHERE  A.TYPE=L.TYPE_LIV AND A.ID_A NOT IN (
                              SELECT ID_A
                              FROM CONTENIR_BON_L 
                              WHERE ID_BONL=$id_bonl)";
             $result=mysqli_query($link,$sqlquery);
             
              ?>
      <div class="row">
        <div class="form-group">
            <label for="select" class="col-xs-3">Identifiant Livraison</label>
               <div class="col-xs-3">
                  <input type="text"  class="form-control" name="ID_BON"  value="<?=$id_bonl?>" disabled>
               </div>
            <label for="select" class="col-xs-3">Réference Livraison</label>
                <div class="col-xs-3">
                   <input type="text"  class="form-control" name="REF_LIV"  value="<?=$row1['REF_LIV']?>" disabled>
                </div>
        </div>
        <div class="form-group">
            <label for="select" class="col-xs-3">Type Livraison</label>
               <div class="col-xs-3">
                  <input type="text"  class="form-control" name="TYPE_LIV"  value="<?=$row1['TYPE_LIV']?>" disabled>
               </div>
            <label for="select" class="col-xs-3">Date Livraison</label>
                <div class="col-xs-3">
                   <input type="text"  class="form-control" name="DATE_BONL"  value="<?=$row1['DATE_BONL']?>" disabled>
                </div>
        </div>
      </div>
      <div class="row">
             <div class="form-group">
                <label for="select" class="col-xs-3">Article Livré </label>
                  <div class="col-xs-3">
                      <select id="select" name="ID_A" class="form-control ">
                        <?php
                          while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
                          {
                            echo '<option value="'.$row['ID_A'].'"> '.$row['ID_A'].'  - '.$row['DESIGNATION'].'</option>';
                          }
                          ?>
                        </select> 
                    </div> 
                <label for="spinner" class="col-xs-3">Qte Livré </label>
              <div class="col-xs-3">
                <input name="QTE_BON_L" class="spinner" value="">
              </div>
            </div>
       </div>

         <div class="row">
       <div class="form-group">
          
     
          <div class="col-xs-2">
          
          <?php 
                echo '<input type="hidden" name="ID_BONL" id="texte" class="form-control"  value="'.$id_bonl.'">';
                  ?>
          </div>
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
                                  alert("Il ne reste plus d'Article livré.");
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