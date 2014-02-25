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
});