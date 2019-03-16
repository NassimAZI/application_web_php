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
<style>
.tab2{ 
margin:auto;
    font-family: Arial (Corps CS);
    font-size: 18px;
    font-style: normal;
    font-weight: normal;
    letter-spacing: -1px;
    line-height: 1.2em;
    border-collapse:collapse;
    text-align:center;
}
.tab2  th, .tab2  td{
    padding:20px 10px 40px 10px;
    color:#fff;
	width:170px;
    font-size: 15px;
    background-color:#222;
    font-weight:normal;
    border-right:1px dotted #666;
    border-top:3px solid #666;
    -moz-box-shadow:0px -1px 4px #000;
    -webkit-box-shadow:0px -1px 4px #000;
    box-shadow:0px -1px 4px #000;
    text-shadow:0px 0px 1px #fff;
    text-shadow:1px 1px 1px #000;
}
.tab2  th{
    padding:10px;
    font-size:18px;
    text-transform:uppercase;
    color:#888;
}
.tab2 td{
    padding:10px;
    background-color:#f0f0f0;
    border-right:1px dotted #999;
    text-shadow:-1px 1px 1px #fff;
    text-transform:uppercase;
    color:#333;
}
</style>
<div class="corps">
<table class="tab2"><tr>
<th class="tablistecomptes"><strong>IdCommande</strong> </th>
<th class="tablistecomptes"><strong>Identifiant de l'utilisateur</strong></th> 
<th class="tablistecomptes"><strong>Duree de la location</strong></th>
</tr>
</table>
<?php
function verification($id){
				// Connexion SQL
				$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				// Création de la requête SQL
				$num_sql =$id;
				$reponse=$bdd->query("SELECT count(*) as nbres FROM lignedecommandes WHERE IdCommande LIKE '$num_sql'");
				$rows = $reponse->fetch();
				if($rows['nbres'] == 0){
				
				return true;
				 
				}else{
				return false;
				}
				}


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
					$duree=intval($rw['Duree']);
					?>
<table class="tab2"><tr>
<td class="tablistecomptes"><?php echo $id_cmnd; ?></td>
<td class="tablistecomptes"><?php echo $idn_ut;?> </td>
<td class="tablistecomptes"><?php echo $duree;?></td>
</tr>
</table>

<table class="tab2"><tr>
<th ><strong>Id de la ligne de commande</strong> </th>
<th ><strong>Nom de l'Article</strong> </th>
<th ><strong>Quantite</strong></th> 
</tr>
</table>

<?php
try
{
// On se connecte à MySQL
$bdd = new PDO('mysql:host=localhost;dbname=gestionvillage', 'root', '');
}
catch(Exception $e)
{
// En cas d'erreur, on affiche un message et on arrête tout
die('Erreur : '.$e->getMessage());
}
// Si tout va bien, on peut continuer

					$idn_ut = $_SESSION['utilisateur'];
					$req2= $bdd->query("SELECT * FROM utilisateurs WHERE Identifiant LIKE '$idn_ut'");
					$res1= $req2->fetch();
					$id_ut=$res1['IdUtilisateur'];
					$respons=$bdd->query("SELECT * FROM commande WHERE IdUtilisateur LIKE '$id_ut' ORDER BY DATE DESC");
					$rw = $respons->fetch();
					$id_cmnd=intval($rw['IdCommande']);
					$reponse = $bdd->query("SELECT * FROM lignedecommandes WHERE IdCommande LIKE '$id_cmnd'");
// On affiche chaque entrée une à une
while ($donnee = $reponse->fetch())
{
					$id_art=intval($donnee['IdArticle']);
					$req3= $bdd->query("SELECT * FROM article WHERE IdArticle LIKE '$id_art'");
					$res2= $req3->fetch();
					$idn_art=$res2['NomArticle'];

?>
<table class="tab2"><tr>
<td><?php echo $donnee['IdLigne'];?></td>
<td ><?php echo $idn_art;?></td>
<td ><?php echo $donnee['Quantite'];?></td>
</tr>
</table>
<?php 
}
?>
<style>
</style>
<section id="container">
		<h3>Ajouter un article ou valider votre commande</h3>
		<form name="hongkiat" id="hongkiat-form" method="post" action="">
		<section id="buttons">	
			<input type="submit" name="envoi" id="submitbtn" class="submitbtn" tabindex="7" value="Ajouter">
			<input type="submit" name="envoie" id="submitbtn" class="submitbtn" tabindex="7" value="Valider">
			<br style="clear:both;">
		</section>
		</form>
</section>
<?php
if (isset($_POST['envoi']))
{
header('location:ajt_art_cmd.php');
}
if (isset($_POST['envoie']))
{
if (verification($id_cmnd))
{
?>
				<script type="text/javascript" > 
				 alert("Vous ne pouvez pas valider cette commande"); 
                </script>	
<?php
}else
{
$vd=1;
$req = $bdd->prepare("UPDATE  commande   SET valide = :vd  WHERE IdCommande LIKE :id_cmnd");
$req->execute(array('vd' => $vd,'id_cmnd' => $id_cmnd));
header('location:ex.php');
}
}
?>
</div>
<?php include("footer.php"); ?>
</body>
</html>
<?php
}else
{
header('location:index.php');
}
?>
