<?php
include_once("classes/utilisateur.class.php");
include_once("classes/message.class.php");

// Vérifier si l'utilisateur est connecté
$utilisateur = new Utilisateur();

if(empty($_COOKIE['pseudo']) || empty($_COOKIE['motDePasse']) || $utilisateur->Verifier($_COOKIE['pseudo'], $_COOKIE['motDePasse']) == false)
{	?>
	<script type="text/javascript">
    document.location.href="logout.php";
    </script>
<?php
}	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>MultiWall :: Messages envoyés</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<script type="text/javascript" src="jquery/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/profil.js"></script>
</head>

<body>
<?php include("haut.php"); ?>
<div id="content">
<?php
// Afficher les informations de l'utilisateur demandé si le paramètre passé en GET est indiqué et que cet utilisateur existe
$utilisateur = new Utilisateur();
$utilisateur->ConstruireParPseudo($_COOKIE['pseudo']);

$listeMessages = new ListeMessages();
$listeMessages->ConstruireListeEnvoyes($utilisateur->GetCode());

if($listeMessages->Count() == 0)
{	?>
	<p>&nbsp;</p>
    <p style="text-align:center">*** Aucun message envoyé ***</p>
<?php	
}
else
{
	foreach($listeMessages->Get() as $message)
	{
		$destinataire = $message->GetDestinataire();	?>
		<code class="orange">
			<div>
				<span style="font-size:14px; font-weight:bold">
					<a href="profil.php?pseudo=<?php echo $destinataire->GetPseudo(); ?>">
						<?php echo $destinataire->GetPrenom(); ?> <?php echo $destinataire->GetNom(); ?>
					</a>
				</span>
				Le <?php echo $message->GetDate(); ?> à <?php echo $message->GetHeure(); ?>	
			</div>
			<div>
				<?php echo $message->GetMessage(); ?>
			</div>
		</code>
<?php
	}
}	?>
</div><!--/content -->
<?php
include("bas.php");
?>
</body>
</html>