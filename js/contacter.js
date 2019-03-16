	 function sendit()// fonction de validation de formulaire
   {
      
if(document.hongkiat.nom.value==""){

			alert('Veuillez saisir votre nom. SVP!');
			return false;
			}
			else
			{
			
			if(document.hongkiat.prenom.value==""){

			alert('Veuillez saisir votre prénom. SVP!');
			return false;
			}
			else
			{
			if(document.hongkiat.email.value==""){
			alert('Veuillez saisir votre E-mail. SVP!');
			return false;}
			else{
			if(document.hongkiat.message.value==""){
			alert('Veuillez saisir votre Message. SVP!');
			return false;}
			else{
			return true
			}}
			}
			}
			}