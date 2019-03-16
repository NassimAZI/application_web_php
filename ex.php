<?php
session_start(); 
if (isset($_SESSION['utilisateur']))
{
// Définition facultative du répertoire des polices systèmes
// Sinon tFPDF utilise le répertoire [chemin vers tFPDF]/font/unifont/
// define("_SYSTEM_TTFONTS", "C:/Windows/Fonts/");
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
					$nom_ut=$res1['Nom'];
					$prenom_ut=$res1['Prenom'];
					$req= $bdd->query("SELECT * FROM (commande,lignedecommandes) WHERE commande.IdCommande LIKE lignedecommandes.IdCommande ORDER BY commande.Date DESC");
					$res2= $req->fetch();
					$id_cmnd=$res2['IdCommande'];
					$date_loc=$res2['Date'];
					$duree_loc=$res2['Duree'];


require('tfpdf.php');
$pdf = new tFPDF();
$pdf->AddPage();

// Ajoute une police Unicode (utilise UTF-8)
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',14);

// Charge une chaîne UTF-8 à partir d'un fichier
$val='Id de la commande: '.$id_cmnd;
$val1='Nom de l\'utilisateur: '.$nom_ut;
$val2='Prenom de l\'utilisateur: '.$prenom_ut;
$val3='Date de debut de la location : '.$date_loc;
$val4='Duree de la location: '.$duree_loc.' jours';
$val10='Liste des articles:';
$val11='$*********************************$ COMMANDE $********************************$';
$val12='$**********************************************************************************$';
$pdf->Write(8,$val11);
$pdf->Ln(10);
$pdf->Write(8,$val);
$pdf->Ln(10);
$pdf->Write(8,$val1);
$pdf->Ln(10);
$pdf->Write(8,$val2);
$pdf->Ln(10);
$pdf->Write(8,$val3);
$pdf->Ln(10);
$pdf->Write(8,$val4);
$pdf->Ln(10);
$pdf->Write(8,$val10);
$pdf->Ln(10);

$req3= $bdd->query("SELECT * FROM lignedecommandes WHERE IdCommande LIKE '$id_cmnd'");
while($res3= $req3->fetch())
{
					$qte=$res3['Quantite'];
					$id_art=intval($res3['IdArticle']);
					$req4= $bdd->query("SELECT * FROM article WHERE IdArticle LIKE '$id_art'");
					$res4= $req4->fetch();
					$idn_art=$res4['NomArticle'];
					$val5='Nom de l\'article: '.$idn_art;
					$val6='Quantite : '.$qte;
					$pdf->Ln(10);
					$pdf->Write(8,$val5);
					$pdf->Cell(60,10,$val6,0,1,'C');
					
					
}
$pdf->Write(8,$val12);
$pdf->Ln(10);
$pdf->Output();
}
?>
