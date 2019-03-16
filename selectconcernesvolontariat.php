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
		<h2>Selectionner les concernés</h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<h3>Age minimum</h3>	
			<input type="number" name="num_age" id="num_age" placeholder="Age minimum" Age minimum="off"  class="txtinput"required/>
			<h3>Age maximum</h3>	
			<input type="number" name="age_max" id="age_max" placeholder="Age maximum" Age maximum="off"  class="txtinput"required/>			
			</section>
			</div>
			<section id="buttons">
			<input type="submit" name="resetbtn" id="resetbtn" class="resetbtn" value="Annuler" >
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
			
		$respons=$bdd->query("SELECT * FROM volontariat ORDER BY DATE DESC");
		$rw = $respons->fetch();
		$id_vol=intval($rw['idVolontariat']);
		$valage=intval($_POST['num_age']);
		$valage_max=intval($_POST['age_max']);
		$numvol=intval($_POST['num']);
		$req7 = $bdd->query("SELECT * FROM volontariat WHERE IdVolontariat LIKE '$numvol'");
		$val=0;
		$req8 = $req7->fetch();
		$res = $req8['NbrPersonneRequise'];
		$date_vol=$req8['Date'];
		$numvol1=$numvol - 1;
		$req = $bdd->query("SELECT * FROM utilisateurs WHERE  (YEAR (now()) - YEAR(Date_de_naissance)) >= '$valage' AND YEAR(Date_de_naissance) - YEAR (now()) <= '$valage_max' AND Sexe LIKE 'Homme' ORDER BY NbrVolontariat" );
		$nbr_vol=intval($res);
		$val=1;
		$con=1;
		$texte='Vous etes concernes par le volontariat qui aura lieu le '.$date_vol.' Verifiez les annonces pour les détails'; 
		$idt2=1;
		while ($rece=$req->fetch() and $con <= $nbr_vol)
		{
					$recue= intval($rece['IdUtilisateur']);					
					$response1 = intval ($rece['NbrVolontariat']);
					$response1++;
					$req2 = $bdd->prepare("UPDATE utilisateurs SET NbrVolontariat = :val WHERE IdUtilisateur LIKE :recue ");
					$req2 -> execute(array('val'=>$response1,'recue' => $recue));
					$req11 = $bdd->prepare("UPDATE ut_vol SET Est_Concerne = :val WHERE IdUtilisateur LIKE :recue");
					$req11 -> execute(array('val'=>$val,'recue' => $recue));
					$req12 = $bdd->prepare('INSERT INTO messagerie (Date_message,Contenu,IdUtilisateur,Idrecepteur) VALUES(now() ,?,?,?) ');
					$req12-> execute(array($texte,$idt2,$recue));
					$con=$con+1;
		
		}
		header('location:admin.php');
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