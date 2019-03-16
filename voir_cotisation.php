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
		<title> VILLAGE AKHENAK</title>
</head>

<body>
<?php include("liens.php"); ?>
<nav class="admin">
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
	width:250px;
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

</nav>
<div class="corps">
<table class="tab2"><tr>
<th class="tablistecomptes"><strong>Date de la cotisation</strong> </th>
<th class="tablistecomptes"><strong>Montant de la cotisation</strong></th> 
<th class="tablistecomptes"><p><strong>Effectué</strong></p></th>
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
$val=1;
$reponse = $bdd->query("SELECT * FROM ut_cot WHERE IdUtilisateur LIKE '$id_ut' AND EstConcerne LIKE '$val'");
// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
$id_cot=$donnees['IdCotisation'];
$req2= $bdd->query("SELECT * FROM cotisations WHERE idCotisation LIKE '$id_cot'");
$res1= $req2->fetch();
$date_cot=$res1['Date'];
$montant=$res1['Somme'];
?>
<table class="tab2"><tr>

<td class="tablistecomptes"><?php echo $date_cot; ?></td>
<td class="tablistecomptes"><?php echo $montant;?> </td> 
<td class="tablistecomptes"><?php if($donnees['Aeffectue']==1){echo 'Oui';}else{echo 'Non';}?></td>
</tr>
</table>
<?php
}
$reponse->closeCursor(); // Termine le traitement de la requête
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