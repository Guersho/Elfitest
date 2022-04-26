// <iframe id="inscriptionPopUp" src= "inscription.html">
// </iframe>
function AfficherPopUP(){
    console.log("yo")
    let popUp_place = document.getElementById('popUp_place');
    let inscription = document.createElement('iframe');
    inscription.classList.add('inscriptionPopUp');
    inscription.setAttribute('src','connexion.php');
    inscription.setAttribute('id','iframe_connexion');
    popUp_place.appendChild(inscription);
}

function FermerPopUp(){
    let connexion_frame = window.parent.document.getElementById('iframe_connexion');
    connexion_frame.parentNode.removeChild(window.parent.document.getElementById('iframe_connexion'));
}
function afficherPwd() {
  var x = document.getElementById("pwd");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
