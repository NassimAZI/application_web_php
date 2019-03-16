<?php
include('config.php');
if(!isset($informations))
{
$informations = Array(/*Erreur*/
true,
'Erreur',
'Une erreur interne est survenue...',
'',
'connexion.php',
3
);
}
if($informations[0] === true) $type = 'erreur';
else $type = 'information';
?>
<html>
<head>
		<meta charset="utf-8">
		<link href="styles.css" rel="stylesheet" type="text/css">
		<title><?php echo $informations[1]; ?> : <?php echo TITRESITE; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="language" content="fr" />
		<meta http-equiv="Refresh" content="<?php echo $informations[5]; ?> ;url=<?php echo $informations[4]; ?>">
</head>

<body>

<?php include("liens.php"); ?>

<div class="corps">

<div id="info">
<div id="<?php echo $type; ?>"><?php echo $informations[2]; ?>
Redirection en cours...<br/>
<a href="<?php echo $informations[4]; ?>">Cliquez ici si vous ne voulez pas attendre...</a><?php echo $informations[3]; ?>
</div>
</div>

		
</div>
<?php include("footer.php"); ?>
</body>
</html>
