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
		<link href="connexion.css" rel="stylesheet" type="text/css">
		<title>VILLAGE AKHENAK</title>
</head>
<body>
<?php include("liens.php"); ?>
<nav class="admin">
<?php include("menu2.php"); ?>
</nav>
<div class="corps">
<form class="formnewcompte1" method="post" action="">
	<aside class="tab">
		<table class="tabnewcompte1">		
					<tr><td align="center" colspan="2"><legend><b><u>Suprimer un poste</u></b></legend></td></tr>
					<tr><td>	<label for="identifiant2">N°: du poste</label></td>
						<td>	<input type="text" name="identifiant2" id="identifiant2" /></td></tr>					
					<tr><td colspan="2" size="2em" align="center">    <input name="envoie2" type="submit" value="Supprmer"   /></td></tr>					
		</table>
	</aside>
</form>
<?php 
if (isset($_POST['envoie2']))
{
try
{
//on se connecte à notre base
$bdd = new PDO('mysql:host=localhost;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e-> getMessage());
}
$idnom=$_POST['identifiant2'];
function verification($nume){
				// Connexion SQL				
				$bdd = new PDO('mysql:host=localhost;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));				
				// Création de la requête SQL
				$num_sql = $nume ;
				$_SESSION['iddn']=$num_sql;
				$results=$bdd->query("SELECT count(*) as nbres FROM commentaire WHERE IdCommentaire LIKE '$num_sql'");				
				// Exécution de la requête SQL				
				$rows = $results->fetch();				
				if($rows['nbres'] == 1){
				return TRUE;
				}else{
				return FALSE;
				}
				}
	if	($idnom==''){?>
	<script type="text/javascript" > 
				 alert("champs vide! "); 
                </script>	
	<?php  }else
	{
	if (verification($idnom)==TRUE)
	{
	
$req = $bdd->prepare("DELETE FROM commentaire WHERE IdCommentaire LIKE :qt ");
$req->execute(array(
'qt' => $_POST['identifiant2']
));
echo "le poste a bien été supprimer";
}
else{  
?>
 <script type="text/javascript" > 
				 alert("cette identifiant n\'existe pas "); 
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