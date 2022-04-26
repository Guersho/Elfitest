<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>User Inscription - Elfi</title>
    <title>inscription - ELFI</title>
    <link rel="stylesheet" href="styleFormulaire.css">
    <script src="script_js/popUp.js" defer ></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  </head>

<body>
    
    <section id= "connexion">
      <div id="container">
          <button id="fermer" onclick="FermerPopUp()">x</button>  
        <?php
         require ('BD.php');
        function verifiermail($email,$base){
  $session=connexion();
  $trouve = false;
  mysqli_select_db($session, $base);
      $requete1=" SELECT email_user FROM utilisateur";
      $execute1=mysqli_query($session,$requete1);
       while ($ligne=mysqli_fetch_array($execute1)) {
        if ($email==$ligne["email_user"]) {
          $trouve = true;

    }
}
return $trouve;
}
       
          $email=$_POST["email"];
          $nom=$_POST["nomE"];
          $prenom=$_POST["prenomE"];
          $mdp=$_POST["pwd"];
          $date=$_POST["dateE"];
          $adresse=($_POST["AdresseE"]);
          $taille=$_POST["tailleE"];
          $poids=$_POST["poidsE"];
          $sexe=$_POST["sexeE"];
          $cost=['cost' => 12];
          $pwd=password_hash($mdp, PASSWORD_BCRYPT, $cost);
          $imc= $poids/($taille*$taille);
          $nombase="elfi";
          $trouve = verifiermail($email,$nombase);
          if ($trouve==true){ 
          echo ("Un utiilisateur a déjà été enregistré avec cet email");
          }
          else {
          $insertion="INSERT INTO `utilisateur` (`email_user`, `nom_user`, `prenom_user`, `mdp_user`, `datenaiss_user`, `adresse_user`, `taille_user`, `poids_user`, `imc_user`, `sexe_user`) VALUES ('$email', '$nom', '$prenom', '$pwd', '$date', '$adresse', '$taille','$poids','$imc', '$sexe') ";
          $execute=mysqli_query($session,$insertion);
        if($execute==true){
         $insertion2=" INSERT INTO `armoire` (`id_armoire`, `email_user`) VALUES (NULL ,'$email')";
         $execute2=mysqli_query($session,$insertion2);
        }
      if($execute2==true){
        echo("</br>L'inscription a été enregistrée !</br>");
      
      }else{
        echo("L'inscription n'as pas pu être effectué");
      };  

         } 
        ?>
      
       <a href="connexion.php" > <input type="submit" id='submit'  value='Se Connecter' ></a>
      </div>
    </section>
  

</body>
</html>