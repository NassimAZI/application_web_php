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
		<link rel="stylesheet" type="text/css" media="all" href="style.css">
		<title> VILLAGE AKHENAK</title>
</head>
<body>
<?php include("liens.php"); ?>
<nav class="admin">


</nav>
<div class="corps">
<section id="container">
		
		<h2>Modifier un compte</h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<input type="text" name="identifiant2" id="name" placeholder="Entrez l'identifiant du compte à changer" autocomplete="off" tabindex="1" class="txtinput">
			</section>		
		</div>
		<section id="buttons">
			<input type="submit" name="envoie2" id="submitbtn" class="submitbtn" tabindex="7" value="Modifier">
			<br style="clear:both;">
		</section>
		</form>
	</section>
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
				$results=$bdd->query("SELECT count(*) as nbres FROM utilisateurs WHERE Identifiant LIKE'$num_sql'");				
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
	if (verification($idnom)=='TRUE')
	{
$reponse = $bdd->query("SELECT * FROM utilisateurs WHERE Identifiant LIKE '$idnom' ");
while ($donnees = $reponse->fetch())
{
$num=$donnees['IdUtilisateur'];
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
		<h2>Modifier un compte</h2>
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<label for="num">Numero(A ne pas changer):</label>
			<input type="text" name="num" id="num" value="<?php echo $num;?>" autocomplete="off" tabindex="6" class="txtinput">
			<label for="nom">Nom: </label>
			<input type="text" name="nom" id="name" value="<?php echo $no;?>" autocomplete="off" tabindex="1" class="txtinput">
			<label for="prenom">Prenom: </label>
			<input type="text" name="prenom" id="prenom" value="<?php echo $pr;?>" placeholder="PRENOM" autocomplete="off" tabindex="2" class="txtinput" />
			<label for="identifiant">Identifiant: </label>
			<input type="text" name="identifiant" id="identifiant" value="<?php echo $id;?>" placeholder="IDENTIFIANT" autocomplete="off" tabindex="3" class="txtinput">
			<label for="motdepasse">Mot de passe: </label>
			<input type="text" name="motdepasse" id="motdepasse" placeholder="MOT DE PASSE" autocomplete="off" value="<?php echo $mp;?>" tabindex="4" class="txtinput">
			<label for="datenaissance">Date de naissance:</label>
			<input type="date" name="datenaissance" id="datenaissance" placeholder="aaaa/mm/jj" autocomplete="off" tabindex="5" class="txtinput"value="<?php echo $dt;?>">		
			</section>		
								<section id="aside" class="clearfix">
					<section id="prioritycase">
					<?php if ($sx=='Homme')
					{
					?>
					
						<label for="choix"><h3>Sexe:</h3></label>
						<span class="radiobadge">
					 	<input type="radio" name="choix" value="hm" id="hm" checked="checked"/> 
						<label for="hm">Homme</label>
						</span>
						<span class="radiobadge">
						<input type="radio" name="choix" value="fm" id="fm"  />
						<label for="fm">Femme</label>								
						</span>
					<?php
					} else 
					{
					?>

						<label for="choix"><h3>Sexe:</h3></label>
						<span class="radiobadge">
					 	<input type="radio" name="choix" value="hm" id="hm" /> 
						<label for="hm">Homme</label> 
						</span>
						<span class="radiobadge">
						<input type="radio" name="choix" value="fm" id="fm" checked="checked" />
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
						<input type="radio" name="choice" value="mr" id="mr" /> 
						<label for="mr">Marié</label>
						</span>
						<span class="radiobadge">
						<input type="radio" name="choice" value="clb" id="clb" checked="checked" />
						<label for="clb">Celibataire</label>		
						</span>
					<?php
					} else 
					{
					?>		
						<label for="choice"><h3>Situation familliale:</h3></label>
						<span class="radiobadge">
					 	<input type="radio" name="choice" value="mr" id="mr" checked="checked"/> 
						<label for="mr">Marié</label> 
						</span>
						<span class="radiobadge">
						<input type="radio" name="choice" value="clb" id="clb"  />
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
					 	<input type="radio" name="choic" value="tr" id="tr" checked="checked"/> 
						<label for="tr">A un emploi</label>
						</span>
						<span class="radiobadge">						
						<input type="radio" name="choic" value="trp" id="trp" />
						<label for="trp">N'a pas d'emploi</label>	
						</span>
					<?php
					} else 
					{
					?>
					
						<label for="choic"><h3>Situation professionnelle:</h3></label>
						<span class="radiobadge">
					 	<input type="radio" name="choic" value="tr" id="tr" /> 
						<label for="tr">A un emploi</label>
						</span>
						<span class="radiobadge">
						<input type="radio" name="choic" value="trp" id="trp" checked="checked"/>
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
<?php  
 }
 
 else{  
  ?>
 <script type="text/javascript" > 
				 alert("cette identifiant n\'existe pas "); 
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
$num= $_POST['num'];
$nm2 = $_POST['nom'];
$pr2 = $_POST['prenom'];
$dt2 = $_POST['datenaissance'];
$id2 = $_POST['identifiant'];
$mp2 = $_POST['motdepasse'];
	if($_POST['choix']=="hm")
	{
	$sx2='Homme';
	}else
	{
	$sx2='Femme';
	}
	if($_POST['choice']=="mr")
	{
	$sf2=1;
	}else
	{
	$sf2=0;
	}
	if($_POST['choic']=="tr")
	{
	$sp2=1;
	}else
	{
	$sp2=0;
	}
$req = $bdd->prepare("UPDATE  utilisateurs   SET nom = :nm ,prenom = :pr ,identifiant= :id ,mot_de_passe= :mp,Sexe= :sx,Sit_Fam= :sf, Sit_Pro= :sp WHERE IdUtilisateur LIKE :num");
$req->execute(array(
'nm' => $nm2,
'pr' => $pr2,
'id' => $id2,
'mp' => $mp2,
'sx' => $sx2,
'sf' => $sf2,
'sp' => $sp2,
'num' => $num,
)); 
};
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