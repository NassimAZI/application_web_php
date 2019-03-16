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
		<link href="contact.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" media="all" href="style.css">
		<title> VILLAGE AKHENAK</title>
</head>

<body>
<?php include("liens.php"); ?>
<nav class="admin">
</nav>
<div class="corps">

<section id="container">
		<h2>Entrer les personnes qui ont effecuté leur cotisation</h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<h3>Date de la cotisation</h3>
			<input type="date" name="dat" id="dat" placeholder="aaaa-mm-jj" autocomplete="off"  class="txtinput class="txtinput">
			<h3>Identifiant de la personne qui a effectué cette cotisation</h3>
			<input type="text" name="iden" id="name" placeholder="Identifiant" autocomplete="off"  class="txtinput class="txtinput"  required>
			</section>		
		</div>
			<section id="buttons">
			<input type="submit" name="envoie" id="resetbtn" class="resetbtn" value="Envoyer" >
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
die('Erreur :   ?>
			<script type="text/javascript" > 
				 alert("vous avez oublié un champs. merci!"); 
                </script>
	<?php ');
}

// recuperation de l'id cotisation qu'on vient de creer à l'aide de la date
$datte = $_POST['dat'];
$reqw = $bdd->query("SELECT * FROM cotisations WHERE Date LIKE '$datte'");
$rece= $reqw->fetch();
$recue= $rece['idCotisation'];
// recuperer l'id de l'ut à l'aide de l'identifiant
$idn_ut=$_POST['iden'];
$reponse = $bdd->query("SELECT * FROM utilisateurs WHERE Identifiant LIKE '$idn_ut' ");
$donnees = $reponse->fetch();
$id_ut = $donnees['IdUtilisateur'];
// Modifier Aeffectue dans la table ut_cot pour l'utilisateur 
$val=1;
$req2 = $bdd->prepare("UPDATE ut_cot SET Aeffectue = :val WHERE IdUtilisateur LIKE :id_ut AND IdCotisation LIKE :id_cot");
$req2 -> execute(array('val'=>$val,'id_ut'=>$id_ut,'id_cot'=>$recue));

?>
			<script type="text/javascript" > 
				 alert("Votre requete a été enregistré!"); 
                </script>
<?php
}
?>		
</div>
<?php include("footer.php"); ?>
</body>
</html>
<?php 
}
else {
header('location:index.php');
}
 ?>