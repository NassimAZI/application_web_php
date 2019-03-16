<?php 
session_start(); 
if (isset($_SESSION['utilisateur']))
{
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<link href="style.css" rel="stylesheet" type="text/css">
		<link href="styles.css" rel="stylesheet" type="text/css">
		<link href="styles2.css" rel="stylesheet" type="text/css">
		<link href="forum.css" rel="stylesheet" type="text/css">		
		<title>MON VILLAGE</title>
</head>
<body>
<?php include("liens.php"); ?>
<nav class="admin">

</nav>
<div class="corps">
<section id="container">
		
		<h2>Ajouter une commande</h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
				<h3>Durée de la location</h3>
				<input type="number" name="dure" id="nom" placeholder="En jours" autocomplete="off" tabindex="2" class="txtinput">
			</section>
			<section id="aside" class="clearfix">
			</section>
			</div>
			<section id="buttons">
			<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Annuler">
			<input type="submit" name="envoie" id="submitbtn" class="submitbtn" tabindex="7" value="OK">
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
$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e-> getMessage());
}

if($_POST['dure']=='')
{
?>

<script type="text/javascript" > 
				 alert("Vous avez oublié un champs merci!"); 
                </script>
<?php   
}				
else
{
if($_POST['dure']>3)
	{
	?>
		<script type="text/javascript" > 
				 alert("Vous ne pouvez pas louer du materiel pour plus de 3 jours"); 
                </script>
	<?php
	}
	else{
	$donnee=intval($_POST['dure']);
	$idn_ut = $_SESSION['utilisateur'];
	$req2= $bdd->query("SELECT * FROM utilisateurs WHERE Identifiant LIKE '$idn_ut'");
	$res1= $req2->fetch();
	$id_ut=$res1['IdUtilisateur'];
	$req = $bdd->prepare('INSERT INTO commande (Date,Duree,IdUtilisateur) VALUES(now() ,? , ?)');
	$req-> execute(array($donnee, $id_ut));
	header('location:ajt_art_cmd.php');
	}
	}
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
