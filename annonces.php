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
		<link href="style.css" rel="stylesheet" type="text/css">
		<link href="styles2.css" rel="stylesheet" type="text/css">
		<link href="connexion.css" rel="stylesheet" type="text/css">
		<title> VILLAGE AKHENAK</title>
</head>
<body>
<?php include("liens.php"); ?>
<nav class="admin">

</nav>
<div class="corps">
<section id="container">
		
		<h2>Ajouter une annonce</h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<label for="titre">Titre: </label>
			<input type="text" name="titre" id="titre" value="" autocomplete="off" tabindex="1" class="txtinput">
			<label for="titre">Contenu: </label>
			<textarea name="contenu" id="message"  tabindex="5" class="txtblock"></textarea>		
			</section>		
					<section id="aside" class="clearfix">
					<section id="prioritycase">					
						<label for="choix"><h3>Type:</h3></label>
						<span class="radiobadge">
					 	<input type="radio" name="choix" value="appel" id="appel" checked="checked"/> 
						<label for="appel">Appel</label>
						</span>
						<span class="radiobadge">
						<input type="radio" name="choix" value="Information" id="Information"  />
						<label for="Information">Information</label>								
						</span>
						<span class="radiobadge">
						<input type="radio" name="choix" value="dece" id="dece"  />
						<label for="dece">Décés</label>								
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
if(htmlspecialchars($_POST['titre'])!="" and htmlspecialchars($_POST['choix'])!="" and htmlspecialchars($_POST['contenu'])!="" )
{
// la requete d'insertion
$req = $bdd->prepare('INSERT INTO 	Annonces (Date,Titre,Contenu,Type) VALUES(now(), ?, ?, ?)');
$req-> execute(array(htmlspecialchars($_POST['titre']), htmlspecialchars($_POST['contenu']),htmlspecialchars($_POST['choix'])));
?>
<script type="text/javascript" > 
		alert('l\'annonce a bien été ajouter'); 
 </script>
<?php
}
else{
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