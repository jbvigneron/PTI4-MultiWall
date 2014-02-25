<?php
include_once("classes/utilisateur.class.php");

if($_POST['boutonEnvoyer'] != "")
{
	if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mdpChoisi']) && !empty($_POST['pseudoChoisi']) && $_POST['mdpChoisi'] == $_POST['confirmationMotDePasse'])
	{
		
		
		
		$utilisateur = new Utilisateur();
		$utilisateur->SetMotDePasse(sha1($_POST['mdpChoisi']));
		$utilisateur->SetNom($_POST['nom']);
		$utilisateur->SetPrenom($_POST['prenom']);
		$utilisateur->SetPseudo($_POST['pseudoChoisi']);
		$utilisateur->Ajouter();	?>
   		<script type="text/javascript">
		alert("Votre inscription a bien été enregistrée.\nVous pouvez dès à présent vous connecter.");
		document.location.href="index.php";
		</script>
<?php
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>MultiWall :: Inscription</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<script type="text/javascript" src="jquery/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/inscription.js"></script>
</head>

<body>
<?php include("haut.php"); ?>
<div id="content">
	<h2>Inscription</h2>
	<div class="entry">
		<p>Afin de pouvoir utiliser l'application, vous devez vous inscrire.</p>
        <form id="formulaire" action="inscription.php" method="post" enctype="multipart/form-data">
        	<table style="width:400px" cellpadding="2" cellspacing="2" border="0">
            	<tr>
                	<td style="width:200px">
                		<div style="text-align:right">
                    		Votre nom:
                    	</div>
                    </td>
                    <td style="width:300px">
                    	<input type="text" id="nom" name="nom" class="green" maxlength="32" />
                    </td>
                </tr>
                <tr>
                	<td style="width:300px">
                		<div style="text-align:right">
                    		Votre prénom:
                    	</div>
                    </td>
                    <td style="width:300px">
                    	<input type="text" id="prenom" name="prenom" class="green" maxlength="32" />
                    </td>
                </tr>
                <tr>
                	<td style="width:300px">
                		<div style="text-align:right">
                    		Votre pseudo*:
                    	</div>
                    </td>
                    <td style="width:300px">
                    	<input type="text" id="pseudoChoisi" name="pseudoChoisi" class="green" maxlength="32" />
                    </td>
                </tr>
                <tr>
                	<td style="width:300px">
                		<div style="text-align:right">
                    		Votre mot de passe:
                    	</div>
                    </td>
                    <td style="width:300px">
                    	<input type="password" id="mdpChoisi" name="mdpChoisi" class="green" maxlength="32" />
                    </td>
                </tr>
                <tr>
                	<td style="width:300px">
                		<div style="text-align:right">
                    		Confirmez:
                    	</div>
                    </td>
                    <td style="width:300px">
                    	<input type="password" id="confirmationMotDePasse" name="confirmationMotDePasse" class="green" maxlength="32" />
                    </td>
                </tr>
                <tr>
               		<td colspan="2">
                    	<div style="text-align:center">
                        	<input type="submit" id="boutonEnvoyer" name="boutonEnvoyer" value="Valider" class="green" />
                        </div>
                    </td>
            </table>
        </form>
        <div>&nbsp;</div>
        <div style="text-align:center; font-style: italic">
        	* Pas d'accent, de caractère spéciaux ou d'espace
        </div>
	</div><!--/entry -->
</div><!--/content -->
<?php
include("bas.php");
?>
</body>
</html>