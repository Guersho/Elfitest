console.log('salut');

const url = 'https://fr.openfoodfacts.org/cgi/search.pl?search_terms=chocolat&search_simple=1&action=process&page=1&json=true';
function montest(){
fetch(url)
    .then(res => res.json())
    .then(data => {return data})
}

test = montest()
console.log(test)