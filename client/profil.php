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
<title>MultiWall :: Consulter un profil</title>
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
if(empty($_GET['pseudo']))
{
	$listeUtilisateurs = new ListeUtilisateurs();
	$listeUtilisateurs->Construire();
	
	foreach($listeUtilisateurs->Get() as $utilisateur)
	{	?>
		<table style="width:500px" cellpadding="0" cellspacing="0">
			<tr>
				<td style="width:50px">
					<div style="text-align:center">
						<a href="profil.php?pseudo=<?php echo $utilisateur->GetPseudo(); ?>">
							<img src="images/profil.png" width="32" height="32" />
						</a>
					</div>
				</td>
				<td>
					<code class="orange">
						<div>
							<span style="font-size:14px; font-weight:bold">
								<a href="profil.php?pseudo=<?php echo $utilisateur->GetPseudo(); ?>">
									<?php echo $utilisateur->GetPrenom(); ?> <?php echo $utilisateur->GetNom(); ?>
								</a>
							</span>
						</div>
					</code>
				</td>
			</tr>
		</table>
<?php
	}
}
elseif(!empty($_GET['pseudo']) && $utilisateur->Existe($_GET['pseudo']))
{
	$utilisateur->ConstruireParPseudo($_GET['pseudo']);	?>
	<h2>Mur de <?php echo $utilisateur->GetPrenom(); ?> <?php echo $utilisateur->GetNom(); ?></h2>
	<div style="text-align:right">
		<a href="#" id="actualiserMessages">
			Actualiser la liste des messages
		</a>
	</div>
	<input type="hidden" id="codeDestinataire" name="codeDestinataire" value="<?php echo $utilisateur->GetCode(); ?>" />
<?php	// Afficher le formulaire pour envoyer un message si c'est un autre profil que celui de l'utilisateur
	$utilisateur = new Utilisateur();
	$utilisateur->ConstruireParPseudo($_COOKIE['pseudo']);

	if($utilisateur->GetCode() != $_POST['codeDestinataire'] && $utilisateur->GetPseudo() != $_GET['pseudo'])
	{	?>
		<div>Envoyer un message:</div>
		<div>
			<textarea id="message" name="message" class="green" cols="77" rows="2"></textarea>
		</div>
		<div>
			<input type="hidden" id="codeEmetteur" name="codeEmetteur" value="<?php echo $utilisateur->GetCode(); ?>" />
			<input type="submit" id="bouton" name="bouton" value="Envoyer ce message" class="green" />
		</div>
		<div>&nbsp;</div>
<?php
	}	?>
    <div class="entry" id="listeMessages" style="display:none">
    <!-- Ici viennent s'afficher les messages !-->
    </div>
<?php
}
?>
</div><!--/content -->
<?php
include("bas.php");
?>
</body>
</html>