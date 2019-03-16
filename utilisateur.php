<?php 
session_start(); 
if (isset($_SESSION['utilisateur']))

{

?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<link href="styles.css" rel="stylesheet" type="text/css">
		<link href="styles2.css" rel="stylesheet" type="text/css">
		
		<title> VILLAGE AKHENAK</title>
</head>
<?php 
 $numb=$_SESSION['utilisateur'];
$bdd = new PDO('mysql:host=localhost;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				$reponse = $bdd->query("SELECT Nom,Prenom FROM utilisateurs WHERE Identifiant LIKE '$numb'");
				while ($donnees2 = $reponse->fetch())
				{
				$nom=$donnees2['Nom'];
				$prenom=$donnees2['Prenom'];
				}
 ?>
<body>
<?php include("liens.php"); ?>

<nav class="admin">

</nav>

<div class="corps">
<div class="content">
	<h1><P>Bienvenue <?php echo $nom ,'    ',  $prenom;?> sur votre page d'utilisateur</P></h1>
</div>
<?php include("imagebouge.php"); ?>

		
</div>
<?php include("footer.php"); ?>
</body>
</html>
<?php 
}else{
header('location:index.php');

}
?>