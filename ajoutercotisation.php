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
		<h2>Ajouter une cotisation</h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<h3>Date de la cotisation</h3>
			<input type="date" name="dat" id="date" placeholder="aaaa-mm-jj" Date de la cotisation="off"  class="txtinput class="txtinput">
			<h3>Somme</h3>
			<input type="number" name="somme" id="somme" placeholder=" somme" somme="off"  class="txtinput class="txtinput"  required>
			</section>		
			</div>
			<section id="buttons">
			<input type="submit" name="envoie" id="submitbtn" class="submitbtn" value="Envoyer" >
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

 // la requete d'ajout de la cotisation
$req = $bdd->prepare('INSERT INTO cotisations (Date, Somme) VALUES(?,?)');
$req-> execute(array($_POST['dat'], $_POST['somme']));
// recuperation de l'id cotisation qu'on vient de creer à l'aide de la date
$datte = $_POST['dat'];
$reqw = $bdd->query("SELECT * FROM cotisations WHERE Date = '$datte'");
$rece= $reqw->fetch();
$recue= $rece['idCotisation'];
// selectionner tout les utilisateurs
$requ = $bdd->query("SELECT * FROM utilisateurs WHERE Sexe LIKE 'Homme' AND IdUtilisateur NOT LIKE '1'");
// ajouter la nouvelle cotisation a la table ut_cot (EstConcerne et Aeffectue prennet la valeur de 0 par default 
while ($donnees = $requ->fetch())
{
$num=intval($donnees['IdUtilisateur']);
$req2 = $bdd->prepare("INSERT INTO ut_cot (IdUtilisateur, IdCotisation) VALUES (?,?)");
$req2 -> execute(array($num, $recue));
}
header('location:selectconcernescotisations.php');
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