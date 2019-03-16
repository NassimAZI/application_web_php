<?php 
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
		<link href="styles.css" rel="stylesheet" type="text/css">
				<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>ansuf yiswen</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="CSS3 Lightbox - A CSS-only lightbox" />
        <meta name="keywords" content="css3, lightbox, overlay, effect, images, thumbnails" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Circle Hover Effects with CSS Transitions</title>
        <meta name="description" content="Circle Hover Effects with CSS Transitions" />
        <meta name="keywords" content="circle, border-radius, hover, css3, transition, image, thumbnail, effect, 3d" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/common.css" />
        <link rel="stylesheet" type="text/css" href="css/style3-.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700' rel='stylesheet' type='text/css' />
		<script type="text/javascript" src="js/modernizr.custom.79639.js"></script> 

</head>
<body>
<header>APPLICATION DE GESTION D'UN VILLAGE KABYLE</header>
<?php include("menu.php"); ?>

<div class="corps">
<br />
<br />

<br />
<br />
 <em class="txt">Une petite galerie sur nos traditions au village</em><br /><br /><br />
			<section>
				<ul class="lb-album">
					<li>
						<a href="#image-1">
							<img src="images/thumbs/1.jpg" alt="image01">
							<span>symbole kabyle</span>
						</a>
						<div class="lb-overlay" id="image-1">
							<a href="#page" class="lb-close">x Close</a>
							<img src="images/full/1.jpg" alt="image01" />
							<div>
								<h3>Femme kabyle<span>takvaylit</h3>
								<p>nos vieilles femmes cherche de la nouriture pour elever les animaux</p>
							</div>
							
						</div>
					</li>
					<li>
						<a href="#image-2">
							<img src="images/thumbs/2.jpg" alt="image02">
							<span>le village</span>
						</a>
						<div class="lb-overlay" id="image-2">
							<img src="images/full/2.jpg" alt="image02" />
							<div>							
								<h3>l'architecture<span>/architecture ancienne /</h3>
								<p>An exercise designed to develop graceful movement and disposition of the arms</p>
							</div>
							<a href="#page" class="lb-close">x Close</a>
						</div>
					</li>
					<li>
						<a href="#image-3">
							<img src="images/thumbs/3.jpg" alt="image03">
							<span>Habitations</span>
						</a>
						<div class="lb-overlay" id="image-3">
							<img src="images/full/3.jpg" alt="image03" />
							<div>							
								<h3>la vieille construction<span>/ixamen ikdimen/</h3>
								<p></p>
							</div>
							<a href="#page" class="lb-close">x Close</a>
						</div>
					</li>
					<li>
						<a href="#image-4">
							<img src="images/thumbs/4.jpg" alt="image04">
							<span>periode d'olive</span>
						</a>
						<div class="lb-overlay" id="image-4">
							<img src="images/full/4.jpg" alt="image04" />
							<div>							
								<h3>a·da·gio <span>/?'däjo/</h3>
								<p>A movement or composition marked to be played adagio</p>
							</div>
							<a href="#page" class="lb-close">x Close</a>
						</div>
					</li>
					<li>
						<a href="#image-5">
							<img src="images/thumbs/5.jpg" alt="image05">
							<span>source d'eau</span>
						</a>
						<div class="lb-overlay" id="image-5">
							<img src="images/full/5.jpg" alt="image05" />
							<div>							
								<h3>une source naturelle<span>/tala n tadart/</h3>
								<p>une source d'eau naturelle</p>
							</div>
							<a href="#page" class="lb-close">x Close</a>
						</div>
					</li>
					<li>
						<a href="#image-6">
							<img src="images/thumbs/6.jpg" alt="image06">
							<span>FIGUES BARBARES</span>
						</a>
						<div class="lb-overlay" id="image-6">
							<img src="images/full/6.jpg" alt="image06" />
							<div>							
								<h3>FIGUES BARBARES<span>figues barbares(akarmus)</h3>
								<p>nos vieilles femmes recoltent le akarmus dans nos champs</p>
							</div>
							<a href="#page" class="lb-close">x Close</a>
						</div>
					</li>
					<li>
						<a href="#image-7">
							<img src="images/thumbs/7.jpg" alt="image07">
							<span>labourage</span>
						</a>
						<div class="lb-overlay" id="image-7">
							<img src="images/full/7.jpg" alt="image07" />
							<div>							
								<h3>le laboureur<span>/avec izgaren et elmaoun/</h3>
								<p>tourner la terre pour semer</p>
							</div>
							<a href="#page" class="lb-close">x Close</a>
						</div>
					</li>
					<li>
						<a href="#image-8">
							<img src="images/thumbs/8.jpg" alt="image08">
							<span>preparation hiver</span>
						</a>
						<div class="lb-overlay" id="image-8">
							<img src="images/full/8.jpg" alt="image08" />
							<div>							
								<h3>ramassage du bois<span>/tizdemt/</h3>
								<p>pour la combustion</p>
							</div>
							<a href="#page" class="lb-close">x Close</a>
						</div>
					</li>
					<li>
						<a href="#image-9">
							<img src="images/thumbs/9.jpg" alt="image09">
							<span>beaute kabyle</span>
						</a>
						<div class="lb-overlay" id="image-9">
							<img src="images/full/9.jpg" alt="image09" />
							<div>							
								<h3>tikvayliyin<span>/la robe kabyle/</h3>
								<p>le charme de la robe kabyle et nos filles</p>
							</div>
							<a href="#page" class="lb-close">x Close</a>
						</div>
					</li>
					<li>
						<a href="#image-10">
							<img src="images/thumbs/10.jpg" alt="image10">
							<span>lawzi3a</span>
						</a>
						<div class="lb-overlay" id="image-10">
							<img src="images/full/10.jpg" alt="image10" />
							<div>							
								<h3><span>/timecret/</h3>
								<p>partager des parts de viandes entre les villageois</p>
							</div>
							<a href="#page" class="lb-close">x Close</a>
						</div>
					</li>
				</ul>
			</section>
</div>
<?php include("footer.php"); ?>
</body>
</html>
