$(document).ready(function()
{
	chargerJournal();
	chargerConnectes();
	
	window.setInterval(chargerJournal, 10000);
	window.setInterval(chargerConnectes, 10000);
	
	$('#actualiserJournal').click(function()
	{
		chargerJournal();
	});
	
	$('#viderJournal').click(function()
	{
		viderJournal();
	});
	
	function chargerJournal()
	{
		$.post('ajax_journal.php', function(data)
		{
			$("#listeMessages").fadeOut();
			$("#listeMessages").fadeIn();
			$("#listeMessages").html(data);
		});
	}
	
	function viderJournal()
	{
		$.post('vider_journal.php', function(data)
		{
			chargerJournal();
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