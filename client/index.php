<?php
include_once("classes/utilisateur.class.php");
include_once("classes/message.class.php");

$utilisateur = new Utilisateur();

if(!empty($_COOKIE['pseudo']) && !empty($_COOKIE['motDePasse']) && $utilisateur->Verifier($_COOKIE['pseudo'], $_COOKIE['motDePasse']))
{
	$utilisateur->ConstruireParPseudo($_COOKIE['pseudo']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>MultiWall</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<script type="text/javascript" src="jquery/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
</head>

<body>
<?php include("haut.php"); ?>
<div id="content">
<?php
if(!empty($_COOKIE['pseudo']) && !empty($_COOKIE['motDePasse']) && $utilisateur->Verifier($_COOKIE['pseudo'], $_COOKIE['motDePasse']))
{	?>
	<h2>Bienvenue <?php echo $utilisateur->GetPrenom(); ?> <?php echo $utilisateur->GetNom(); ?></h2>
	<div class="entry">
<?php	$listeMessages = new ListeMessages();
		$listeMessages->ConstruireListeRecus($utilisateur->GetCode());	?>
		Vous avez envoyé <?php echo $listeMessages->Count(); ?> messages au total.
        <br />
<?php	$listeMessages->ConstruireListeEnvoyes($utilisateur->GetCode());	?>
		Vous avez reçu <?php echo $listeMessages->Count(); ?> messages au total.
	</div>
    <div class="entry">
    	Utilisez le menu de gauche.
    </div>
<?php
}
else
{	?>
	<h2>Connexion</h2>
	<div class="entry">
		<div class="caution">Vous n'êtes pas connecté.</div>
    	<p>&nbsp;</p>
		<p>Afin de pouvoir utiliser l'application, connectez vous à l'aide du formulaire à gauche ou inscrivez-vous.</p>
	</div><!--/entry -->
<?php
}	?>
</div><!--/content -->
<?php
include("bas.php");
?>
</body>
</html>