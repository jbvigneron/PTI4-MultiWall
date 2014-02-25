<?php
include_once("classes/utilisateur.class.php");
include_once("classes/journal.class.php");

if(!empty($_POST['pseudo']) && !empty($_POST['motDePasse']))
{
	$utilisateur = new Utilisateur();
	
	if($utilisateur->Verifier($_POST['pseudo'], sha1($_POST['motDePasse'])))
	{
		$utilisateur->ConstruireParPseudo($_POST['pseudo']);
		
		setcookie('pseudo', $_POST['pseudo']);
		setcookie('motDePasse', sha1($_POST['motDePasse']));
		
		$journal = new EntreeJournal();
		$journal->SetAction('Connexion');
		$journal->SetDate(date('Y-m-d'));
		$journal->SetHeure(date('H:i'));
		$journal->SetIP($_SERVER['REMOTE_ADDR']);
		$journal->SetUtilisateur($utilisateur->GetCode());
		$journal->Ajouter();
			?>
    	<script type="text/javascript">
		document.location.href="index.php";
		</script>
<?php
	}
	else
	{	?>
    <script type="text/javascript">
    alert("Mauvaise combinaison nom utilisateur/mot de passe.");
	document.location.href="index.php";
    </script>
<?php
	}
}
?>