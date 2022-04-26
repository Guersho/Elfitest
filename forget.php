<!DOCTYPE html>
<html lang="fr">
 <?php   If(isset($_GET['erreur']) && $_GET['erreur'] == 1){ 
        echo("<h3 class='alert-danger'>Cet email n'existe pas</h3>") ; } 
        If(isset($_GET['succes']) && $_GET['succes'] == 2){ 
        echo("<h3 class='alert-danger'>Email de reinitialisation envoyé dans votre mail</h3>")  ;  
   }?>
<head>
    <meta charset="UTF-8">
    <title>Reinitialisation - ELFI</title>
    <link rel="stylesheet" href="styleFormulaire.css">
    <script src="script_js/popUp.js" defer ></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Placer en haut du body -->
    <!-- Pop-Up Connexion -->
    <section id = "forget">
        <div id="container">
        <!-- zone de connexion -->
            <button id="fermer" onclick="FermerPopUp()">x</button>
            <form id="form_forget" action="verification.php" method="POST">
                <h1>Reinitialisation</h1>

                <label><b>Nom d'utilisateur</b></label>
                <input class="formInput" title="entrez votre pseudo" type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
        
                <input type="submit" id='submit' value='Envoyer' >
                </a>
        
                <a class = "lienFormConnexion" href="inscription.html">S'inscrire</a>
                <a class = "lienFormConnexion" href="connexion.php">Se Connecter</a>
        
        </form>
        </div>
    </section>

</body>
</html>