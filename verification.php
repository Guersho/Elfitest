<?php
require ('BD.php');
session_start();
$_SESSION["mailUser"] = $_POST["username"];
$_SESSION["fermerPopUp"] = False; // sert à fermer la popUp dans utilisateur.php



if(isset($_POST['username']) && isset($_POST['password']))
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
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
    
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