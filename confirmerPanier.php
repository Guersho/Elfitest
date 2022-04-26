<?php
    session_start();
    require('BD.php');
    require('fonctions.php');
    $panier = $_SESSION["panier"];
    $idUser = $_SESSION["mailUser"];
    $idArmoire = $_SESSION["id_armoire"];

    $message = InsererProduit($session,$panier); // Insertion des produits si ils ne sont pas encore dans la base
    $insertionArmoire = InsererPanier($session,$panier, $idArmoire); // Insertion des produits dans l'armoire utilisateur
    // echo($insertionArmoire);
    $_SESSION["panier"] = 0; //Réinitialisation du panier
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylePanier.css">
    <title>Document</title>
</head>
<body id="chargement">
    <h1><?php echo($message);?></h1>
    <p>Vous allez être rediriger vers votre inventaire ...</p>
    <img src="/image/loading.gif" alt="redirection"/>
</body>
</html>
<script>
    setTimeout(function(){
    window.location.href = "utilisateur.php";
    }, 3000);
</script>