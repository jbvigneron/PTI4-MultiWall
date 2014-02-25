<?php
include_once("classes/utilisateur.class.php");
include_once("classes/journal.class.php");
include_once("classes/connectes.class.php");

$journal = new Journal();
$journal->Construire();

if($journal->Count() == 0)
{	?>
	<p>&nbsp;</p>
	<p style="text-align:center">
    	*** Aucun message ***
    </p>
<?php
}
else
{
	foreach($journal->Get() as $entreeJournal)
	{
		$utilisateur = $entreeJournal->GetUtilisateur();	?>
		<div>
        	Le <?php echo $entreeJournal->GetDate(); ?> à <?php echo $entreeJournal->GetHeure(); ?> - 
            Connexion de <strong><?php echo $utilisateur->GetPrenom(); ?> <?php echo $utilisateur->GetNom(); ?></strong>
        </div>
<?php
	}
}	?>