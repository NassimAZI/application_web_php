<?php 
session_start(); 
if (isset($_SESSION['admin']))
{
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<link href="styles.css" rel="stylesheet" type="text/css">
		<link href="styles2.css" rel="stylesheet" type="text/css">
		<link href="connexion.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" media="all" href="style.css">
		<script  type="text/javascript" src="js/ajout.js"></script>
		<title> VILLAGE AKHENAK</title>
</head>
<body>
<?php include("liens.php"); ?>
<nav class="admin">

</nav>
<div class="corps">
<section id="container">
		<h2>Ajouter un nouveau compte</h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="" onsubmit="return ajouter()">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<input type="text" name="nom" id="name" placeholder="Nom" autocomplete="off" tabindex="1" class="txtinput">
			<input type="text" name="prenom" id="prenom" placeholder="Prenom" autocomplete="off" tabindex="2" class="txtinput">
			<input type="text" name="identifiant" id="identifiant" placeholder="Identifiant" autocomplete="off" tabindex="3" class="txtinput">
			<input type="password" name="motdepasse" id="motdepasse" placeholder="Mot de passe" autocomplete="off" tabindex="4" class="txtinput">
			<label for="datenaissance"><h3>Date de naissance </h3></label>
			<input type="date" name="datenaissance" id="date" placeholder="aaaa/mm/jj" autocomplete="off" tabindex="5" class="txtinput">		
			</section>		
			<section id="aside" class="clearfix">
				<section id="prioritycase">
					<h3>Sexe:</h3>
					<span class="radiobadge">
						<input type="radio" id="hm" name="choix" value="hm" checked="checked">
						<label for="hm">Homme</label>
					</span>
				
					<span class="radiobadge">
						<input type="radio" id="fm" name="choix" value="fm">
						<label for="fm">Femme</label>
					</span>
				</section>
				<section id="prioritycase">
					<h3>Situation familliale:</h3>
					<span class="radiobadge">
						<input type="radio" id="mr" name="choice" value="mr">
						<label for="mr">Marié</label>
					</span>			
					<span class="radiobadge">
						<input type="radio" id="clb" name="choice" value="clb" checked="checked">
						<label for="clb">Celibataire</label>
					</span>
				</section>
				<section id="prioritycase">
					<h3>Situation professionnelle:</h3>
					<span class="radiobadge">
						<input type="radio" id="tr" name="choic" value="tr" checked="checked">
						<label for="tr">A un emploi</label>
					</span>			
					<span class="radiobadge">
						<input type="radio" id="trp" name="choic" value="trp" >
						<label for="trp">N'a pas d'emploi</label>
					</span>
				</section>
			</section>
			</div>
			<section id="buttons">
			<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Annuler">
			<input type="submit" name="envoie" id="submitbtn" class="submitbtn" tabindex="7" value="Ajouter">
			<br style="clear:both;">
		</section>
		</form>
	</section>



<?php 
if (isset($_POST['envoie']))
{
//on se connecte à notre base
try
{
$bdd = new PDO('mysql:host=localhost;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e-> getMessage());
}
if($_POST['nom']!="" and $_POST['prenom']!="" and $_POST['datenaissance']!="" and $_POST['identifiant']!="" and $_POST['motdepasse']!="")
{
	if($_POST['choix']=="hm")
	{
	$sx='Homme';
	}else
	{
	$sx='Femme';
	}
	if($_POST['choice']=="mr")
	{
	$sf=1;
	}else
	{
	$sf=0;
	}
	if($_POST['choic']=="tr")
	{
	$sp=1;
	}else
	{
	$sp=0;
	}
// la requete d'insertion
$req = $bdd->prepare('INSERT INTO utilisateurs (Nom,Prenom,Date_de_naissance,identifiant,mot_de_passe,Sexe,Sit_Fam,Sit_Pro) VALUES(?, ?, ?, ?, ?, ?, ?,?)');
$req-> execute(array($_POST['nom'], $_POST['prenom'],$_POST['datenaissance'],$_POST['identifiant'],$_POST['motdepasse'],$sx,$sf,$sp));
?>
<script type="text/javascript" > 
		alert('Le compte a bien été ajouté'); 
 </script>

<?php

}else{
?>
<script type="text/javascript" > 
		alert('champs vide'); 
 </script>
<?php }
}
?>		
</div>
<?php include("footer.php"); ?>
</body>
</html>
<?php 
}else{
header('location:index.php');

}
?>
