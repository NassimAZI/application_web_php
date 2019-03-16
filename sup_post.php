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
		<link href="connexion.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" media="all" href="style.css">
		<title>VILLAGE AKHENAK</title>
</head>
<body>
<?php include("liens.php"); ?>
<nav class="admin">

</nav>
<div class="corps">
<section id="container">
		
		<h2>Supprimer un post</h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<h3>N° du post à supprimer</h3>
			<input type="text" name="identifiant2" id="identifiant2" placeholder="Entrez l'identifiant" autocomplete="off" tabindex="1" class="txtinput">
			</section>		
		</div>
		<section id="buttons">
			<input type="submit" name="envoie2" id="submitbtn" class="submitbtn" tabindex="7" value="Supprimer">
			<br style="clear:both;">
		</section>
		</form>
	</section>
<?php 
if (isset($_POST['envoie2']))
{
try
{
//on se connecte à notre base
$bdd = new PDO('mysql:host=localhost;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e-> getMessage());
}
$idnom=$_POST['identifiant2'];
function verification($nume){
				// Connexion SQL				
				$bdd = new PDO('mysql:host=localhost;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));				
				// Création de la requête SQL
				$num_sql = $nume ;
				$_SESSION['iddn']=$num_sql;
				$results=$bdd->query("SELECT count(*) as nbres FROM commentaire WHERE IdCommentaire LIKE '$num_sql'");				
				// Exécution de la requête SQL				
				$rows = $results->fetch();				
				if($rows['nbres'] == 1){
				return TRUE;
				}else{
				return FALSE;
				}
				}
	if	($idnom==''){?>
	<script type="text/javascript" > 
				 alert("champs vide! "); 
                </script>	
	<?php  }else
	{
	if (verification($idnom)==TRUE)
	{
	
$req = $bdd->prepare("DELETE FROM commentaire WHERE IdCommentaire LIKE :qt ");
$req->execute(array(
'qt' => $_POST['identifiant2']
));
?>
 <script type="text/javascript" > 
				 alert("Le post a bien été supprimé "); 
                </script> 
<?php
}
else{  
?>
 <script type="text/javascript" > 
				 alert("cette identifiant n\'existe pas "); 
                </script> 
<?php } 
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