
    <?php
    function bar_menu()
    {
      ?>
 <nav class="well3 navbar navbar-default"><ul class="nav nav-pills nav-stacked span2">
    <h4 align="center" ><strong>Menu</strong></h4>
           <li ><a href="menu.php?SID"><p class="glyphicon glyphicon-home"></p>&nbsp;&nbsp;&nbsp;&nbsp;Acceuil</a></li>
            <li class="active"><a href="administrer.php?SID"><p class="glyphicon glyphicon-cog"></p>&nbsp;&nbsp;&nbsp;&nbsp;Administrer</a></li>
             <li><a href="listefournisseur.php?SID"><p class="glyphicon glyphicon-user"></p>&nbsp;&nbsp;&nbsp;&nbsp;Fournisseur</a></li>
             <li><a href="listeclient.php?SID"><p class="glyphicon glyphicon-user"></p>&nbsp;&nbsp;&nbsp;&nbsp;Client</a></li>
             <li><a href="listearticle.php?SID"><p class="glyphicon glyphicon-shopping-cart"></p>&nbsp;&nbsp;&nbsp;&nbsp;Stock</a></li>
             <li><a href="livraison_entree1.php?SID"><p class="glyphicon glyphicon-log-in"></p>&nbsp;&nbsp;&nbsp;&nbsp;Entrée </a></li>
             <li><a href="commande_sortie.php?SID"><p class="glyphicon glyphicon-log-out"></p>&nbsp;&nbsp;&nbsp;&nbsp;Sortie</a></li>
    </ul> </nav>
    <?php
    }

///////////////////////////: BAR ADMINISTRATION /////////////////////////////////////////////////////////////////
     function bar_administration()
     {
     	?>
      <nav class="well3 navbar navbar-default"><ul class="nav nav-pills nav-stacked span2">
      <h4 align="center" ><strong>Administration</strong></h4>
           <li ><a href="listeutilisateur.php?SID"><p class="glyphicon glyphicon-list-alt"></p>&nbsp;&nbsp;Liste utilisateur</a></li>
            <li><a href="ajoututilisateur.php?SID"><p class="glyphicon glyphicon-plus"></p>&nbsp;&nbsp;Ajouter utilisateur</a></li>
             <li><a href="supprimer_utilisateur.php?SID"><p class="glyphicon glyphicon-trash"></p>&nbsp;&nbsp;Supprimer utilisateur</a></li>
              <li><a href="modificationUti1.php?SID"><p class="glyphicon glyphicon-refresh"></p>&nbsp;&nbsp;Modifier utilisateur</a></li>
              <li><a href="RechercheUtilisateur.php?SID"><p class="glyphicon glyphicon-search"></p>&nbsp;&nbsp;Rechercher Utilisateur</a></li>
    </ul> </nav>
    <?php
     }
///////////////////////////: BAR FOURNISSEUR /////////////////////////////////////////////////////////////////

     function bar_fournisseur()
     {
?>
    <nav class="well3 navbar navbar-default"><ul class="nav nav-pills nav-stacked span2">
    <h4 align="center" ><strong>Gestion Fournisseur</strong></h4>
           <li ><a href="listefournisseur.php?SID"><p class="glyphicon glyphicon-list-alt"></p>&nbsp;&nbsp;Liste Fournisseur</a></li>
            <li><a href="ajoutfournisseur.php?SID"><p class="glyphicon glyphicon-plus"></p>&nbsp;&nbsp;Ajouter Fournisseur</a></li>
             <li><a href="supprimer_fournisseur.php?SID"><p class="glyphicon glyphicon-trash"></p>&nbsp;&nbsp;Supprimer Fournisseur</a></li>
              <li><a href="modificationFour.php?SID"><p class="glyphicon glyphicon-refresh"></p>&nbsp;&nbsp;Modifier Fournisseur</a></li>
              <li><a href="RechercheFournisseur.php?SID"><p class="glyphicon glyphicon-search"></p>&nbsp;Rechercher Fournisseur</a></li>
    </ul> </nav>
    <?php
     }

     ///////////////////////////: BAR CLIENT /////////////////////////////////////////////////////////////////
function bar_client()
     {
       ?>
     <nav class="well3 navbar navbar-default"><ul class="nav nav-pills nav-stacked span2">
    <h4 align="center" ><strong>Gestion Client</strong></h4>
           <li ><a href="listeclient.php?SID"><p class="glyphicon glyphicon-list-alt"></p>&nbsp;&nbsp;&nbsp;&nbsp;Liste Client</a></li>
            <li><a href="ajoutclient.php?SID"><p class="glyphicon glyphicon-plus"></p>&nbsp;&nbsp;&nbsp;&nbsp;Ajouter un Client</a></li>
             <li><a href="supprimer_client.php?SID"><p class="glyphicon glyphicon-trash"></p>&nbsp;&nbsp;&nbsp;&nbsp;Supprimer un Client</a></li>
    <li><a href="RechercheClient.php?SID"><p class="glyphicon glyphicon-search"></p>&nbsp;&nbsp;&nbsp;&nbsp;Rechercher Client</a></li>
    </ul> </nav>
      <?php
     }
