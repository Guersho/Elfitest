<?php
    // ini_set(‘display_errors’, ‘on’); 
    // error_reporting(E_ALL);

    session_start();
    require('BD.php');

    $idProd = $_GET["idProd"];
    $qte = $_GET["qte"];
    $armoire = $_SESSION["id_armoire"];

    // Suppression de toute les lignes dans la table contenir où l'id = $idProd
    $requete = ("DELETE FROM contenir WHERE id_prod = $idProd AND id_armoire = $armoire");

    if(mysqli_query($session, $requete) == FALSE){
        echo("Le produit n'a pas pu être supprimé de votre inventaire");
    }else{
        // Inserer le produit avec la nouvelle qte dans l'armoire
        if($qte > 0){
            $requete1 = ("INSERT INTO contenir(id_prod,id_armoire,qte_prod) VALUES($idProd,$armoire,$qte)");
            if(mysqli_query($session , $requete1) == TRUE){
                // Redirection vers la page utilisateur
                echo("<script>
                    window.location = 'utilisateur.php';
                </script>");
            }
            else{
                echo("Votre requête à échoué, veuillez réessayer");
            };
        }
        else{
            echo("<script>
            window.location = 'utilisateur.php';
            </script>");
        };
    };


?>


