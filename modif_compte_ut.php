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
		<link href="connexion.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" media="all" href="style.css">
		<title> VILLAGE AKHENAK</title>
</head>
<body>
<?php include("liens.php"); ?>
<nav class="admin">


</nav>
<div class="corps">
<?php
try
					{
					$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
					}
					catch(Exception $e)
					{
					die('Erreur : '.$e-> getMessage());
					}
$idn_ut=$_SESSION['utilisateur'];
$reponse = $bdd->query("SELECT * FROM utilisateurs WHERE Identifiant LIKE '$idn_ut' ");
while ($donnees = $reponse->fetch())
{
$no=$donnees['Nom'];
$pr=$donnees['Prenom'];
$dt=$donnees['Date_de_naissance'];
$id=$donnees['Identifiant'];
$mp=$donnees['Mot_de_passe'];
$sx=$donnees['Sexe'];
if($donnees['Sit_Fam']=='0')
{
$sf='Celibataire';
}else{
$sf='Marié';}
if($donnees['Sit_Pro']=='1')
{$sp='A un emploi';
}else{
$sp='N\'a pas d\'emploi';}
}
//$reponse->closeCursor();
?>
		<section id="container">
		<h2>Mon compte</h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<h3>Nom:</h3>
			<input type="text" name="nom" id="name" value="<?php echo htmlspecialchars($no);?>" autocomplete="off" tabindex="1" class="txtinput" disabled />
			<h3>Prenom:</h3>
			<input type="text" name="prenom" id="prenom" value="<?php echo htmlspecialchars($pr);?>" placeholder="PRENOM" autocomplete="off" tabindex="2" class="txtinput" disabled />
			<h3>Identifiant:</h3>
			<input type="text" name="identifiant" id="identifiant" value="<?php echo htmlspecialchars($id);?>" placeholder="IDENTIFIANT" autocomplete="off" tabindex="3" class="txtinput" disabled />
			<h3>Mot de passe:</h3>
			<input type="text" name="motdepasse" id="motdepasse" placeholder="MOT DE PASSE" autocomplete="off" tabindex="4" class="txtinput"  />
			<h3>Date de naissance:</h3>
			<input type="date" name="datenaissance" id="datenaissance" placeholder="aaaa/mm/jj" autocomplete="off" tabindex="5" class="txtinput"value="<?php echo $dt;?>" disabled />		
			</section>		
					<section id="aside" class="clearfix">
					<section id="prioritycase">
					<?php if ($sx=='Homme')
					{
					?>					
						<label for="choix"><h3>Sexe:</h3></label>
						<span class="radiobadge">
					 	<input type="radio" name="choix" value="hm" id="hm" checked="checked" disabled /> 
						<label for="hm">Homme</label>
						</span>
						<span class="radiobadge">
						<input type="radio" name="choix" value="fm" id="fm" disabled />
						<label for="fm">Femme</label>								
						</span>
					<?php
					} else 
					{
					?>
						<label for="choix"><h3>Sexe:</h3></label>
						<span class="radiobadge">
					 	<input type="radio" name="choix" value="hm" id="hm" disabled /> 
						<label for="hm">Homme</label> 
						</span>
						<span class="radiobadge">
						<input type="radio" name="choix" value="fm" id="fm" checked="checked" disabled />
						<label for="fm">Femme</label>								
						</span>
					<?php
					}
					?>
					</section>
					<section id="prioritycase">
					<?php
					if ($sf=='Celibataire')
					{
					?>			
						<label for="choice"><h3>Situation familliale:</h3></label>
						<span class="radiobadge">
						<input type="radio" name="choice" value="mr" id="mr" disabled /> 
						<label for="mr">Marié</label>
						</span>
						<span class="radiobadge">
						<input type="radio" name="choice" value="clb" id="clb" checked="checked" disabled />
						<label for="clb">Celibataire</label>		
						</span>
					<?php
					} else 
					{
					?>		
						<label for="choice"><h3>Situation familliale:</h3></label>
						<span class="radiobadge">
					 	<input type="radio" name="choice" value="mr" id="mr" checked="checked" disabled /> 
						<label for="mr">Marié</label> 
						</span>
						<span class="radiobadge">
						<input type="radio" name="choice" value="clb" id="clb" disabled />
						<label for="clb">Celibataire</label>
						</span>
					
					<?php
					}?>
					</section>
					<section id="prioritycase">
					<?php
					if ($sp=='A un emploi')
					{
					?>
						
						<label for="choic"><h3>Situation professionnelle:</h3></label>
						<span class="radiobadge">
					 	<input type="radio" name="choic" value="tr" id="tr" checked="checked" disabled /> 
						<label for="tr">A un emploi</label>
						</span>
						<span class="radiobadge">						
						<input type="radio" name="choic" value="trp" id="trp" disabled />
						<label for="trp">N'a pas d'emploi</label>	
						</span>
					<?php
					} else 
					{
					?>
					
						<label for="choic"><h3>Situation professionnelle:</h3></label>
						<span class="radiobadge">
					 	<input type="radio" name="choic" value="tr" id="tr" disabled /> 
						<label for="tr">A un emploi</label>
						</span>
						<span class="radiobadge">
						<input type="radio" name="choic" value="trp" id="trp" checked="checked" disabled />
						<label for="trp">N'a pas d'emploi</label>			
						<span class="radiobadge">
					<?php
					}
					?>
					</section>
					</section>
			</div>
			<section id="buttons">
			<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Annuler">
			<input type="submit" name="modifier" id="submitbtn" class="submitbtn" tabindex="7" value="Modifier">
			<br style="clear:both;">
		    </section>
		</form>
	</section>
</div>
<?php
if (isset($_POST['modifier']))
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
$idn_ut=$_SESSION['utilisateur'];
$reponse = $bdd->query("SELECT * FROM utilisateurs WHERE Identifiant LIKE '$idn_ut' ");
while ($donnees = $reponse->fetch())
{
$num=$donnees['IdUtilisateur'];
}
$mp2= $_POST['motdepasse'];	
$req = $bdd->prepare("UPDATE  utilisateurs   SET mot_de_passe= :mp WHERE Identifiant LIKE :num");
$req->execute(array('mp' => SHA1($mp2),'num'=>$_SESSION['utilisateur'])); 

?>
<script type="text/javascript" > 
		alert('Votre mot de passe a bien été modifier'); 		
 </script>
<?php

}

?>		
<?php include("footer.php"); ?>
</body>
</html>
<?php 
}else{
header('location:index.php');
}
?>