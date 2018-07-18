// Traitement du formulaire en jquery pour l'inscription code pris sur https://openclassrooms.com/courses/un-site-web-dynamique-avec-jquery/tp-le-formulaire-interactif et adapté pour mon utilisation
			$(document).ready(function(){
    		    var $mdp = $('#InputPassword'),
		        $confirmation = $('#InputPasswordRetry'),
		            $mail = $('#InputEmail'),
			        $envoi = $('#envoi'),
			        $reset = $('#rafraichir'),
			        $erreur = $('#erreur'),
			        $champ = $('.champs'),
			  		$pseudo = $('#InputUsername');

			 $champ.keyup(function(){
        if($(this).val().length < 5){ // si la chaîne de caractères est inférieure à 5
            $(this).css({ // on rend le champ rouge
                borderColor : 'red',
	        color : 'red'
            });
         }
         else{
             $(this).css({ // si tout est bon, on le rend vert
	         borderColor : 'green',
	         color : 'green'
	     });
         }
    });

    $confirmation.keyup(function(){
        if($(this).val() != $mdp.val()){ // si la confirmation est différente du mot de passe
        	$erreur.text("Les deux mots de passe ne correspondent pas");
        	$erreur.removeClass("alert-success");
        	$erreur.addClass("alert-danger");
        	$erreur.css('display', 'block'); // on affiche le message d'erreur
            $(this).css({ // on rend le champ rouge
     	        borderColor : 'red',
        	color : 'red'
            });

        }
        else{
        $erreur.css('display', 'block'); // on affiche le message d'erreur
             $erreur.removeClass("alert-danger");
        	$erreur.addClass("alert-success");
        	$erreur.text("Les deux mots de passes correspondent");
	    $(this).css({ // si tout est bon, on le rend vert
	        borderColor : 'green',
	        color : 'green'
	    });
        }
    });

    $envoi.click(function(e){
        e.preventDefault(); // on annule la fonction par défaut du bouton d'envoi

        // puis on lance la fonction de vérification sur tous les champs :
        verifier($pseudo);
        verifier($mdp);
        verifier($confirmation);
    });

    $reset.click(function(){
        $champ.css({ // on remet le style des champs comme on l'avait défini dans le style CSS
            borderColor : '#ccc',
    	    color : '#555'
        });
        $erreur.css('display', 'none'); // on prend soin de cacher le message d'erreur
    });

    function verifier(champ){
        if(champ.val() == ""){ // si le champ est vide
    	    $erreur.css('display', 'block'); // on affiche le message d'erreur
            champ.css({ // on rend le champ rouge
    	        borderColor : 'red',
    	        color : 'red'
    	    });
        }
    }


});
 $(document).ready(function() {
    $('#InputVille').autocomplete({
        serviceUrl: 'http://bonsaistore.yannickperret.com/include/function.php', // location.pathname
        dataType: 'json',
        minLength: 2,
    });

});

 $(document).ready(function() {

$('#InputEmail').focusout(function(){
				$erreurEmail = $('#erreurEmail'),
                $('#InputEmail').filter(function(){
                var emil=$('#InputEmail').val();
              	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            	if( !emailReg.test( emil ) ) {
	                $erreurEmail.text("L'email entré n'est pas dans un format valide");
	        		$erreurEmail.removeClass("alert-success");
	        		$erreurEmail.addClass("alert-danger");
	        		$erreurEmail.css('display', 'block'); // on affiche le message d'erreur
                } 
                else {
	                $erreurEmail.css('display', 'block'); // on affiche le message d'erreur
	             	$erreurEmail.removeClass("alert-danger");
	        		$erreurEmail.addClass("alert-success");
	        		$erreurEmail.text("L'email entré est dans un format valide");
                }
                })
            });
});

