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
		
		<h2>Ajouter un article</h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<h3>Nom de l'article</h3>
			<input type="text" name="nom" id="nom" placeholder="Entrez le nom de l'article" autocomplete="off" tabindex="1" class="txtinput"/>
			<h3>La quantité</h3>
			<input type="number" name="Quantite" id="Quantite" placeholder="Entrez la quantité" autocomplete="off" tabindex="1" class="txtinput"/>
			</section>		
		</div>
		<section id="buttons">
			<input type="submit" name="envoie" id="submitbtn" class="submitbtn" tabindex="7" value="Ajouter">
			<br style="clear:both;">
		</section>
		</form>
</section>

<?php
function verification($nume){
				// Connexion SQL				
				$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));				
				// Création de la requête SQL
				$num_sql = $nume ;
				$results=$bdd->query("SELECT count(*) as nbres FROM article WHERE NomArticle LIKE '$num_sql'");				
				// Exécution de la requête SQL				
				$rows = $results->fetch();				
				if($rows['nbres'] == 1){
				return TRUE;
				}else{
				return FALSE;
				}
				}
				
if (isset($_POST['envoie']))
{
//on se connecte à notre base
try
{
$bdd = new PDO('mysql:host=localhost;dbname=gestionvillage', 'root', '');
}
catch(Exception $e)
{
die('Erreur : '.$e-> getMessage());
}

if (verification($_POST['nom']))
{
?>
 <script type="text/javascript" > 
				 alert("Cet article existe déja"); 
                </script> 
<?php
}else
{
 // la requete d'insertion
 $req = $bdd->prepare('INSERT INTO article (NomArticle,QuantiteTotale,QuantiteDisponible) VALUES(?, ?, ?)');
$req-> execute(array($_POST['nom'], $_POST['Quantite'],$_POST['Quantite']));
 
?>
 <script type="text/javascript" > 
				 alert("L'article a bien été ajouté"); 
                </script> 
<?php 
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