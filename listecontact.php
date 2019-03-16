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
		<link href="style.css" rel="stylesheet" type="text/css">
				<link rel="stylesheet" type="text/css" media="all" href="msg.css">
		<title> VILLAGE AKHENAK</title>
</head>
<body>
<?php
 include("liens.php"); ?>
<nav class="admin">


</nav>
<div class="corps">
<?php 
try
{
// On se connecte Ã  MySQL
$bdd = new PDO('mysql:host=localhost;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
// En cas d'erreur, on affiche un message et on arrÃªte tout
die('Erreur : '.$e->getMessage());
}
// Si tout va bien, on peut continuer
// On rÃ©cupÃ¨re tout le contenu de la table 
$reponse = $bdd->query("SELECT Idenc,Nom ,Prenom, DATE_FORMAT(date_mes,'Le  %d/%m/%Y à  %Hh %imin') AS Date,email,msg FROM contacter ORDER BY Idenc DESC");
// On affiche chaque entrÃ©e une Ã  une
while ($donnees = $reponse->fetch())
{
?>
<section id="container">
		<span class="chyron"><em><a href="sup_mes_contact.php">&laquo; supprimer le message</a></em></span>
		<h3><span class="shyron"><?php echo htmlspecialchars($donnees['Date']); ?></span></h3>
		<form name="hongkiat" id="hongkiat-form" method="post" action="" onsubmit="return connecter()" >
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<h3>ID message:</h3>
			<input type="text" name="nom" id="identifiant" value="<?php echo htmlspecialchars($donnees['Idenc']);?>" autocomplete="off" tabindex="1" class="txtinput" disabled />
			<h3>Nom:</h3>
			<input type="text" name="nom" id="name" value="<?php echo htmlspecialchars($donnees['Nom']);?>" autocomplete="off" tabindex="1" class="txtinput" disabled />
			<h3>Prenom:</h3>
			<input type="text" name="nom" id="name" value="<?php echo htmlspecialchars($donnees['Prenom']);?>" autocomplete="off" tabindex="1" class="txtinput" disabled />
			<h3>E-Mail:</h3>
			<input type="text" name="nom" id="email" value="<?php echo htmlspecialchars($donnees['email']);?>" autocomplete="off" tabindex="1" class="txtinput" disabled />			
			<textarea name="message" id="message" tabindex="5" class="txtblock" disabled> <?php echo htmlspecialchars($donnees['msg']);?></textarea>
			</section>
			
			
		</div>
		</form>
</section>
<?php
}
//$reponse->closeCursor(); // Termine le traitement de la requÃªte
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