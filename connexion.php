<!DOCTYPE html>
<html lang="fr">
 <?php   If(isset($_GET['erreur']) && $_GET['erreur'] == 1){ 
        echo("<h3 class='alert-danger'>Nom d'utilisateur ou mot de passe incorect</h3>")  ;  
   }?>
<head>
    <meta charset="UTF-8">
    <title>Connexion - ELFI</title>
    <link rel="stylesheet" href="styleFormulaire.css">
    <script src="script_js/popUp.js" defer ></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Placer en haut du body -->
    <!-- Pop-Up Connexion -->
    <section id = "connexion">
        <div id="container">
        <!-- zone de connexion -->
            <button id="fermer" onclick="FermerPopUp()">x</button>
            <form id="form_connexion" action="verification.php" method="POST">
                <h1>Connexion</h1>

                <label><b>Nom d'utilisateur</b></label>
                <input class="formInput" title="entrez votre pseudo" type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
        
                <label><b>Mot de passe</b></label>
                <input class="formInput" title="entrez votre mot de passe" type="password" placeholder="Entrer le mot de passe" name="password" required>
                <a target="_BLANK" >
                <input type="submit" id='submit' value='Se Connecter' >
                </a>
        
                <a class = "lienFormConnexion" href="inscription.html">S'inscrire</a>
                <a class = "lienFormConnexion" href="forget.php">Mot de passe oublié?</a>
        
        </form>
        </div>
    </section>

</body>
</html>