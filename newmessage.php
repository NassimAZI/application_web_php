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
		<link rel="stylesheet" type="text/css" media="all" href="style.css">		
		<title> VILLAGE AKHENAK</title>
</head>
<body>
<?php include("liens.php");?>
<nav class="admin">

</nav>
<div class="corps">
		<section id="container">
		
		<h2>Nouveau Message</h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="" onsubmit="return connecter()" >
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<label for="nam" >
			<?php if(isset($_SESSION['utilisateur'])){  try
													{
											$bdd = new PDO('mysql:host=localhost;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
											}
											catch(Exception $e)
											{
											die('Erreur : '.$e-> getMessage());
											}
											$reponse = $bdd->query("SELECT Identifiant FROM utilisateurs WHERE IdUtilisateur LIKE '1'");
					                         while ($donnees = $reponse->fetch())
											{
											$identifiant=$donnees['Identifiant'];
											}
											echo "Tapez \"$identifiant\"pour l'envoyer Ã  l'administrateur "					
																
											;}?></label>
			<input type="text" name="nam" id="name" placeholder="To: Saisissez l'Identifiant" autocomplete="off" tabindex="1" class="txtinput">
			<textarea type="text" name="messag" id="message" placeholder="Saisir votre message ICI" autocomplete="off" tabindex="4" class="txtblock"></textarea>
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
function verification($nume){
				// Connexion SQL				
				$bdd = new PDO('mysql:host=localhost;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));				
				// CrÃ©ation de la requÃªte SQL
				$num_sql = $nume ;
				$_SESSION['iddn']=$num_sql;
				$results=$bdd->query("SELECT count(*) as nbres FROM utilisateurs WHERE Identifiant LIKE'$num_sql'");				
				// ExÃ©cution de la requÃªte SQL				
				$rows = $results->fetch();				
				if($rows['nbres'] == 1){
				return TRUE;
				}else{
				return FALSE;
				}
				}
if (isset($_POST['envoie']))
{
//on se connecte Ã  notre base
try
{
$bdd = new PDO('mysql:host=localhost;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e-> getMessage());
}
if($_POST['messag']!="" and $_POST['nam']!="")
 {
 $iden= $_POST['nam'];
 if (verification($iden)==true){
 
 
 // la requete d'insertion
 
 $reponse = $bdd->query("SELECT IdUtilisateur FROM utilisateurs WHERE Identifiant LIKE '$iden'");
 while ($donnees = $reponse->fetch())
{
$idrecepteur=$donnees['IdUtilisateur'];
} 
if (isset($_SESSION['utilisateur']))
{
$identi=$_SESSION['utilisateur'];
$reponse = $bdd->query("SELECT IdUtilisateur FROM utilisateurs WHERE Identifiant LIKE '$identi'");
while ($donnees = $reponse->fetch())
{
$idt2=$donnees['IdUtilisateur'];
}
}else{
$identi=$_SESSION['admin'];
$reponse = $bdd->query("SELECT IdUtilisateur FROM utilisateurs WHERE Identifiant LIKE '$identi'");
while ($donnees = $reponse->fetch())
{
$idt2=$donnees['IdUtilisateur'];
}
}
if($idt2!=$idrecepteur){
$req = $bdd->prepare('INSERT INTO messagerie (Date_message,Contenu,IdUtilisateur,Idrecepteur) VALUES(now() ,? ,?,?) ');
$req-> execute(array($_POST['messag'],$idt2,$idrecepteur));
echo "<script type='text/javascript' > 
		alert('Vous avez envoyÃ© un message'); 
 </script>";
}else
{
?>
 <script type="text/javascript" > 
 alert('vous ne pouvait pas envoyer un message a vous mÃªme! '); 
 </script>
 <?php
}
}
else{ if($iden=='0'){
 if (isset($_SESSION['admin'])){
$identi=$_SESSION['admin'];
$reponse = $bdd->query("SELECT IdUtilisateur FROM utilisateurs WHERE Identifiant LIKE '$identi'");
while ($donnees = $reponse->fetch())
{
$idt2=$donnees['IdUtilisateur'];
}
$idrecepteur='0';
$req = $bdd->prepare('INSERT INTO messagerie (Date_message,Contenu,IdUtilisateur,Idrecepteur) VALUES(now() ,? ,?,?) ');
$req-> execute(array($_POST['messag'],$idt2,$idrecepteur));
}else
{
?>
<script type="text/javascript" > 
		alert('cette identifiant n\'existe pas'); 
</script> 
<?php
}

}else{
?>
<script type="text/javascript" > 
		alert('cette identifiant n\'existe pas'); 
</script> 
<?php
}
}
}  
else
 {
 ?>
 <script type="text/javascript" > 
		alert('champs vide'); 
 </script>
<?php }
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