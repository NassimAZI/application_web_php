<?php

session_start();
header('Content-type: text/html; charset=utf-8');

/********Actualisation de la session...**********/
include('fonctions.php');
connexionbdd();
actualiser_session();
if($_SESSION['id']!=1)
{
$informations = Array(/*Erreur*/
true,
'Erreur',
'page de l\'administrateur ',
'',
'utilisateur.php',
5
);
require_once('information.php');
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<link href="styles.css" rel="stylesheet" type="text/css">
		<link href="styles2.css" rel="stylesheet" type="text/css">
		
		<title> VILLAGE AKHENAK</title>
</head>

<body>
<?php include("liens.php"); ?>
<nav class="admin">
<?php include("menu2.php"); ?>
</nav>
<div class="corps">
<table border="3"><tr>
<td class="tablistearticle"><strong>Idcommande</strong> </td>
<td class="tablistearticle"><strong>Date</strong> </td>
<td class="tablistearticle"><strong>Duree</strong></td> 
<td class="tablistearticle"><p><strong>Idutilisateur</strong></p></td>
<td class="tablistearticle"><p><strong>Idarticle</strong></p></td>
</tr>

<?php
try
{
// On se connecte à MySQL
$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestionvillage', 'root', '');
}
catch(Exception $e)
{
// En cas d'erreur, on affiche un message et on arrête tout
die('Erreur : '.$e->getMessage());
}
// Si tout va bien, on peut continuer
// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT * FROM commande');
// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
?>
<tr>
<td class="tablistearticle"><?php echo $donnees['IdCommande']; ?></td>
<td class="tablistearticle"><?php echo $donnees['Date']; ?></td>
<td class="tablistearticle"><?php echo $donnees['Duree'];?> </td> 
<td class="tablistearticle"><?php echo $donnees['IdUtilisateur']; ?></td>
<td class="tablistearticle"><?php echo $donnees['Idarticle']; ?></td>
</tr>




<?php
}

$reponse->closeCursor(); // Termine le traitement de la requête
?>
</table>

		
</div>
<?php include("footer.php"); ?>
</body>
</html>
