<?php

session_start();
header('Content-type: text/html; charset=utf-8');

/********Actualisation de la session...**********/
include('fonctions.php');
connexionbdd();
actualiser_session();
?><!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<link href="styles.css" rel="stylesheet" type="text/css">
		<link href="styles2.css" rel="stylesheet" type="text/css">
		<link href="connexion.css" rel="stylesheet" type="text/css">
		<title>MON VILLAGE</title>
</head>

<body>
<?php include("liens.php"); ?>
<nav class="admin">
<?php include("menuutilisateur.php"); ?>
</nav>
<div class="corps">
<?php
$retour = sqlquery("SELECT *  FROM utilisateurs WHERE IdUtilisateur = ".intval($_SESSION['id']), 1);
?>  
<form class="formnewcompte" method="post" action="infomationsperso.php">
	<aside class="tab">
		<table class="tabnewcompte">
		
			<tr><td>Nom: </td><td><?php echo $retour['Nom'];?></td></tr>
			<tr><td>Prenom: </td><td><?php echo $retour['Prenom'];?></td></tr>
			<tr><td>Email: </td><td><?php echo $retour['Identifiant'];?></td></tr>
			<tr><td>Date de naissance: </td><td><?php echo $retour['Date_de_naissance'];?></td></tr>
			<tr><td>sexe: </td><td><?php echo $retour['sexe'];?></td></tr>
		</table>
	</aside>
</form>

<?php 

if (isset($_POST['envoie']))
{
//on se connecte à notre base
try
{
$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestionvillage', 'root', '');
}
catch(Exception $e)
{
die('Erreur : '.$e-> getMessage());
}
 // la requete d'insertion
 if($_POST['sexe']=="homme")
 $sexe="homme";
 else
 $sexe="femme";
$req = $bdd->prepare('update utilisateurs set Nom=:nom,Prenom=:prenom,Identifiant=:identifiant,Mot_de_passe=:passe,sexe=:sexe where IdUtilisateur = '.$_SESSION['id']);
if($req->execute(array(
'nom' => $_POST['nom'],
'prenom' => $_POST['prenom'],
'identifiant' => $_POST['email'],
'passe' => SHA1($_POST['motdepasse']),
'sexe' => $sexe
)))

echo "<center><h3>le compte a bien ete ajouter</h3></center>";
else
echo "echec de l'ajout";
 }
?>

</div>
<?php include("footer.php"); ?>
</body>
</html>
