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
		
		<title> VILLAGE AKHENAK</title>
</head>

<body>
<?php include("liens.php"); ?>
<nav class="admin">
<?php include("menu2.php"); ?>
</nav>
<div class="corps">
<form class="formnewcompte1" method="post" action="">
	<aside class="tab">
		<table class="tabannonces2" >		
					<tr><td align="center" colspan="2"><legend><b><u>Liste Des Annonces</u></b></legend></td></tr>
					<tr><td>Type de l'Annonce </td><td><select name="choix">
						    <option value="appel">APPEL</option>
							<option value="fete">FETE</option>
							<option value="dece">DECES</option>
					</select></td></tr>					
					<tr><td colspan="2" size="2em" align="center">    <input name="envoie2" type="submit" value="ok"   /></td></tr>					
		</table>
	</aside>

	</form>
<?php 
if (isset($_POST['envoie2'])) 
{

if($_POST['choix']=="appel")
{
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
$reponse = $bdd->query("SELECT Idannonces, Titre,Contenu, DATE_FORMAT(Date, '%d/%m/%Y %Hh%imin') AS Date FROM annonces WHERE type LIKE 'appel'");
// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
?>

<table class="tabannonces" ><tr class="dd">
<td class="tablistearticle"><strong>Id: </strong><?php echo $donnees['Idannonces'];?></td>
<td class="tablistearticle"><strong>Date:  </strong><?php echo $donnees['Date'] ;?></td></tr>
<tr><td></td></tr>
<tr><td colspan="2" class="tablistearticle"><strong><H3>Titre:  </strong><?php echo $donnees['Titre'];?></H3></td></tr> 
<tr><td colspan="2" class="tablistearticle"><textarea type="text" name="contenu" id="contenu" cols="60"rows="30"  disabled ><?php echo $donnees['Contenu'];?></textarea></td></tr>
</table>
<?php
}
$reponse->closeCursor();
}
else
{
if($_POST['choix']=="fete")
{
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
$reponse = $bdd->query("SELECT Idannonces, Titre,Contenu, DATE_FORMAT(Date, '%d/%m/%Y %Hh%imin') AS Date FROM annonces WHERE Type LIKE 'fete'");
// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
?>
<table class="tabannonces" ><tr class="dd">
<td class="tablistearticle"><strong>Id: </strong><?php echo $donnees['Idannonces'];?></td>
<td class="tablistearticle"><strong>Date:  </strong><?php echo $donnees['Date'];?></td></tr>
<tr><td></td></tr>
<tr><td colspan="2" class="tablistearticle"><strong><H3>Titre:  </strong><?php echo $donnees['Titre'];?></H3></td></tr> 
<tr><td colspan="2" class="tablistearticle"><textarea type="text" name="contenu" id="contenu" cols="60"rows="30"  disabled ><?php echo $donnees['Contenu'];?></textarea></td></tr>
</table>

<?php
}
$reponse->closeCursor();
}
else{
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
$reponse = $bdd->query("SELECT Idannonces, Titre,Contenu, DATE_FORMAT(Date, '%d/%m/%Y %Hh%imin') AS Date FROM annonces WHERE type LIKE 'dece'");
// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
$contenu=$donnees['Contenu']

?>
<table class="tabannonces" ><tr class="dd">
<td class="tablistearticle"><strong>Id: </strong><?php echo $donnees['Idannonces'];?></td>
<td class="tablistearticle"><strong>Date:  </strong><?php echo $donnees['Date'];?></td></tr>
<tr><td></td></tr>
<tr><td colspan="2" class="tablistearticle"><strong><H3>Titre:  </strong><?php echo $donnees['Titre'];?></H3></td></tr> 
<tr><td colspan="2" class="tablistearticle"><textarea type="text" name="contenu" id="contenu" cols="60"rows="30"  disabled ><?php echo $donnees['Contenu'];?></textarea></td></tr>
</table>

<?php
}$reponse->closeCursor();
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