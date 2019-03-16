<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
/* navigation style */
#nav{
	height: 41px;
	font: 12px Geneva, Arial, Helvetica, sans-serif;
	background:#3AB3A9;
	border: 1px solid #30A097;	
	border-radius: 3px;
	width:100%;
	margin-left: -10px;
	margin-top: -10px;
	padding-left: 0px;
	position:fixed;
}	
#nav li{
	list-style: none;
	display: block;
	float: left;
	height: 40px;
	position: relative;
	border-right: 1px solid #52BDB5;
}
#nav li a{
	padding: 0px 10px 0px 30px;
	margin: 0px 0;
	line-height: 40px;
	text-decoration: none;
	border-right: 1px solid #389E96;
	height: 40px;
	color: black;
	
}

#nav ul{
	background: #f2f5f6; 
	padding: 0px;
	border-bottom: 1px solid #DDDDDD;
	border-right: 1px solid #DDDDDD;
	border-left:1px solid #DDDDDD;
	border-radius: 0px 0px 3px 3px;
	box-shadow: 2px 2px 3px #ECECEC;
	-webkit-box-shadow: 2px 2px 3px #ECECEC;
    -moz-box-shadow:2px 2px 3px #ECECEC;
	width:200px;
}
#nav .site-name,#nav .site-name:hover{
	padding-left: 10px;
	padding-right: 10px;
	color: #FFF;
	text-shadow: 1px 1px 1px #66696B;
	font: italic 20px/38px Georgia, "Times New Roman", Times, serif;
	background: url(images/saaraan.png) no-repeat 10px 5px;
	width: 160px;
	border-right: 1px solid #52BDB5;
}
#nav .site-name a{
	width: 129px;
	overflow:hidden;
}
#nav li.facebook{
	background: url(images/facebook.png) no-repeat 9px 12px;
}
#nav li.facebook:hover  {
	background: url(images/facebook.png) no-repeat 9px 12px #3BA39B;
}
#nav li.yahoo{
	background: url(images/yahoo.png) no-repeat 9px 12px;
}
#nav li.yahoo:hover  {
	background: url(images/yahoo.png) no-repeat 9px 12px #3BA39B;
}
#nav li.google{
	background: url(images/google.png) no-repeat 9px 12px;
}
#nav li.google:hover  {
	background: url(images/google.png) no-repeat 9px 12px #3BA39B;
}
#nav li.twitter{
	background: url(images/twitter.png) no-repeat 9px 12px;
}
#nav li.twitter:hover  {
	background: url(images/twitter.png) no-repeat 9px 12px #3BA39B;
}
#nav li:hover{
	background: #3BA39B;
}
#nav li a{
	display: block;
}
#nav ul li {
	border-right:none;
	border-bottom:1px solid #DDDDDD;
	width:200px;
	height:39px;
}
#nav ul li a {
	border-right: none;
	color:black;
	text-shadow: 1px 1px 1px #FFF;
	border-bottom:1px solid #FFFFFF;
}
#nav ul li:hover{background:#DFEEF0;}
#nav ul li:last-child { border-bottom: none;}
#nav ul li:last-child a{ border-bottom: none;}
/* Sub menus */
#nav ul{
	display: none;
	visibility:hidden;
	position: absolute;
	top: 40px;
}

/* Third-level menus */
#nav ul ul{
	top: 0px;
	left:200px;
	display: none;
	visibility:hidden;
	border: 1px solid #DDDDDD;
}
/* Fourth-level menus */
#nav ul ul ul{
	top: 0px;
	left:170px;
	display: none;
	visibility:hidden;
	border: 1px solid #DDDDDD;
}
#nav ul li{
	display: block;
	visibility:visible;
}
#nav li:hover > ul{
	display: block;
	visibility:visible;
}
</style>
<!--[if IE 7]>
<style>
#nav{
	margin-left:0px
}
#nav ul{
	left:-40px;
}
#nav ul ul{
	left:130px;
}
#nav ul ul ul{
	left:130px;
}
</style>
<![endif]-->
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<script>
$(document).ready(function(){
	$("#nav li").hover(
	function(){
		$(this).children('ul').hide();
		$(this).children('ul').slideDown('fast');
	},
	function () {
		$('ul', this).slideUp('fast');            
	});
});
</script>
</head>
<body>
<ul id="nav">

    <li class="yahoo"><a href="utilisateur.php"><strong>Accueil</strong></a>
    </li> 	
    <li class="facebook"><a href="#"><strong>Annonces</strong></a>
        <ul>
        <li><a href="listeannonceP.php">Appels</a></li>
        <li><a href="listeannonceP1.php">Informations</a></li>
		<li><a href="listeannonceP2.php">Décés</a></li>
        </ul>
    </li>
    <li class="google"><a href="forum.php"><strong>Forum</strong></a>	
	<li ><a href=""><strong>Mon compte</strong></a>
	<ul>
         <li ><a href='voircompte.php'>Voir mon compte</a></li>
		  <li><a href='modif_compte_ut.php'>Changer le mot de passe</a></li>
      </ul>
    </li>
	<li ><a href=""><strong>Matériel</strong></a>
	<ul>
         <li ><a href='listearticle.php'>Liste des Matériels</a></li>
         <li ><a href='ajt_cmd.php'>Louer</a></li>		 
      </ul> 
    </li>
	<li ><a href=""><strong>Cotisations</strong></a>
	<ul>
         <li><a href='voir_cotisation.php'><span>voir les cotisations</span></a></li>
      </ul>
    </li>
	<li ><a href=""><strong>Messagerie</strong></a>
	<ul>
         <li><a href='newmessage.php'><span>Nouveau message </span></a>        
         </li>
         <li><a href='messagerecu.php'><span>Boite de reception</span></a>
         </li>
		 <li><a href='messageenvoyer.php'><span>Boite d'envoi</span></a>
         </li>  
      </ul>
    </li>
	<li><a href='deconnexion.php'><strong>Déconnexion</strong></a></li>
</ul>
</body>
</html>
