<?php
include_once("sql.php");

// Liste d'utilisateurs
class Connectes
{
	private $nbConnectes;
	
	// Construire la liste
	public function Construire()
	{
		$this->liste = array();
		$bdd = GetConnexion();
		
		$sql = $bdd->prepare("SELECT COUNT(*) AS NB_CONNECTES
							FROM CONNECTES
							WHERE IP = ?");
							
		$sql->execute(array($_SERVER['REMOTE_ADDR']));
		$resultat = $sql->fetch();
		
		if ($resultat['NB_CONNECTES'] == 0)
		{
    		$sql = $bdd->prepare("INSERT INTO CONNECTES VALUES (?, ?)");
			$sql->execute(array($_SERVER['REMOTE_ADDR'], time()));
		}
		else
		{
    		$sql = $bdd->prepare("UPDATE CONNECTES
								SET TIMESTAMP = ?
								WHERE IP = ?");
							
			$sql->execute(array(time(), $_SERVER['REMOTE_ADDR']));
		}
		
		$sql = $bdd->prepare("DELETE FROM CONNECTES
							WHERE timestamp < ?");
							
		$sql->execute(array(time() - (60 * 5)));

		$sql = $bdd->query("SELECT COUNT(*) AS NB_CONNECTES
							FROM CONNECTES");
							
		$resultats = $sql->fetch();
		$this->nbConnectes = $resultats['NB_CONNECTES'];	
	}
	
	// Retourne la liste
	public function Get()
	{
		return $this->nbConnectes;
	}
}
?>