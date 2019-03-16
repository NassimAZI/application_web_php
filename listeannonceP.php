<?php 
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<link href="styles.css" rel="stylesheet" type="text/css">
		<link href="formannonce.css" rel="stylesheet" type="text/css">
		<link href="styles2.css" rel="stylesheet" type="text/css">		
		<title> VILLAGE AKHENAK</title>
</head>
<body>
<?php include("liens.php"); ?>
<nav class="admin">

</nav>
<div class="corps">
<?php 
try
{
// On se connecte à MySQL
$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
// En cas d'erreur, on affiche un message et on arrête tout
die('Erreur : '.$e->getMessage());
}
// Si tout va bien, on peut continuer
// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query("SELECT Idannonces, Titre,Contenu, DATE_FORMAT(Date, '%d/%m/%Y %Hh%imin') AS Date FROM annonces WHERE type LIKE 'appel' ORDER BY Idannonces DESC");
// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
?>
<section id="container">
<?php if(isset($_SESSION['admin'])){?>	
<span class="chyron"><em><a href="modifierannonces.php">&laquo; Modifier une annonce </a></em></span></br>
<span class="chyron"><em><a href="sup_annonce.php">&laquo; Supprimer une annonce </a></em></span>	
		<h3>Id:<?php echo $donnees['Idannonces'];?> </h3>
		<h3><?php echo $donnees['Date'];?></h3>
		<h2><?php echo $donnees['Titre'];?></h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">	
			<textarea name="message" id="message" placeholder="Enter a cool message..." tabindex="5" class="txtblock" cols="60"rows="30" disabled ><?php echo $donnees['Contenu'];?></textarea>
			</section>
		</div>
		</form>
		<?php }else{?>
		<h3><?php echo $donnees['Date'];?></h3>
		<h2><?php echo $donnees['Titre'];?></h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">	
			<textarea name="message" id="message" placeholder="Enter a cool message..." tabindex="5" class="txtblock" cols="60"rows="30" disabled ><?php echo $donnees['Contenu'];?></textarea>
			</section>
		</div>
		</form>
		
		
		
		
		
		<?php } ?>	
	</section>
<?php
}
$reponse->closeCursor();
?>		
</div>
<?php include("footer.php"); ?>
</body>
</html>