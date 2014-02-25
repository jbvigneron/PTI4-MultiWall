$(document).ready(function()
{
	chargerMessages();
	window.setInterval(chargerMessages, 10000);
	
	$('#actualiserMessages').click(function()
	{
		chargerMessages();
	});
	
	function chargerMessages()
	{
		$.post('ajax_profil.php', { codeDestinataire: $("#codeDestinataire").val() }, function(data)
		{
			$("#listeMessages").fadeOut();
			$("#listeMessages").fadeIn();
			$("#listeMessages").html(data);
		});
	}
	
	$('#bouton').click(function()
	{
		if($('#message').val() == "")
		{
			alert("Entrez votre message");	
		}
		else
		{
			$("#message").attr('disabled', 'disabled');
			$("#bouton").attr('disabled', 'disabled');
			
			$.post('traitement_message.php',{
												action: 'ajouter',
												codeEmetteur: $("#codeEmetteur").val(),
												codeDestinataire: $("#codeDestinataire").val(),
												message: $("#message").val()
											},
			function(data)
			{
				$("#message").val('');
				$("#message").attr('disabled', '');
				$("#bouton").attr('disabled', '');
				chargerMessages();
			});
		}
	});
});