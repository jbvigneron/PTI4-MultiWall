<?php
include_once("classes/utilisateur.class.php");
include_once("classes/message.class.php");

$listeMessages = new ListeMessages();
$listeMessages->ConstruireListeRecus($_POST['codeDestinataire']);

if($listeMessages->Count() == 0)
{	?>
	<p style="text-align:center">
		*** Aucun message ***
	</p>
<?php	}
else
{	
	foreach($listeMessages->Get() as $message)
	{
		$emetteur = $message->GetEmetteur();	?>
		<code class="orange">
			<div>
            	<span style="font-size:14px; font-weight:bold">
					<a href="profil.php?pseudo=<?php echo $emetteur->GetPseudo(); ?>">
						<?php echo $emetteur->GetPrenom(); ?> <?php echo $emetteur->GetNom(); ?>
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