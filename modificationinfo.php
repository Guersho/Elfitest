<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Modification des informations du compte - ELFI</title>
    <link rel="stylesheet" href="styleFormulaire.css">
    <script src="script_js/popUp.js" defer ></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  </head>
  <body>
    
    <section id= "modification">
      <div id="container">
        <button id="fermer" onclick="FermerPopUp()">x</button>  
        <form id="form_connexion" method= "post" action="confirmationmodification.php">
          <h1>Informations </h1>
<?php
require ('BD.php');
session_start();
          $email=$_SESSION['nom_user'];
          $query= "SELECT nom_user, prenom_user, datenaiss_user, adresse_user, taille_user, poids_user, sexe_user FROM utilisateur WHERE email_user = '$email'" ;
$informations=mysqli_query($session,$query);
 while ($ligne=mysqli_fetch_array ($informations)){

echo ("<p><span>Nom:</span> <input id='nomE' name='nomE' type='text' value='".$ligne['nom_user']."'></input></p>
       <p><span>Prénom:</span> <input id='prenomE' name='prenomE' type='text' value='".$ligne['prenom_user']."' ></input></p>     
    
          <p><span>Date de naissance:</span> <input class='formInput' id='dateE' name='dateE' type='Date' value=".$ligne['datenaiss_user']." ></input></p>

          <p><span>Adresse:</span> <input class='formInput' id='AdresseE' name='AdresseE' type='text' value='".$ligne['adresse_user']."'></input></p>  

          <p><span>Taille en m:</span> <input class='formInput' id='tailleE' name='tailleE' type='number' step='any'value='".$ligne['taille_user']."'></input></p>  

          <p><span>Poids en kg:</span> <input class='formInput' id='poidsE' name='poidsE' type='number' value='".$ligne['poids_user']."'></input></p>

          <p><span>Sexe:</span> <select class='formInput' id='sexeE' name='sexeE' value='".$ligne['sexe_user']."'> 
                                        <option>M.</option>
                                        <option>Mme</option>
                                </select></p>
    
     
      ");
}
?>
          
          


            <input class = "lienFormConnexion" type="submit" name="envoyer" id="envoyer" value="Envoyer" onclick="return confirm('etes vous sûr de continuer?')" />
            <input class = "lienFormConnexion" type="reset" name="effacer" id="effacer" value="Effacer" />
          </div>
        </form>
      </div>
    </section>
  </body>
</html>