//////////////////////////////////////// BAR STOCK //////////////////////////////////////////
    function bar_stock()
     {
  ?>
    <nav class="well3 navbar navbar-default">
      <ul class="nav nav-pills nav-stacked span2">
        <h4 align="center" ><strong>Gestion Stock</strong></h4>
           <li ><a href="listearticle.php?SID"><p class="glyphicon glyphicon-list-alt"></p>&nbsp;&nbsp;&nbsp;&nbsp;Liste Article</a></li>
            <li><a href="ajoutarticle.php?SID"><p class="glyphicon glyphicon-plus"></p>&nbsp;&nbsp;&nbsp;&nbsp;Ajouter un Article</a></li>
            <li><a href="ajoutFamille1.php?SID"><p class="glyphicon glyphicon-plus"></p>&nbsp;&nbsp;&nbsp;&nbsp;Ajouter une Famille</a></li>
             <li><a href="supprimer_article.php?SID"><p class="glyphicon glyphicon-trash"></p>&nbsp;&nbsp;&nbsp;&nbsp;Supprimer un Article</a></li>
              <li><a href="stockmini.php?SID"><p class="glyphicon glyphicon-minus-sign"></p>&nbsp;&nbsp;&nbsp;&nbsp;Article en Stock mini</a></li>
             <li><a href="rupturestock.php?SID"><p class="glyphicon glyphicon-ban-circle"></p>&nbsp;&nbsp;&nbsp;&nbsp;Rupture de Stock</a></li>
           <li><a href="RechercheStock.php?SID"><p class="glyphicon glyphicon-search"></p>&nbsp;&nbsp;&nbsp;&nbsp;Rechercher Article</a></li>
    </ul> </nav>
    <?php
}     ///////////////////////////: BAR TARIF /////////////////////////////////////////////////////////////////
function bar_tarif()
     {
       ?>
     <nav class="well3 navbar navbar-default"><ul class="nav nav-pills nav-stacked span2">
    <h4 align="center" ><strong>Gestion Tarifs</strong></h4>
           <li ><a href="listetarifs.php?SID"><p class="glyphicon glyphicon-list-alt"></p>&nbsp;&nbsp;&nbsp;&nbsp;Liste Tarifs</a></li>
            <li><a href="tarif-article.php?SID"><p class="glyphicon glyphicon-list-alt"></p>&nbsp;&nbsp;&nbsp;&nbsp;Liste Article/Tarif</a></li>
            <li><a href="ajout_tarif1.php?SID"><p class="glyphicon glyphicon-plus"></p>&nbsp;&nbsp;&nbsp;&nbsp;Ajouter un Tarif</a></li>
   
    </ul> </nav>
      <?php
     }

     function bar_entree()
     {
?>
<nav class="well3 navbar navbar-default"><ul class="nav nav-pills nav-stacked span2">
    <h4 align="center" ><strong>Gestion Entrée</strong></h4>
             <li><a href="livraison_entree1.php?SID"><p class="glyphicon glyphicon-briefcase"></p>&nbsp;&nbsp;&nbsp;&nbsp;Livraison</a></li>
           <li ><a href="modifier_livraison.php?SID"><p class="glyphicon glyphicon-shopping-cart"></p>&nbsp;&nbsp;&nbsp;&nbsp;Modifier Livraison</a></li>
            <li><a href="ligneLivraison_entree.php?SID"><p class="glyphicon glyphicon-shopping-cart"></p>&nbsp;&nbsp;&nbsp;&nbsp;Ligne Livraison</a></li>
              
    </ul> </nav>
 <?php
}



 function bar_sortie()
     {
      ?>
     <nav class="well3 navbar navbar-default"><ul class="nav nav-pills nav-stacked span2">
    <h4 align="center" ><strong>Gestion Sortie</strong></h4>
           <li ><a href="devis_sortie.php?SID"><p class="glyphicon glyphicon-shopping-cart"></p>&nbsp;&nbsp;&nbsp;&nbsp;Devis</a></li>
            <li ><a href="lignedevis_entree.php?SID"><p class="glyphicon glyphicon-shopping-cart"></p>&nbsp;&nbsp;&nbsp;&nbsp;Ligne devis</a></li>
            <hr>
           <li ><a href="commande_sortie.php?SID"><p class="glyphicon glyphicon-shopping-cart"></p>&nbsp;&nbsp;&nbsp;&nbsp;Commande</a></li>
           <li ><a href="modifier_commande.php?SID"><p class="glyphicon glyphicon-shopping-cart"></p>&nbsp;&nbsp;&nbsp;&nbsp;Modifier Commande</a></li>
            <li><a href="lignecommande_entree.php?SID"><p class="glyphicon glyphicon-shopping-cart"></p>&nbsp;&nbsp;&nbsp;&nbsp;Ligne Commande</a></li>
            <hr>
              <li ><a href="SortieDevis.php?SID"><p class="glyphicon glyphicon-list-alt"></p>&nbsp;&nbsp;&nbsp;&nbsp;Imp Devis</a></li>
              <li><a href="SortieFacture.php?SID"><p class="glyphicon glyphicon-list-alt"></p>&nbsp;&nbsp;&nbsp;&nbsp;Facturation</a></li>
    </ul> </nav>
      <?php
}
    ?>