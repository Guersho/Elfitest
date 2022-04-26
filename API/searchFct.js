// Variable pour construire l'Url
// https://fr.openfoodfacts.org/cgi/search.pl?action=process&search_terms=chocolat&sort_by=unique_scans_n&page_size=24&page=2
var url = 'https://fr.openfoodfacts.org/cgi/search.pl?search_terms=';
var actionProcess = '&search_simple=1&action=process';
var inputVal = '';
var urlPage = '&page='
var urlInJson = '&json=true';

var lancerRecherche = document.getElementById('lancerRecherche');
lancerRecherche.addEventListener('click',demarrerRecherche);

var PageNumClick = document.getElementById('bigtest');
PageNumClick.addEventListener('click',demarrerRecherche);

function demarrerRecherche(){
    linkConstructor();
    GetJson();
}

//Variable pour les métadonnées
var nbResultat;
var page = 1;
var nbPage;
var nbResPage;
var taillePage; // nb de résultat à afficher dans une page


// Construire le lien
function linkConstructor(){
    // Récuperer l'input text
    inputVal = document.getElementById('searchObject').value;
    
    // Convertir l'input dans le bon format
    let indice = inputVal.length;
    let bonFormat = '';
    let espace = ' ';

    for (i = 0 ; i < indice; i++){
        if (inputVal[i] == espace){
            bonFormat += '+';
        }else{
             bonFormat += inputVal[i];
        }
    }
    inputVal = bonFormat;

    // Construire l'url
    url = url + inputVal + actionProcess + urlPage + page + urlInJson;

    // vérifications
    console.log(inputVal);
    console.log(url);
    
}

// recupérer le fichier Json à partir de l'Url
function GetJson(){
    fetch(url)
    .then(res => res.json())
    .then(data => DisplaySearchResult(data));

    // réinitialiser l'url
    url = 'https://fr.openfoodfacts.org/cgi/search.pl?search_terms=';
    inputVal = ' ';
    endUrl = '&search_simple=1&action=process&json=true';
}

// afficher les résultats
function DisplaySearchResult(data){
    // Récupérer les métadonnées
    nbResultat = data.count;
    page = data.page;
    nbResPage = data.page_count;
    taillePage = data.page_size;
    nbPage = Math.ceil(nbResultat / taillePage) ; // arrondi supérieur

    // verification
    console.log(nbResultat);
    console.log(page);
    console.log(nbPage);
    console.log(nbResPage);
    console.log(taillePage);

    // Permet de définir la balise main comme zone d'affichage des resultats
    var section = document.querySelector('main');
    // Supprime tout ce qu'il y a en-dessous de la bar nav et affiche les (nouveaux) resultats
    var cleanResult = document.getElementById('main');
    cleanResult.innerHTML = '';
    console.log(cleanResult.innerHTML);

    let indice = data.page_count;
    // let resultat = '';
    for (i = 0; i < indice; i++){
        let myArticle = document.createElement('div');
        myArticle.classList.add('resultElement');
        let productName = document.createElement('h3');
        let brand = document.createElement('p');
        let nutriscore = document.createElement('p');

        productName.textContent = data.products[i].product_name;
        // console.log(productName.textContent)
        brand.textContent = 'marque : ' + data.products[i].brands;
        // console.log(brand.textContent)
        nutriscore.textContent = 'nutriscore : ' + data.products[i].nutriscore_grade;
        // console.log(nutriscore.textContent)
        // console.log(' ')

        myArticle.appendChild(productName);
        myArticle.appendChild(brand);
        myArticle.appendChild(nutriscore);

        section.appendChild(myArticle);
    }

    // Afficher l'en-tête des résultats
    var headSearch = document.getElementById('headSearch');
    headSearch.style.display = "contents";

    var displayNbRes = document.getElementById('nbRes');
    displayNbRes.innerHTML ='nombre de résultats : ' + nbResultat;
    // Afficher le pied de page des résultats

    // Affecter le bon lien au num de page
    
    console.log(PageNumClick);
    
    console.log(PageNumClick.innerHTML);
    page = parseInt(PageNumClick.innerHTML) + 1 ;
    console.log(page);
    PageNumClick.innerText = page;
}

