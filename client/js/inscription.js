$(document).ready(function()
{
	$('#pseudo').focus(function()
	{
		$(this).val('');
	});
	
	$('#motDePasse').focus(function()
	{
		$(this).val('');
	});
	
	$('#bouton').click(function()
	{
		if($('#pseudo').val() == "" || $('#motDePasse').val() == "")
		{
			alert("Veuillez saisir un nom utilisateur et un mot de passe");
			return false;
		}
		else
		{
			return true;
		}
	});
	
	$("#pseudoChoisi").keyup(function()
    {
        var chaineSansEspace = verifierPseudo($(this).val());
		$(this).val(chaineSansEspace);
    });
	
	function verifierPseudo(chaine)
	{
		var longueur = chaine.length;
		
		var caracteres = new Array(' ', '&', 'é', '~', '\'', '"', '#', '{', '(', '[', '-', '|', 'è', '`', '_', 'ç', '^', 'à', '@', ')', ']', '=', '}', '^', '¨', '£', '$', '¤', 'ù', '%', '*', 'µ', ',', '?', ';', '.', ':', '/', '!', '§');
		
		// Vérification de saisie avec boucle & condition
		for(var i = 0; i <= longueur; i++)
		{
			for(var j = 0; j <= caracteres.length; j++)
			{
				if(chaine.charAt(i) == caracteres[j])
				{
					var chaineSansEspace = chaine.substring(0, i);
					chaineSansEspace += chaine.substring(i + 1, longueur);
				
					chaine = chaineSansEspace;
					
					i = 0;
					j = 0;
				}
			}
		}
		
		return chaine;
	}
	
	$('#boutonEnvoyer').click(function()
	{
		if($('#nom').val() == "")
		{
			alert("Veuillez saisir votre nom.");
			$('#nom').focus();
			return false;
		}
		else if($('#prenom').val() == "")
		{
			alert("Veuillez saisir votre prénom.");
			$('#prenom').focus();
			return false;
		}
		else if($('#pseudoChoisi').val() == "")
		{
			alert("Veuillez saisir votre pseudo.");
			$('#pseudoChoisi').focus();
			return false;
		}
		else if($('#mdpChoisi').val() == "")
		{
			alert("Veuillez saisir votre mot de passe.");
			$('#mdpChoisi').focus();
			return false;
		}
		else if($('#confirmationMotDePasse').val() == "")
		{
			alert("Veuillez confirmer votre mot de passe.");
			$('#confirmationMotDePasse').focus();
			return false;
		}
		else if($('#mdpChoisi').val() != $('#confirmationMotDePasse').val())
		{
			alert("Les deux mots de mots de passe sont différents.");
			$('#mdpChoisi').focus();
			return false;
		}
		else
		{
			return true;
		}
	});
});