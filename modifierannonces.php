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
		<link href="formannonce.css" rel="stylesheet" type="text/css">
		<title> VILLAGE AKHENAK</title>
</head>
<body>
<?php include("liens.php"); ?>
<nav class="admin">

</nav>
<div class="corps">
<section id="container">
		
		<h2>Modifier une annonce</h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<input type="text" name="identifiant2" id="name" placeholder="Entrez l'Id de l'annonce" autocomplete="off" tabindex="1" class="txtinput">
			</section>		
		</div>
		<section id="buttons">
			<input type="submit" name="envoie2" id="submitbtn" class="submitbtn" tabindex="7" value="OK">
			<br style="clear:both;">
		</section>
		</form>
	</section>
	

<?php$_IDNOM=$_POST['identifiant2'];?>
<?php 
if (isset($_POST['envoie2']))
{
global $IDNOM;
$IDNOM=$_POST['identifiant2'];
try
{
//on se connecte à notre base
$bdd = new PDO('mysql:host=localhost;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
die('Erreur : '.$e-> getMessage());
}

function verification($nume){
				// Connexion SQL				
				$bdd = new PDO('mysql:host=localhost;dbname=gestionvillage', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));				
				// Création de la requête SQL
				$num_sql = $nume ;
				$_SESSION['iddn']=$num_sql;
				$results=$bdd->query("SELECT count(*) as nbres FROM annonces WHERE Idannonces LIKE'$num_sql'");				
				// Exécution de la requête SQL				
				$rows = $results->fetch();				
				if($rows['nbres'] == 1){
				return TRUE;
				}else{
				return FALSE;
				}
				}
	if	($IDNOM==''){?>
	<script type="text/javascript" > 
				 alert("champs vide! "); 
                </script>
	
	<?php  }else
	{
	if (verification($IDNOM)=='TRUE')
	{
$reponse = $bdd->query("SELECT * FROM annonces WHERE Idannonces LIKE '$IDNOM' ");
while ($donnees = $reponse->fetch())
{
$num=$donnees['Idannonces'];
$ti=$donnees['Titre'];
$co=$donnees['Contenu'];
$ty=$donnees['Type'];
}
?>
<section id="container">
		<span class="chyron"><em><a href="http://www.hongkiat.com/blog/">&laquo; back to the site</a></em></span>
		<h2>Modifier l'annonce</h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<label for="num">Numero(A ne pas changer):</label>
			<input type="text" name="num" id="num" value="<?php echo $num;?>" autocomplete="off" tabindex="6" class="txtinput">
			<label for="titre">Titre: </label>
			<input type="text" name="titre" id="titre" value="<?php echo $ti;?>" autocomplete="off" tabindex="1" class="txtinput">
			<label for="titre">Contenu: </label>
			<textarea name="contenu" id="message"  tabindex="5" class="txtblock"><?php echo $co;?></textarea>		
			</section>		
								<section id="aside" class="clearfix">
					<section id="prioritycase">
					<?php if ($ty=='appel')
					{
					?>
					
						<label for="choix"><h3>Type:</h3></label>
						<span class="radiobadge">
					 	<input type="radio" name="choix" value="appel" id="appel" checked="checked"/> 
						<label for="hm">Appel</label>
						</span>
						<span class="radiobadge">
						<input type="radio" name="choix" value="Information" id="Information"  />
						<label for="fm">Information</label>								
						</span>
						<span class="radiobadge">
						<input type="radio" name="choix" value="dece" id="dece"  />
						<label for="fm">Décés</label>								
						</span>
					<?php
					} else {if($ty=='fete'){
					
					?>

						<label for="choix"><h3>Type:</h3></label>
						<span class="radiobadge">
					 	<input type="radio" name="choix" value="appel" id="appel" /> 
						<label for="hm">Appel</label>
						</span>
						<span class="radiobadge">
						<input type="radio" name="choix" value="Information" id="Information" checked="checked" />
						<label for="fm">Information</label>								
						</span>
						<span class="radiobadge">
						<input type="radio" name="choix" value="dece" id="dece"  />
						<label for="fm">Décés</label>								
						</span>
					<?php
					} else
					{			
					?>
					<label for="choix"><h3>Type:</h3></label>
						<span class="radiobadge">
					 	<input type="radio" name="choix" value="appel" id="appel" /> 
						<label for="hm">Appel</label>
						</span>
						<span class="radiobadge">
						<input type="radio" name="choix" value="Information" id="Information"  />
						<label for="fm">Information</label>								
						</span>
						<span class="radiobadge">
						<input type="radio" name="choix" value="dece" id="dece" checked="checked" />
						<label for="fm">Décés</label>								
						</span>
					<?php
					}
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
<?php  
} 
 else{  
?>
 <script type="text/javascript" > 
				 alert("cette identifiant n\'existe pas"); 
                </script> 
<?php } 
}
}
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
$idnom=$_POST['num'];
$req = $bdd->prepare("UPDATE annonces SET Titre = :ti, Contenu = :cn,Type = :ty WHERE Idannonces LIKE '$idnom'");
$req->execute(array(
'ti' => $_POST['titre'],
'cn' => $_POST['contenu'],
'ty' => $_POST['choix']
)); 
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
