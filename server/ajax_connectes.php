<?php
include_once("classes/connectes.class.php");

$connectes = new Connectes();
$connectes->Construire();
	
echo $connectes->Get(); ?> utilisateurs connectés