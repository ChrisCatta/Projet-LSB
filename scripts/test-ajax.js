$(document).ready(function(){
 	//chargerCategories();
 	/*chargerFamille(1);
 	chargerListeArticlesType(1);
 	chargerListeArticlesStock(1);
 	chargerListeLivraisonType(1);
 	calcule();*/
  });
  function chargerCategories(ID_TYPE=null){
  	$.get('choix-cat.php?idtype='+ID_TYPE, function(repcat){
  	$('#div-type').html(repcat);
  	$('#select-type').change(function(){
  	chargerFamille($(this).val());
  	chargerListeArticlesType($(this).val());
  	chargerListeArticlesStock($(this).val());
  	chargerListeCommType($(this).val());
  	chargerListeLivraisonType($(this).val());
  	chargerListeDevType($(this).val());
  	});
  });
  }
  function chargerFamille(ID_TYPE ,ID_FAMILLE=null){
  	$.get('choix-famille.php?idtype='+ID_TYPE+'idfamille='+ID_FAMILLE, function(repfam){
  	$('#div-famille').html(repfam);
  	$('#select-famille').change(function(){
  	chargerListeArticlesFam($(this).val());
  	chargerListeCommFam($(this).val());
  	chargerListeLivraisonFam($(this).val());
  	chargerListeDevFam($(this).val());
  	});
  	});
  }
function chargerListeArticlesFam(ID_FAM){
  	$.get('liste-article.php?idfamille='+ID_FAM, function(repart){
  	$('#div-list-art').html(repart);
  	});
  	$.get('liste-article-stock.php?idfamille='+ID_FAM, function(repart){
  	$('#div-list-stock').html(repart);
  	});
  	$.get('liste-livraison.php?idfamille='+ID_FAM, function(repliv){
  	$('#div-list-liv').html(repliv);
  	});
  	$.get('liste-commande.php?idfamille='+ID_FAM, function(repcom){
  	$('#div-list-comm').html(repcom);
  	});
  	$.get('liste-devis.php?idfamille='+ID_FAM, function(repcom){
  	$('#div-list-dev').html(repcom);
  	});
  }
function chargerListeArticlesType(ID_TYPE){
  	$.get('liste-article.php?idtype='+ID_TYPE, function(repart){
  	$('#div-list-art').html(repart);
  	});
  	$.get('liste-article-stock.php?idtype='+ID_TYPE, function(repart){
  	$('#div-list-stock').html(repart);
  	});
  	$.get('liste-livraison.php?idtype='+ID_TYPE, function(repliv){
  	$('#div-list-liv').html(repliv);
  	});
  	$.get('liste-commande.php?idtype='+ID_TYPE, function(repcom){
  	$('#div-list-comm').html(repcom);
  	});
  	$.get('liste-devis.php?idtype='+ID_TYPE, function(repcom){
  	$('#div-list-dev').html(repcom);
  	});
  }
function chargerListeArticlesStock(ID_TYPE){
  	$.get('liste-article-stock.php?idtype='+ID_TYPE, function(repart){
  	$('#div-list-stock').html(repart);
  	});
  }

function chargerListeLivraisonFam(ID_FAM){
  	$.get('liste-livraison.php?idfamille='+ID_FAM, function(repliv){
  	$('#div-list-liv').html(repliv);
  	});
  }
function chargerListeLivraisonType(ID_TYPE){
  	$.get('liste-livraison.php?idtype='+ID_TYPE, function(repliv){
  	$('#div-list-liv').html(repliv);
  	});
  }
function chargerListeCommType(ID_TYPE){
  	$.get('liste-commande.php?idtype='+ID_TYPE, function(repcom){
  	$('#div-list-comm').html(repcom);
  	});
  }
function chargerListeCommFam(ID_FAM){
  	$.get('liste-commande.php?idfamille='+ID_FAM, function(repcom){
  	$('#div-list-comm').html(repcom);
  	});
  }
function chargerListeDevType(ID_TYPE){
  	$.get('liste-devis.php?idtype='+ID_TYPE, function(repcom){
  	$('#div-list-dev').html(repcom);
  	});
  }
function chargerListeDevFam(ID_FAM){
  	$.get('liste-devis.php?idfamille='+ID_FAM, function(repcom){
  	$('#div-list-dev').html(repcom);
  	});
  }
function afficheLivraison(ID_BONL){
	$.get('liste-liv-article.php?idBL='+ID_BONL, function(repliv){
  	$('#div-liv-art').html(repliv);
  	});
}
function afficheCommande(ID_CO){
	$.get('liste-comm-article.php?idCO='+ID_CO, function(repcom){
  	$('#div-comm-art').html(repcom);
  	});
}
function afficheDevis(ID_DV){
	$.get('liste-dev-article.php?idDV='+ID_DV, function(repcom){
  	$('#div-dev-art').html(repcom);
  	});
}
function suppligneCommande(idCO,idtd){
	$.get('supprimerLigneCommande.php?idco='+idCO+'&idLCO='+idtd, function(repligne){
    $('#ligne-commande').html(repligne);
  	});
}
function suppligneDevis(idDV,idtd){
	$.get('supprimerLigneDevis.php?iddv='+idDV+'&idLDV='+idtd, function(repligne){
    $('#ligne-devis').html(repligne);
  	});
}
function suppLigneLiv(ID_LIGNE){
	$.get('supprimerLigneLivraison.php?ID_LIGNE='+ID_LIGNE, function(repligne){
    $('#ligne-livraison').html(repligne);
  	});
}
function ajoutLivraison(ID_BONL,QTE_BON_L,ID_A){
	$.get('ajout-liv-article.php?idBL='+ID_BONL+'&qtebl='+QTE_BON_L+'&idA='+ID_A, function(repliv){
  	});
}
function ajoutCommande(ID_CO,QTE_CO,ID_A){
	$.get('ajout-comm-article.php?idCO='+ID_CO+'&qteCO='+QTE_CO+'&idA='+ID_A, function(repcom){
  	});
}
function ajoutDevis(ID_DV,QTE_DV,ID_A){
	$.get('ajout-dev-article.php?idDV='+ID_DV+'&qteDV='+QTE_DV+'&idA='+ID_A, function(repcom){
  	$('#div-dev-art').html(repcom);
  	});
}

