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
		<h2>Modifier un article</h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<h3>Nom de l'article</h3>
			<input type="text" name="nom" id="nom" placeholder="Entrez le nom"  autocomplete="off"  class="txtinput"/>
			<h3>Quantite</h3>	
			<input type="number" name="quantite" id="quantite" placeholder="Entrez la quantite" autocomplete="off"  class="txtinput"required/>
			
			
</section>
			
			<section id="choi" class="clearfix">
					<h3>Quel voulez-vous faire</h3>
					<span class="radiobadge">
						<input type="radio" id="augmenter" name="choi" value="augmenter" checked="checked" >
						<label for="augmenter">Augmenter</label>
					</span>
				
					<span class="radiobadge">
						<input type="radio" id="diminuer" name="choi" value="diminuer" >
						<label for="diminuer">Diminuer</label>
					</span>
					
				</section>
			</div>
			<section id="buttons">
			<input type="submit" name="envoie" id="submitbtn" class="submitbtn" value="Modifier" >
			<br style="clear:both;">
		</section>
		</form>
</section>

<?php 
				function verification($nume){
				// Connexion SQL				
				$bdd = new PDO('mysql:host=localhost;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));				
				// Création de la requête SQL
				$num_sql = $nume ;
				$results=$bdd->query("SELECT count(*) as nbres FROM article WHERE NomArticle LIKE'$num_sql'");				
				// Exécution de la requête SQL				
				$rows = $results->fetch();				
				if($rows['nbres'] == 1){
				return TRUE;
				}else{
				return FALSE;
				}
				}
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

if(($_POST['nom']=='')or($_POST['choi']=="null")or($_POST['quantite']=='')){
?>

<script type="text/javascript" > 
				 alert("vous avez oublié un champs. merci!"); 
                </script>
<?php   }				
else{
$dd=$_POST['choi'];
$donnee=$_POST['nom'];
if (verification ($donnee) =='TRUE')
{
$reponse=$bdd->query("SELECT QuantiteTotale , QuantiteDisponible FROM article WHERE NomArticle LIKE '$donnee' ");

if($dd=="augmenter" )
{
while ($donnees = $reponse->fetch())
{
$qtotale=$donnees['QuantiteTotale']  ;
$qdisponible=$donnees['QuantiteDisponible'] ;
}
$qtotale=$qtotale+$_POST['quantite'];
$qdisponible=$qdisponible+$_POST['quantite'];
// la requete d'insertion
$req = $bdd->prepare("UPDATE  article SET QuantiteTotale = :qt,QuantiteDisponible = :qd WHERE NomArticle LIKE '$donnee'");
$req->execute(array(
'qt' => $qtotale,
'qd' => $qdisponible,
));
?>
 <script type="text/javascript" > 
				 alert("L'article a bien été modifié "); 
                </script> 
<?php
}
else{
while ($donnees = $reponse->fetch())
{
$qtotale=$donnees['QuantiteTotale']  ;
$qdisponible=$donnees['QuantiteDisponible'] ;
}

$qtotale=$qtotale-$_POST['quantite'];
$qdisponible=$qdisponible-$_POST['quantite'];
// la requete d'insertion
$req = $bdd->prepare("UPDATE  article SET QuantiteTotale = :qt,QuantiteDisponible = :qd WHERE NomArticle LIKE '$donnee' ");
$req->execute(array(
'qt' => $qtotale,
'qd' => $qdisponible,
));
?>
 <script type="text/javascript" > 
				 alert("L'article a bien été modifié "); 
                </script> 
<?php
}

$reponse->closeCursor();
}
else{
?>

<script type="text/javascript" > 
		alert('cette article n\'existe pas '); 
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