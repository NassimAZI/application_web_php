<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<link href="styles.css" rel="stylesheet" type="text/css">
		<link href="styles2.css" rel="stylesheet" type="text/css">
		<link href="forum.css" rel="stylesheet" type="text/css">		
		<title>MON VILLAGE</title>
</head>
<body>
<?php include("liens.php"); ?>
<nav class="admin">
<?php include("menuutilisateur.php"); ?>
</nav>
<div class="corps">
<form class="formconnexion" method="post" action="">
	<aside class="tab">
		<table class="tabconnexion">		
					<tr><td align="center" colspan="2"><legend><b><u>louer UN ARTICLE</u></b></legend></td></tr>
					<tr><td>	<label for="nom">NOM DE L'ARTICLE</label></td>
						<td>	<input type="text" name="nom" id="nom" /></td></tr>						
					<tr><td>	<label for="nom">duree</label></td>
						<td>	<input type="text" name="dure" id="nom" /></td></tr>								
					<tr><td>	<label for="quantite">Quantite</label></td>
						<td>	<input type="number" name="quantite" id="quatite" /></td></tr>	
					<tr><td colspan="2" align="center">    <input name="envoie" type="submit" value="Louer" cols="30" rows="5"   /></td></tr>						
					
											
					
		</table>
	</aside>
</form>
<?php 
function verification($nume){
				// Connexion SQL
				$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				// Création de la requête SQL
				$num_sql =$nume;//$dbh->quote($nume) ;
				//$sql ="SELECT count(*) as nbres FROM enseignant "
				//. " WHERE num_ens=$num_sql AND pword=$pass_sql" ;
				$reponse=$bdd->query("SELECT count(*) as nbres FROM article WHERE NomArticle LIKE '$num_sql' ");
				// Exécution de la requête SQL
				//$results = $dbh->query($sql);
				$rows = $reponse->fetch();
				//$results = null ;
				if($rows == 1){
				
				return true;
				 
				}else{
				return false;
				}
				}
if (isset($_POST['envoie']))
{
//on se connecte à notre base
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

$donnee=$_POST['nom'];
$reponse=prepare("SELECT * FROM article WHERE IdArticle LIKE '$donnee' ",1);

if($reponse['QuantiteDisponible'] < $_POST['quantite'])
{
echo "Quantite indisponible dans le stock";
}
else
{
	if($_POST['dure']>3)
	{
	echo "délé trop eleve max 3 jours";
	}
	else
	{


	$qtotale=$reponse['QuantiteTotale']  ;
	$qdisponible=$reponse['QuantiteDisponible'] ;



	$qtotale=$qtotale-$_POST['quantite'];
	$qdisponible=$qdisponible-$_POST['quantite'];
	// la requete d'insertion
	$req = $bdd->prepare("UPDATE  article SET QuantiteDisponible = :qd WHERE IdArticle LIKE '$donnee' ");
	$req->execute(array(
	'qd' => $qdisponible
	));

	try
	{
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
	die('Erreur : '.$e-> getMessage());
	}

	 // la requete d'insertion
	 $req = $bdd->prepare('INSERT INTO commande (Date,Duree,IdUtilisateur,Idarticle) VALUES(now() ,? , ?, ?)');
	$req-> execute(array($_POST['dure'], $_SESSION['id'],$_POST['nom']));
	  

}

}

}
}
?>
</div>
<?php include("footer.php"); ?>
</body>
</html>
