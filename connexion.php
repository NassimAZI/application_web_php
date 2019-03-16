<?php 
session_start(); 
if (!isset($_SESSION['utilisateur']) && !isset($_SESSION['admin']))
{
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<link href="styles.css" rel="stylesheet" type="text/css">
		<link href="connexion.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" media="all" href="style.css">
        <link rel="stylesheet" type="text/css" media="all" href="responsive.css">
		<script  type="text/javascript" src="js/connect.js"></script>
		<title> VILLAGE AKHENAK</title>
</head>
<body>
<?php include("liens.php"); ?>
<div class="corps">
<?php
				function verification($nume,$pass){
				// Connexion SQL				
				$bdd = new PDO('mysql:host=localhost;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));				
				// Création de la requête SQL
				//$pass_sql = $pass;
				$pass=SHA1($pass);
				$results=$bdd->query("SELECT count(*) as nbres FROM utilisateurs WHERE Identifiant LIKE'$nume' AND Mot_de_passe LIKE'$pass'");				
				// Exécution de la requête SQL				
				$rows = $results->fetch();				
				if($rows['nbres'] == 1){
				return TRUE;
				}
				else{
				return FALSE;
				}
				}				
				//$num_sql = $nume ;
				if ( isset( $_POST['submit'] ) ) 				
				{
				// Initialisation de la session
				// Si on a reçu les données d’un formulaire :
				// On les récupère
				$numb = htmlspecialchars($_POST['name']) ;
				$motdepasse = htmlspecialchars($_POST['motdepass']) ;
				if (verification($numb,$motdepasse))
				{
				session_start();
				session_regenerate_id();
				$bdd = new PDO('mysql:host=localhost;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				$reponse = $bdd->query("SELECT IdUtilisateur FROM utilisateurs WHERE Identifiant LIKE '$numb'");
				while ($donnees2 = $reponse->fetch())
				{
				$iduti=$donnees2['IdUtilisateur'];
				}				
				if ($iduti!=1){
				// On sauvegarde donc son nom dans la session utilisateur
				$_SESSION['utilisateur'] = $numb ;	
				header('location:utilisateur.php');
				} else {
				// On sauvegarde donc son nom dans la session admin
				$_SESSION['admin'] =$numb;
				header('location:admin.php');
				}			
				} else 
				{
				?>
				 <script type="text/javascript" > 				 
				 alert('Mauvais identifiant ou mot de passe. merci!'); 				 
                </script>
				<?php
				}
				}			
				?>
		<section id="container">
		
		<h2>Connexion</h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="" onsubmit="return connecter()" >
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<input type="text" name="name" id="identifiant" placeholder="Votre Identifiant" autocomplete="off" tabindex="1" class="txtinput">
		
			<input type="password" name="motdepass" id="motdepasse" placeholder="Votre mot de passe" autocomplete="off" tabindex="2" class="txtinput">
			</section>			
		</div>
		<section id="buttons">
			<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Annuler">
			<input type="submit" name="submit" id="submitbtn" class="submitbtn" tabindex="7" value="Connexion">
			<br style="clear:both;">
		</section>
		</form>
	</section>
</div>
<?php include("footer.php"); ?>
</body>
</html>
<?php 
}
else {
if(isset($_SESSION['utilisateur']))
{
header('location:utilisateur.php');
}
if(isset($_SESSION['admin']))
{
header('location:admin.php');
}
}
 ?>