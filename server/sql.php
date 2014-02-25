<?php
// Informations sur la base de données MySQL
function GetConnexion()
{
	try
	{
		$bdd = new PDO('mysql:host=127.0.0.1;dbname=multiwall', 'root', '');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
	
	return $bdd;
}
?>