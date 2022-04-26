<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styleFormulaire.css">
    <script src="script_js/genererpwd.js" defer ></script>
</head>
<body>
<?php
require ('BD.php');


if(isset($_POST['username']))
{
    // connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'elfi';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
    $password = echo("setpwd(pass)");
    
    if($username <> "" && $password <> "")
    {
        $requete = "SELECT mdp_user FROM utilisateur where email_user = '$username' ";
       $execute=mysqli_query($session,$requete);
       while ($ligne=mysqli_fetch_array($execute)) {
        $pass=$ligne['mdp_user'];
        
    }
       if(password_verify($password, $pass)) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['nom_user'] = $username;
           header('Location: utilisateur.php');
        }
        else
        {
           header('Location: connexion.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
}
else
{
   header('Location: connexion.php');
}
mysqli_close($db); // fermer la connexion
?>
</body>
</html>