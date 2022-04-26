// Variable pour construire l'Url
// https://fr.openfoodfacts.org/cgi/search.pl?action=process&search_terms=chocolat&sort_by=unique_scans_n&page_size=24&page=2
var url = 'https://fr.openfoodfacts.org/cgi/search.pl?search_terms=';
const actionProcess = '&search_simple=1&action=process';
var inputVal = '';
const urlPage = '&page='
const urlInJson = '&json=true';

var lancerRecherche = document.getElementById('lancerRecherche');
lancerRecherche.addEventListener('click',demarrerRecherche);

var PageNumClick = document.getElementById('bigtest');
PageNumClick.addEventListener('click',demarrerRecherche);

var pressEnter = document.getElementById("searchObject");
pressEnter.addEventListener("keydown", function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        document.getElementById("lancerRecherche").click();
    }
});

// Procédure
function demarrerRecherche(){
    linkConstructor();
    GetJson();
    // GetMetaData();
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
    // console.log(nbResultat);
    // console.log(page);
    // console.log(nbPage);
    // console.log(nbResPage);
    // console.log(taillePage);

    // Permet de définir la balise main comme zone d'affichage des resultats
    var section = document.querySelector('main');
    // Supprime tout ce qu'il y a en-dessous de la bar nav et affiche les (nouveaux) resultats
    var cleanResult = document.getElementById('main');
    cleanResult.innerHTML = '';

    let indice = data.page_count;
    // Pour chaque résultats de recherche, créer une fiche produit en html
    for (i = 0; i < indice; i++){
        // création de la div où mettre le produit
        let myArticle = document.createElement('div');
        myArticle.classList.add('resultElement');
        // Ajouter les balises nécessaires pour afficher les info prod
            // Produits et marques
            let prodBrand = document.createElement('div');
            prodBrand.classList.add('prodBrand');
            let productName = document.createElement('h3');
            let brand = document.createElement('p');
        
            // Photo produit
            let imgProd = document.createElement('img');
            let frameImg = document.createElement('div');
            let infos = document.createElement('div');
            infos.classList.add('infos');
            frameImg.classList.add('frameImg')
            imgProd.classList.add('resultImg');

            // Nutriscore
            let titreNutriscore = document.createElement('div');
            titreNutriscore.classList.add('titreNutriscore');
            titreNutriscore.textContent = "Nutri-Score";
            let listNutriScore = document.createElement('div');
            listNutriScore.classList.add('listNutriScore');
        // 
        

        // A optimiser avec une boucle for
            let A =  document.createElement('p');
            A.classList.add('nutriRank');
            A.textContent = "A";

            let B =  document.createElement('p');
            B.classList.add('nutriRank');
            B.textContent = "B";

            let C =  document.createElement('p');
            C.classList.add('nutriRank');
            C.textContent = "C";

            let D =  document.createElement('p');
            D.classList.add('nutriRank');
            D.textContent = "D";

            let E =  document.createElement('p');
            E.classList.add('nutriRank');
            E.textContent = "E";

            let Indefinie =  document.createElement('p');
            Indefinie.classList.add('nutriRank');
            Indefinie.classList.add('null');
            Indefinie.textContent = "Indéfinie";

        // Récupérer les infos dans la bd
        imgProd.src = data.products[i].image_front_small_url;
        productName.textContent = data.products[i].product_name;
        brand.textContent = 'marque : ' + data.products[i].brands;
        // //nutriscore.textContent = 'nutriscore : ' + data.products[i].nutriscore_grade;
            
        // insérer les infos dans les balises html correspondantes
        myArticle.appendChild(frameImg);
        myArticle.appendChild(prodBrand);
        myArticle.appendChild(infos);
        frameImg.appendChild(imgProd);
        
        // myArticle.appendChild(imgProd);
        prodBrand.appendChild(brand);
        prodBrand.appendChild(productName);
        
        infos.appendChild(titreNutriscore);
        titreNutriscore.append(listNutriScore);

        // A optimiser avec une boucle for
        listNutriScore.appendChild(A);
        listNutriScore.appendChild(B);
        listNutriScore.appendChild(C);
        listNutriScore.appendChild(D);
        listNutriScore.appendChild(E);
        listNutriScore.appendChild(Indefinie);

        // infos.appendChild(nutriscore);
        section.appendChild(myArticle);

        // Style nutriscore
        switch (data.products[i].nutriscore_grade) {
            case "a":
                A.classList.add("nutriscoreOn");
                break;
            case "b":
                B.classList.add("nutriscoreOn");
                break;
            case "c":
                C.classList.add("nutriscoreOn");
                break;
            case "d":
                D.classList.add("nutriscoreOn");
                break;
            case "e":
                E.classList.add("nutriscoreOn");
                break;
            default:
                listNutriScore.classList.add('indefinie');
                break;
        }
    }

// Afficher l'en-tête des résultats
    var headSearch = document.getElementById('headSearch');
    headSearch.style.display = "contents";

    var displayNbRes = document.getElementById('nbRes');
    displayNbRes.innerHTML ='nombre de résultats : ' + nbResultat;

}

    let btPrecedent = document.getElementById('precedent123');
    btPrecedent.addEventListener('click', function(){
        if (page > 1){
            page -= 1;
            demarrerRecherche();
            console.log(page)
        }
    })

    let btSuivant = document.getElementById('suivant');
    btSuivant.addEventListener('click', function(){
        if (page < nbPage) {
            page += 1;
            demarrerRecherche();
            console.log(page)
        }
    })

