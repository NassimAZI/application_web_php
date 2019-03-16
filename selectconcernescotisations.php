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
		<link href="forum.css" rel="stylesheet" type="text/css">	
		<link rel="stylesheet" type="text/css" media="all" href="style.css">		
		<title> VILLAGE AKHENAK</title>
</head>
<body>
<?php include("liens.php"); ?>
<nav class="admin">

</nav>
<div class="corps">

<section id="container" class="clearfix">
		<h2>Selectionner les concernés </h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<h3>Age minimum</h3>	
			<input type="number" name="num_age" id="num_age" placeholder="Age minimum" Age minimum="off"  class="txtinput"required/>
			
			
</section>
			
			<section id="choi" class="clearfix">
					<h3>Quel est votre critere de selection ?</h3>
					<span class="radiobadge">
						<input type="radio" id="age" name="choi" value="age" checked="checked" >
						<label for="age">Par age</label>
					</span>
				
					<span class="checkbox">
						<input type="checkbox" id="trav" name="trav" value="trav" >
						<label for="trav">Les concernes ont un emploi</label>
					</span>
				
					<span class="checkbox">
						<input type="checkbox" id="mar" name="mar" value="mar">
						<label for="mar">Les concernes sont maries</label>
					</span>
					
				</section>
			</div>
			<section id="buttons">
			<input type="submit" name="envoi" id="submitbtn" class="submitbtn" value="Envoyer" >
			<br style="clear:both;">
		</section>
		</form>
</section>

<?php 
if (isset($_POST['envoi']))
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
			
	if (isset($_POST['mar']))
	{	
		if (isset($_POST['trav']))
		{
		$valage=intval($_POST['num_age']);
		$val=1;
		$req = $bdd->query("SELECT * FROM utilisateurs WHERE (YEAR (now()) - YEAR(Date_de_naissance)) >= '$valage' AND Sexe LIKE 'Homme' AND Sit_Fam LIKE '$val' AND Sit_Pro LIKE '$val'");
		}else
		{
		$valage=intval($_POST['num_age']);
		$val=1;
		$req = $bdd->query("SELECT * FROM utilisateurs WHERE (YEAR (now()) - YEAR(Date_de_naissance)) >= '$valage' AND Sexe LIKE 'Homme' AND Sit_Fam LIKE '$val' AND Sit_Pro NOT LIKE '$val'");
		}
	}
	else	
	{
		if (isset($_POST['trav']))
		{
		$valage=intval($_POST['num_age']);
		$val=1;
		$req = $bdd->query("SELECT * FROM utilisateurs WHERE (YEAR (now()) - YEAR(Date_de_naissance)) >= '$valage' AND Sexe LIKE 'Homme' AND Sit_Fam NOT LIKE '$val' AND Sit_Pro LIKE '$val'");
		}else
		{
		$valage=intval($_POST['num_age']);
		$val=1;
		$req = $bdd->query("SELECT * FROM utilisateurs WHERE (YEAR (now()) - YEAR(Date_de_naissance)) >= '$valage' AND Sexe LIKE 'Homme' AND Sit_Fam NOT LIKE '$val' AND Sit_Pro NOT LIKE '$val'");
		}
	}
	$respons=$bdd->query("SELECT * FROM cotisations ORDER BY DATE DESC");
	$rw = $respons->fetch();
	$id_cot=intval($rw['idCotisation']);
	$somme=intval($rw['Somme']);
	$date_cot=$rw['Date'];
	$valage=intval($_POST['num_age']);
	$val=1;
	$numcot=intval($id_cot);
	$texte='Vous etes concernes par la cotisation du '.$date_cot.' Et le montant est de'.$somme.'DA';
	$idt2=1;	
	while ($rece=$req->fetch())
		{
			$recue= $rece['IdUtilisateur'];
			$req2 = $bdd->prepare("UPDATE ut_cot SET EstConcerne = :val WHERE IdUtilisateur LIKE :recue AND IdCotisation LIKE :numcot");
			$req2 -> execute(array('val'=>$val,'recue' => $recue,'numcot' => $numcot,));
			$req12 = $bdd->prepare('INSERT INTO messagerie (Date_message,Contenu,IdUtilisateur,Idrecepteur) VALUES(now() ,?,?,?) ');
			$req12-> execute(array($texte,$idt2,$recue));
		}
		?>
			<script type="text/javascript" > 
	        alert("La cotisation a bien été ajouté"); 
            </script> 
		<?php
	
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