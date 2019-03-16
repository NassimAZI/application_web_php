	 function ajouter()// fonction de validation de formulaire
   {
      
if(document.hongkiat.nom.value==""){

			alert('Veuillez saisir le nom. SVP!');
			return false;
			}
			else
			{	
			if(document.hongkiat.prenom.value==""){
			alert('Veuillez saisir le prénom. SVP!');
			return false;
			}
			else
			{
			if(document.hongkiat.identifiant.value==""){
			alert('Veuillez saisir un Identifiant. SVP!');
			return false;}
			else{
			if(document.hongkiat.motdepasse.value==""){
			alert('Veuillez saisir un mot de passe. SVP!');
			return false;}
			else{
			if(document.hongkiat.datenaissance.value==""){
			alert('Veuillez saisir une date de naissance. SVP!');
			return false;}
			else{
			return true
			}}}
			}
			}
			}