$(function() { 
	
	$(document).on("change", "#livraison tr", function(e) {
		idtr = this.id;
    var idbl =document.getElementById('idbl').value;
    var qtebl =document.getElementById("qte"+idtr).value;
		if ($(this).hasClass('selected')) {
    		$(this).removeClass('selected');
		 	suppLigneLiv(idbl,idtr);
    	}else {
	 $(this).addClass('selected');
	ajoutLivraison(idbl,qtebl,idtr);
		}
	//alert("bl ="+idbl +"et art ="+idtr);
	});
});
$(function() { 
	
	$(document).on("change", "#commande tr", function(e) {
		var idtr = this.id;
    var idCO =document.getElementById('idco').value;
    var qteCO =document.getElementById("qte"+idtr).value;
		if ($(this).hasClass('selected')) {
    		$(this).removeClass('selected');
		 	suppligneCommande(idCO,idtr);
    	}
    else 
      {
	 $(this).addClass('selected');
	ajoutCommande(idCO,qteCO,idtr);
		}
	//alert("Co ="+idco +"et qte ="+qteCO+"et art ="+idtr);
	});
});
$(function() { 
	
	$(document).on("change", "#devis tr", function(e) {
		var idtr = this.id;
    var idDV =document.getElementById('iddv').value;
    var qteDV =document.getElementById("qte"+idtr).value;
		if (qteDV==='') {
    		$(this).removeClass('selected');
		 	suppligneDevis(idDV,idtr);
		 	
                }else {
                 $(this).addClass('selected');
                ajoutDevis(idDV,qteDV,idtr);
                        }
                });
});
$(function() { 
	
	$(document).on("click", ".supprimeLDV", function(e) {
		var idtd = this.id;
	var idDV =document.getElementById("iddv").value;
      if(confirm("Voulez vous vraiment supprimer la ligne DV "+idDV+" et art ="+idtd)){
          suppligneDevis(idDV,idtd);
      }
  afficheDevis(idDV);
	});
});
$(function() { 
	
	$(document).on("click", ".supprimeLCO", function(e) {
		idtd = this.id;
	var idCO =document.getElementById("idco").value;
      if(confirm("Voulez vous vraiment supprimer la ligne CO ="+idCO +" et "+idtd)){
          suppligneCommande(idCO,idtd);
      }
  afficheCommande(idCO);
	});
});

function calculquantite(){
    var selectElmt = document.getElementById("Select-unite");
    var valeurselectionnee = selectElmt.options[selectElmt.selectedIndex].value;
    var unit = selectElmt.options[selectElmt.selectedIndex].text;
    var longueur =parseFloat($('#longueur').val());
    var largeur = $('#largeur').val();
    var epaisseur = $('#epaisseur').val();
    var diametre = $('#diametre').val();
    if(unit==="M3"){
      var quantite = longueur*(largeur/1000)*(epaisseur/1000);
      quantite = quantite.toFixed(3);
      }
      else{
        if(unit==="M2"){
            var quantite = longueur*(largeur/1000);
            quantite = quantite.toFixed(3);
          }
          else{
        if(unit==="ML"){
            var quantite = longueur;
            }
        quantite=0;
        }
     }
   console.log(unit);
   console.log(quantite);
   console.log(longueur);
    $('#QTE').val(quantite);
    $('#UNITE').val(unit);
    $('#ID_UNITE').val(valeurselectionnee);
    }

  function calcultarif(){
    var selectElmt = document.getElementById('select-tarif');
    var idtarif = selectElmt.options[selectElmt.selectedIndex].value;
    var montHT =  parseFloat(selectElmt.options[selectElmt.selectedIndex].text);
    var tx =  parseFloat($('#TX').val());
   var tarif = parseFloat(montHT+((montHT*tx)/100));
   console.log(tx);
   console.log(montHT);
     console.log(tarif);
    $('#TARIF').val(tarif);
    $('#PRIX_U').val(montHT);
    $('#ID_TARIF').val(idtarif);
}

function famille(){
    var selectElmt = document.getElementById('select-famille');
    var idfamille = selectElmt.options[selectElmt.selectedIndex].value;
    var famille = selectElmt.options[selectElmt.selectedIndex].text;
   console.log(idfamille);
   console.log(famille);
    $('#ID_FAMILLE').val(idfamille);
    $('#FAMILLE').val(famille);
    }
    
function type(){
    var selectElmt = document.getElementById('select-type');
    var idtype = selectElmt.options[selectElmt.selectedIndex].value;
    var type = selectElmt.options[selectElmt.selectedIndex].text;
   console.log(idtype);
   console.log(type);
    $('#ID_TYPE').val(idtype);
    $('#TYPE').val(type);
    document.getElementById("affichage").innerHTML = "le type est :" +idtype+type+".";
    } 
    
function remise() {
         var montremise= document.getElementById("remise").value;
         var tht = document.getElementById("tht").value;
         var monttht= tht-montremise;
         var monttva =monttht*0.2;
         var montttc= monttht +monttva;
         document.getElementById("monttht").value=monttht;
         document.getElementById("montremise").value=montremise;
         document.getElementById("t").value= montttc;
         document.getElementById("lettres").value = trans(montttc);
     }