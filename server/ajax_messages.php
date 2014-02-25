<?php
include_once("classes/utilisateur.class.php");
include_once("classes/message.class.php");

$listeMessages = new ListeMessages();
$listeMessages->ConstruireListe();

if($listeMessages->Count() == 0)
{	?>
	<p>&nbsp;</p>
	<p style="text-align:center">
    	*** Aucun message ***
    </p>
<?php
}
else
{
	foreach($listeMessages->Get() as $message)
	{
		$destinataire = $message->GetDestinataire();
		$emetteur = $message->GetEmetteur();	?>
		<code class="orange">
        	<div>
                <form action="supprimerMessage.php" enctype="multipart/form-data" method="post">
                	Le <?php echo $message->GetDate(); ?> à <?php echo $message->GetHeure(); ?>	
                	<input type="hidden" name="emetteur" value="<?php echo $emetteur->GetCode(); ?>" />
                    <input type="hidden" name="message" value="<?php echo $message->GetCode(); ?>" />
                    <input type="hidden" name="destinataire" value="<?php echo $destinataire->GetCode(); ?>" />
                    <input type="submit" name="boutonSupprimer" value="Supprimer ce message" class="green" />
                </form>
            </div>
			<div>
				<span style="font-size:14px; font-weight:bold">
						<?php echo $emetteur->GetPrenom(); ?> <?php echo $emetteur->GetNom(); ?> ->
						<?php echo $destinataire->GetPrenom(); ?> <?php echo $destinataire->GetNom(); ?>
				</span>
			</div>
			<div>
				<?php echo $message->GetMessage(); ?>
			</div>
		</code>
<?php
	}
}	?>