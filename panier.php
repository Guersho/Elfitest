<?php 
    session_start();
    require("fonctions.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylePanier.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
    <title>Panier</title>
</head>
<?php
    $panier = $_SESSION["panier"];
    $id = $_GET["id"];
    // Récupérer les données produit
    $json_data = $_SESSION["json_data"];
    $idP = $_GET["idP"];
    $nom = $_GET["nom"];
    $marque = $_GET["marque"];
    $image = $_GET["image"];
    $score = $_GET["score"];
    $qte = $_GET["quantites"];

    function AjouterProduit($idP,$nom,$marque,$image,$score,$qte, &$panier){
        $produit = [];
        array_push($produit,$idP,$nom,$marque,$image,$score,$qte);
        array_push($panier,$produit);
    }

    AjouterProduit($idP,$nom,$marque,$image,$score,$qte, $panier);
    $_SESSION["panier"] = $panier;
?>
<body>
    <h1>Récapitulatif des produits ajoutés</h1>
    <div id="ticket">
        <h3>Votre ticket Elfi</h3>
        <div class="barre"></div>
        <table>
            <tr>
                <td class='produit gras'>Produit</td>
                <td class='qte gras'>Quantité</td>
            </tr>
            <?php
                // $total = $_SESSION["total"];
                $total = 0;

                foreach($panier as $produit){
                    echo("
                        <tr>
                            <td class='produit'>$produit[1]</td>
                            <td class='qte'>$produit[5]</td>
                        </tr>
                    ");
                    $total = $total + $produit[5];

                }
                $_SESSION["total"] = $total;
            ?>
            <tr>
                <td class="produit gras">TOTAL</td>
                <td class="qte gras">
                    <?php
                        echo($total);
                    ?>
                </td>
            </tr>
        </table>
        <div class="barre"></div>
        <div id="messages">
            <small>Merci d'avoir utilisé Elfi</small>
            <small>" Pour votre santé, mangez au moins cinq fruits et légumes par jour "</small>
            <small>" Pour votre santé, pratiquez une activité physique régulière "</small>
            <small>" Pour votre santé, évitez de manger trop gras, trop sucré, trop salé "</small>
            <small>" Pour votre santé, évitez de grignoter entre les repas "</small>
        </div>
    </div>

    <div id="navigation">
        <form action="confirmerPanier.php" method="get">
            <button type="submit">Confirmer</button>
        </form>
        <button id="back" type="button" onclick="goBack()">Ajouter d'autres produits</button>
        <button id="annuler" type="button" onclick="retour()">Annuler</button>
    </div>

</body>
</html>

<script>
    function retour(){
        window.location = "utilisateur.php";
    }
    function goBack(){
        window.history.go(-1);
    }
</script>