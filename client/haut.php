<div id="header">
    <div id="headerimg">
	  <h1><a href="index.html">MultiWall</a></h1>
	</div><!--/headerimg -->
</div><!--/header -->

<div id="body">
	<div id="menu">
	<h2>Cot&eacute; client</h2>
	<ul class="menu-list">
<?php
	if(!empty($_COOKIE['pseudo']) && !empty($_COOKIE['motDePasse']) && $utilisateur->Verifier($_COOKIE['pseudo'], $_COOKIE['motDePasse']))
	{	?>
  		<li><a href="profil.php?pseudo=<?php echo $_COOKIE['pseudo']; ?>">Mon mur</a></li>
  		<li><a href="profil.php">Consulter un profil</a></li>
  		<li><a href="messagesEnvoyes.php">Mes messages envoy&eacute;s</a></li>
  		<li><a href="logout.php">D&eacute;connexion</a></li>
<?php
	}
	else
	{	?>
  		<form method="post" action="login.php" enctype="multipart/form-data">
    		<div style="text-align:center">
            	<input type="text" id="pseudo" name="pseudo" value="Nom utilisateur" class="green" />
        	</div>
        	<div style="text-align:center">
            	<input type="password" id="motDePasse" name="motDePasse" value="Mot De Passe" class="green" />
        	</div>
        	<div style="text-align:center">
            	<input type="submit" id="bouton" value="Connexion" class="green" />
        	</div>
    	</form>
        <ul class="menu-list">
        	<li><a href="inscription.php">Inscription</a></li>
        </ul>
<?php
	}
?>
	</ul><!--/sidebar list -->

	<ul class="sponsorlinks">
	</ul><!--/sponsorlinks -->
</div><!--/menu -->

<!--Menu end -->