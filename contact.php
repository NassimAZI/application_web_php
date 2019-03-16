<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<link href="styles2.css" rel="stylesheet" type="text/css">
		<link href="styles.css" rel="stylesheet" type="text/css">
		<link href="contact.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" media="all" href="style.css">
		<script  type="text/javascript" src="js/contacter.js"></script>
		<?php /* css des images qui bouges         
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" media="screen" href="res/css/style.css"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400italic,400,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>*/?>
		<title> VILLAGE AKHENAK</title>
</head>
<body>
<?php include("liens.php"); ?>
<nav class="corps">
<section id="container">
		
		<h2>ENVOYER UN MESSAGE</h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="" onsubmit="return sendit()">
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
// la requete d'insertion
$req = $bdd->prepare('INSERT INTO contacter (Nom,Prenom,date_mes,email,msg) VALUES(?, ?,now(), ?, ?)');
$req->execute(array($_POST['nom'], $_POST['prenom'],$_POST['email'],$_POST['message']));
?>
<script type="text/javascript" > 
		alert('Votre message a bien été envoyé'); 
 </script>
<?php }
?>		
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<input type="text" name="nom" id="name" placeholder="Votre Nom" autocomplete="off" tabindex="1" class="txtinput">
			<input type="text" name="prenom" id="prenom" placeholder="Votre Prenom" autocomplete="off" tabindex="2" class="txtinput">
			<input type="text" name="email" id="email" placeholder="Votre E-mail" autocomplete="off" tabindex="3" class="txtinput">
			<textarea type="text" name="message" id="message" placeholder="Saisir votre message ICI" autocomplete="off" tabindex="4" class="txtblock"></textarea>		
			</section>		
			</div>
			<section id="buttons">
			<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Annuler">
			<input type="submit" name="envoie" id="submitbtn" class="submitbtn" tabindex="7" value="Envoyer">
			<br style="clear:both;">
		</section>
		</form>
	</section>


</nav>
<?php include("footer.php"); ?>
</body>
</html>
