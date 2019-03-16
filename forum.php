<?php 
session_start();
?> 
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<link href="styles.css" rel="stylesheet" type="text/css">
		<link href="styles2.css" rel="stylesheet" type="text/css">
		<link href="style.css" rel="stylesheet" type="text/css">
		<link href="forannonce.css" rel="stylesheet" type="text/css">
		
		<title> VILLAGE AKHENAK</title>
</head>

<body>
<?php include("liens.php"); ?>
<nav class="admin">

</nav>

<div class="corps">
<h2>Forum</h2>
<?php 
//session_start(); 
if (isset($_SESSION['utilisateur']) || isset($_SESSION['admin']))
{
?>
<section id="container">
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<h3>Message</h3>
			<textarea name="message" id="message"  tabindex="5" class="txtblock"></textarea>		
			</section>		
					
			</div>
			<section id="buttons">
			<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Annuler">
			<input type="submit" name="envoie" id="submitbtn" class="submitbtn" tabindex="7" value="Envoyer">
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
die('Erreur : '.$e-> getMessage());
}
if($_POST['message']!="")
 {
 // la requete d'insertion
  
if (isset($_SESSION['utilisateur']))
{
$identi=$_SESSION['utilisateur'];
$reponse = $bdd->query("SELECT IdUtilisateur FROM utilisateurs WHERE Identifiant LIKE '$identi'");
while ($donnees = $reponse->fetch())
{
$idt2=$donnees['IdUtilisateur'];
}
}
else {
$identi=$_SESSION['admin'];
$reponse = $bdd->query("SELECT IdUtilisateur FROM utilisateurs WHERE Identifiant LIKE '$identi'");
while ($donnees = $reponse->fetch())
{
$idt2=$donnees['IdUtilisateur'];
}
}
$req = $bdd->prepare('INSERT INTO commentaire (date,contenu,IdUtilisateur) VALUES(now() ,? , ?)');
$req-> execute(array($_POST['message'],$idt2));
 //$req = $bdd->prepare('INSERT INTO commentaire (date,contenu,IdUtilisateur) VALUES(now() ,? , ?)');
//$req-> execute(array($_POST['message'],$idt2));
 }
else
 {
 ?>
 <script type="text/javascript" > 
		alert('champs vide'); 
 </script>
<?php }
 }
 }
try
{
// On se connecte à MySQL
$bdd = new PDO('mysql:host=localhost;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
// En cas d'erreur, on affiche un message et on arrête tout
die('Erreur : '.$e->getMessage());
}
// Si tout va bien, on peut continuer
// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query("SELECT IdCommentaire ,Contenu ,IdUtilisateur, DATE_FORMAT(Date, 'Le  %d/%m/%Y à %Hh %imin %ss') AS Date FROM commentaire ORDER BY Date DESC");
// On affiche chaque entrée une à une

while ($donnees = $reponse->fetch())
{
	$id_ut=$donnees['IdUtilisateur'];
	$req2= $bdd->query("SELECT * FROM utilisateurs WHERE IdUtilisateur LIKE '$id_ut'");
	$res1= $req2->fetch();
	$idn_ut=$res1['Identifiant'];
?>

<section id="container">
<?php if(isset($_SESSION['admin'])){
?>	
<span class="chyron"><em><a href="sup_post.php">&laquo; Supprimer un POST </a></em></span></br>
		<h3>Id:<?php echo $donnees['IdCommentaire'];?> </h3>
		<h3><?php echo $donnees['Date'];?></h3>
		<h2>poster par : <?php echo $idn_ut;?></h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">	
			<textarea name="message" id="message" placeholder="Enter a cool message..." tabindex="5" class="txtblock" cols="60"rows="30" disabled ><?php echo $donnees['Contenu'];?></textarea>
			</section>
		</div>
		</form>
		<?php }else{?>
		<h3><?php echo $donnees['Date'];?></h3>
		<h2>poster par : <b> <?php echo $idn_ut;?></b></h2>
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
