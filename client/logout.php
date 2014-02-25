<?php
include_once("classes/utilisateur.class.php");
include_once("classes/journal.class.php");

$utilisateur = new Utilisateur();
	
if($utilisateur->Verifier($_COOKIE['pseudo'], $_COOKIE['motDePasse']))
{
	$utilisateur->ConstruireParPseudo($_COOKIE['pseudo']);
	
	$journal = new EntreeJournal();
	$journal->SetAction('Deconnexion');
	$journal->SetDate(date('Y-m-d'));
	$journal->SetHeure(date('H:i'));
	$journal->SetIP($_SERVER['REMOTE_ADDR']);
	$journal->SetUtilisateur($utilisateur->GetCode());
	$journal->Ajouter();
}

setcookie('pseudo', '');
setcookie('motDePasse', '');	?>
<script type="text/javascript">
document.location.href="index.php";
</script>