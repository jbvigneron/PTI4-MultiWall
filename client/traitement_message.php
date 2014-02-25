<?php
include_once("classes/message.class.php");
include_once("classes/utilisateur.class.php");

if($_POST['action'] == 'ajouter')
{
	  $message = new Message();
	  $message->SetDate(date('Y-m-d'));
	  $message->SetDestinataire($_POST['codeDestinataire']);
	  $message->SetEmetteur($_POST['codeEmetteur']);
	  $message->SetHeure(date('H:i'));
	  $message->SetMessage($_POST['message']);
	  $message->Ajouter();
}
?>