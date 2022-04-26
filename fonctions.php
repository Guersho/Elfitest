<?php
    class Produit{
        public $id;
        public $image;
        public $marque;
        public $nom;
        public $score;
        public $quantite = 0;
        function set_id($id){
            $this->id = $id;
        }
        function get_id(){
            return $this->id;
        }
        function set_image($image){
            $this->image = $image;
        }
        function get_image(){
            return $this->image;
        }
        function set_marque($marque){
            try {
                $this->marque = $marque;
            } catch (\Throwable $th) {
                $this ->marque = "";
            }
            return $marque;
        }
        function get_marque(){
            return $this->marque;
        }
        function set_nom($nom){
            $this->nom = $nom;
        }
        function get_nom(){
            return $this->nom;
        }
        function set_score($score){
            $this->score = $score;
        }
        function get_score(){
            return $this->score;
        }
        function set_quantite($quantite){
            $this->quantite = $quantite;
        }
        function get_quantite(){
            return $this->quantite;
        }
    };

    // Ajouter un produit dans la bd
    // $panier : variable de session
    // $id,$nom,$marque,$image,$score,$quantite : attributs du produit et qte choisi pat l'utilisateur
    // $message : 
    function InsererProduit($session,$panier){
        foreach ($panier as $produit) {
            $id = $produit[0];
            $nom = $produit[1];
            $marque = $produit[2];
            $image = $produit[3];
            $score = $produit[4];
            $quantite = $produit[5]; 
            // Code d'insertion BD ...
            // Ajouter les produits dans la base si ils ne sont pas déjà enregistrés
            $requeteProduit = ("INSERT IGNORE INTO produit(id_prod, lib_prod, nutriscore_prod, image_prod, marque_prod)
                                VALUES('$id','$nom','$score','$image','$marque');");
            if(mysqli_query($session, $requeteProduit) == TRUE){
                $message = "Votre inventaire a bien été mis à jour !";
            }
            else{
                $message = "Une erreur est survenue, veuillez reconstituer votre panier";
            };
        };

        return $message;
    }

    // Insertion des produits dans l'armoire utilisateur
    function InsererPanier($session, $panier, $idArmoire){
        foreach ($panier as $produit) {
            $id = $produit[0];
            $nom = $produit[1];
            $marque = $produit[2];
            $image = $produit[3];
            $score = $produit[4];
            $quantite = $produit[5]; 
            
            // Code d'insertion BD ...
            // Ajouter les produits dans l'inventaire
            $requeteInventaire = ("INSERT INTO contenir(id_prod,id_armoire,qte_prod) VALUES($id,$idArmoire,$quantite)");
            if(mysqli_query($session, $requeteInventaire) == TRUE){
                $message = "Votre inventaire a bien été mis à jour !";
            }
            else{
                $message = "Une erreur est survenue, veuillez reconstituer votre panier !";
            };
        };
        return $message;
    };

    //Reccupère la liste des produits contenu dans l'armoire d'un utilisateur
    function ListeProduitInv($session, $id_armoire){
        $listProd = [];
        $requeteIdProd = ("SELECT DISTINCT id_prod FROM contenir WHERE id_armoire = $id_armoire"); 
        $resIdProd = mysqli_query($session,$requeteIdProd);
        if($resIdProd == TRUE){
            while($ligne = mysqli_fetch_array($resIdProd)){
                array_push($listProd,$ligne[0]);
            };
        };
        return $listProd;
    }

    // Affiche la liste des produit dans l'armoire d'un utilisateur 
    function AfficherInv($session, $listProd){

        foreach ($listProd as $idProd) {
            $requeteInv = ("SELECT p.lib_prod, p.marque_prod, p.nutriscore_prod, image_prod, SUM(c.qte_prod) 
                            FROM armoire a, contenir c, produit p
                            WHERE c.id_armoire = a.id_armoire
                              AND p.id_prod = c.id_prod
                              AND p.id_prod = $idProd
                            GROUP BY p.lib_prod, p.marque_prod, p.nutriscore_prod;
            ");

            $resInv = mysqli_query($session,$requeteInv);
            if($resInv == TRUE){
                while($ligne = mysqli_fetch_array($resInv)){
                    $nomProd = $ligne[0];
                    $marqueProd = $ligne[1];
                    $nutriScore = $ligne[2];
                    $imageProd = $ligne[3];
                    $qteProd = $ligne[4];
                    echo("
                        <tr>
                            <td class='section nomProd'>
                                <div class='imgContainer'>
                                    <img src='$imageProd' alt='photo $nomProd'>
                                </div>
                            </td>
                            <td class='section nomProd'>$marqueProd</td>
                            <td class='section'>$nomProd</td>
                            <td class='section'>".strtoupper($nutriScore)."</td>
                            <td class='section'>
                                <form action='modifierArmoire.php' method='get'>
                                    <button type='button' class='retirerBtn' onclick = 'changerQte($idProd,0)'>-</button>
                                    <input id='P$idProd' type='number' value='$qteProd' name='qte' />
                                    <button type='button' class='ajouterBtn' onclick = 'changerQte($idProd,1)'>+</button>
                                    <button id='$idProd' type='submit' name='idProd' value='$idProd'>modifier</button>
                                </form>
                            </td>
                        </tr>
                        <tr class='divider'>
                            <td colspan='5'></td>
                        </tr>
                    ");
                };
            }
            else{
                echo("erreur requete");
            };
        };
    };

?>