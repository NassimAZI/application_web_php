<?php 
session_start(); 
if (isset($_SESSION['utilisateur']) || isset($_SESSION['admin']))
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
if(isset($_SESSION['admin'])){
$idt=$_SESSION['admin'];
}else{
$idt=$_SESSION['utilisateur'];
}
$reponse2 = $bdd->query("SELECT * FROM Utilisateurs WHERE Identifiant LIKE '$idt' " );
while ($donnees2 = $reponse2->fetch())
{
$iden=$donnees2['IdUtilisateur'];
}
if(isset($_SESSION['utilisateur'])){
$reponse = $bdd->query("SELECT Idmessage ,Contenu ,IdUtilisateur, DATE_FORMAT(Date_message, 'Le  %d/%m/%Y Ã  %Hh %imin %ss') AS Date FROM messagerie WHERE (Idrecepteur LIKE '$iden')OR(Idrecepteur LIKE'0') ORDER BY Idmessage DESC");
}else{
$reponse = $bdd->query("SELECT Idmessage ,Contenu ,IdUtilisateur, DATE_FORMAT(Date_message, 'Le  %d/%m/%Y Ã  %Hh %imin %ss') AS Date FROM messagerie WHERE Idrecepteur LIKE '$iden' ORDER BY Idmessage DESC");
}
// On affiche chaque entrÃ©e une Ã  une
while ($donnees = $reponse->fetch())
{
$idt=$donnees['IdUtilisateur'];
{
$reponse2 = $bdd->query("SELECT * FROM Utilisateurs WHERE Idutilisateur LIKE '$idt'" );
while ($donnees2 = $reponse2->fetch())
{
$iden=$donnees2['Identifiant'];
}}
?>
<section id="container">
		<h3><span class="shyron"><?php echo $donnees['Date']; ?></span></h3>
		<h2>Envoyé par :<?php echo $iden;?>  </h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="" onsubmit="return connecter()" >
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<textarea disabled> <?php echo $donnees['Contenu'];?></textarea>
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