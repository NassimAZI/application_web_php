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
		
		<title> VILLAGE AKHENAK</title>
</head>

<body>
<?php include("liens.php"); ?>
<nav class="admin">

</nav>
<div class="corps">

 
<div class="content">
	<h1><P>Bienvenue sur votre page d'administrateur</P></h1>
</div>
<?php include("imagebouge.php"); ?>
		
</div>
<?php include("footer.php"); ?>
</body>
</html>
<?php 
}else{
header('location:index.php');

}
?>