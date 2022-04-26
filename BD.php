<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
	<title></title>
</head>
<body>
<?php
function connexion(){
	$nomlogin="root";
	$passwd="";
	$session= mysqli_connect('localhost', $nomlogin, $passwd);
	
	return $session;
}
$nombase="elfi";
$session=connexion();
if ($session == NULL) { // Test de connexion réussie
echo ("<p>Echec de connection</p>");
} else {
// Sélection de la base de donnée
if (mysqli_select_db($session, $nombase) == TRUE) {

} else {
echo ("Cette base n'existe pas");
}
}

?>
</body>
</html>