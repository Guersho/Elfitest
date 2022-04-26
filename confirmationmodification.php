<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>User Modification - Elfi</title>
    <title>Modification - ELFI</title>
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
        <?php
         require ('BD.php');
    session_start();
          $email=$_SESSION['nom_user'];
          $nom=$_POST["nomE"];
          $prenom=$_POST["prenomE"];
          //$mdp=$_POST["pwd"];
          $date=$_POST["dateE"];
          $adresse=$_POST["AdresseE"];
          $taille=$_POST["tailleE"];
          $poids=$_POST["poidsE"];
          $sexe=$_POST["sexeE"];
          $cost=['cost' => 12];
          //$pwd=password_hash($mdp, PASSWORD_BCRYPT, $cost);
          $imc= $poids/($taille*$taille);
          $nombase="elfi";
          $insertion="UPDATE `utilisateur` SET `nom_user` = '$nom', `prenom_user` = '$prenom', `datenaiss_user` = '$date', `adresse_user` = '$adresse', `imc_user` = '$imc',`taille_user`='$taille', `poids_user`='$poids', `sexe_user` = '$sexe' WHERE `utilisateur`.`email_user` = '$email'";
          $execute=mysqli_query($session,$insertion);
        if($execute==true){
        echo("</br>Vos modifications ont été enregistrée !</br>");
      
      }else{
        echo("<p class='alert-danger'>Modification échouée<p>");
      };  

          
        ?>
      
       <a href="connexion.php" > <input type="submit" id='submit'  value='Se Connecter' ></a>
      </div>
    </section>
  

</body>
</html>