$(document).ready(function()
{
	chargerMessages();
	chargerConnectes();
	
	window.setInterval(chargerMessages, 10000);
	window.setInterval(chargerConnectes, 10000);
	
	$('#actualiserMessages').click(function()
	{
		chargerMessages();
	});
	
	function chargerMessages()
	{
		$.post('ajax_messages.php', function(data)
		{
			$("#listeMessages").fadeOut();
			$("#listeMessages").fadeIn();
			$("#listeMessages").html(data);
			
			$("input[name='boutonSupprimer']").click(function()
			{
				return confirm("Supprimer ce message ?");
			});
		});
	}
	
	function chargerConnectes()
	{
		$.post('ajax_connectes.php', function(data)
		{
			$("#nbConnectes").fadeOut();
			$("#nbConnectes").fadeIn();
			$("#nbConnectes").html(data);
		});
	}
});