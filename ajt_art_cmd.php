<?php 
session_start(); 
if (isset($_SESSION['utilisateur']))
{
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<link href="style.css" rel="stylesheet" type="text/css">
		<link href="styles.css" rel="stylesheet" type="text/css">
		<link href="styles2.css" rel="stylesheet" type="text/css">
		<link href="forum.css" rel="stylesheet" type="text/css">		
		<title>MON VILLAGE</title>
</head>
<body>
<?php include("liens.php"); ?>
<nav class="admin">

</nav>
<div class="corps">


<section id="container">
		<h3>Ajouter un article ou valider votre commande</h3>
		<span class="chyron"><em><a href="vld_cmd.php">VALIDER</a></em></span>
		<h2>AJOUTER UN ARTICLE</h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
				<?php
					try
					{
					$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
					}
					catch(Exception $e)
					{
					die('Erreur : '.$e-> getMessage());
					}
					$idn_ut = $_SESSION['utilisateur'];
					$req2= $bdd->query("SELECT * FROM utilisateurs WHERE Identifiant LIKE '$idn_ut'");
					$res1= $req2->fetch();
					$id_ut=$res1['IdUtilisateur'];
					$respons=$bdd->query("SELECT * FROM commande WHERE IdUtilisateur LIKE '$id_ut' ORDER BY DATE DESC");
					$rw = $respons->fetch();
					$id_cmnd=intval($rw['IdCommande']);
				?>	<h3>Numéro de la commande</h3>	
					<input type="number" name="num" id="num" placeholder="Ne pas modifier" autocomplete="off" value="<?php echo $id_cmnd;?>"tabindex="1" class="txtinput">
					<h3>Nom de l'article</h3>
					<input type="text" name="nom" id="nom" placeholder="Le nom de l'article" autocomplete="off" tabindex="2" class="txtinput">
					<h3>Quantité</h3>
					<input type="number" name="quantite" id="quantite" placeholder="Quantité" autocomplete="off" tabindex="3" class="txtinput">
			</section>
			<section id="aside" class="clearfix">
			</section>
			</div>
			<section id="buttons">
			<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Annuler">
			<input type="submit" name="envoie" id="submitbtn" class="submitbtn" tabindex="7" value="Ajouter">
			<br style="clear:both;">
			</section>
		</form>
	</section>
<?php
function verification($nume,$id){
				// Connexion SQL
				$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				// Création de la requête SQL
				$num_sql =$nume;
				$num_sql1 =$id;
				$reponse=$bdd->query("SELECT count(*) as nbres FROM lignedecommandes WHERE IdCommande LIKE '$num_sql1' AND IdArticle LIKE '$num_sql'");
				$rows = $reponse->fetch();
				if($rows['nbres'] == 0){
				
				return false;
				 
				}else{
				return true;
				}
				}
if (isset($_POST['envoie']))
{//on se connecte à notre base
try
{
$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e-> getMessage());
}
if(($_POST['nom']=='')or($_POST['quantite']=='')){
?>
<script type="text/javascript" > 
				 alert("vous avez oublié un champs. merci!"); 
                </script>
<?php   }				
else{
$id_cmd=intval($_POST['num']);
$response=$bdd->query("SELECT * FROM commande WHERE IdCommande LIKE '$id_cmd' ");
$row = $response->fetch();
$cmd_val=intval($row['Valide']);
if ($cmd_val==1)
{
?>
<script type="text/javascript" > 
				 alert("Vous ne pouvez plus ajouter d'article à cette commande!"); 
                </script>
<?php
}else{

$id_cmd=intval($_POST['num']);
$donnee=$_POST['nom'];
$qdemande=$_POST['quantite'];
$reponse1=$bdd->query("SELECT * FROM article WHERE NomArticle LIKE '$donnee' ");
$reponse= $reponse1->fetch();
$id_art=intval($reponse['IdArticle']);
if(verification($id_art,$id_cmd))	
{
?>

<script type="text/javascript" > 
				 alert("Vous avez déja ajouté cet article"); 
                </script>
<?php
}else
	{
if(intval($reponse['QuantiteDisponible']) < intval($_POST['quantite']))
{
echo "Quantite indisponible dans le stock";
}
else
{
	$qtotale=$reponse['QuantiteTotale'];
	$qdisponible=$reponse['QuantiteDisponible'] ;
	$qdisponible1=intval($qdisponible)- intval($qdemande);
	// la requete d'insertion
	$req = $bdd->prepare("UPDATE  article SET QuantiteDisponible = :qd WHERE IdArticle LIKE '$id_art' ");
	$req->execute(array('qd' => $qdisponible1));

	try
	{
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
	die('Erreur : '.$e-> getMessage());
	}

	 // la requete d'insertion
	
	$req = $bdd->prepare('INSERT INTO lignedecommandes (Quantite, IdCommande, IdArticle) VALUES(? , ?, ?)');
	$req-> execute(array($_POST['quantite'],$id_cmd,$id_art));
	?>
	<section id="aside" class="clearfix">
	<h3>Vous pouvez ajouter un nouvel article à la commande</h3>
	<h3>Ou VALIDER votre commande en cliquant sur ce lien</h3>
	
	</section>
	<?php
}
}
}
}
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
