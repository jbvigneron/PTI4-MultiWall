<?php
include_once("sql.php");
include_once("classes/utilisateur.class.php");

// Journal
class Journal
{
	private $liste;
	
	// Construire la liste
	public function Construire()
	{
		$this->liste = array();
		$bdd = GetConnexion();
		
		$sql = $bdd->query("SELECT CODE_UTILISATEUR, CODE_SEQ
							FROM JOURNAL");
							
		while($resultat = $sql->fetch())
		{
			$entreeJournal = new EntreeJournal();
			$entreeJournal->Construire($resultat["CODE_UTILISATEUR"], $resultat["CODE_SEQ"]);
			array_push($this->liste, $entreeJournal);
		}
	}
	
	// Retourne la liste
	public function Get()
	{
		return $this->liste;
	}
	
	// Retourne le nombre d'éléments dans la liste
	public function Count()
	{
		return count($this->liste);	
	}
	
	public function Vider()
	{
		$bdd = GetConnexion();
		
		$sql = $bdd->query("TRUNCATE TABLE JOURNAL");
	}
}

// Une entree du journal
class EntreeJournal
{
    private $utilisateur;
    private $code;
    private $date;
    private $heure;
    private $ip;
    private $action;
	
	public function EntreeJournal()
	{
		$this->utilisateur = new Utilisateur();
	}

    public function GetUtilisateur()
    {
        return $this->utilisateur;
    }

    public function SetUtilisateur($codeUtilisateur)
    {
        $this->utilisateur->ConstruireParCode($codeUtilisateur);
    }

    public function GetCode()
    {
        return $this->code;
    }

    public function SetCode($code)
    {
        $this->code = $code;
    }

    public function GetDate()
    {
        return $this->date;
    }

    public function SetDate($date)
    {
        $this->date = $date;
    }

    public function GetHeure()
    {
        return $this->heure;
    }

    public function SetHeure($heure)
    {
        $this->heure = $heure;
    }

    public function GetIP()
    {
        return $this->ip;
    }

    public function SetIP($ip)
    {
        $this->ip = $ip;
    }

    public function GetAction()
    {
        return $this->action;
    }

    public function SetAction($action)
    {
        $this->action = $action;
    }
	
	public function Construire($codeUtilisateur, $codeSequentiel)
	{
		$bdd = GetConnexion();
		
		$sql = $bdd->prepare("SELECT CODE_UTILISATEUR, CODE_SEQ, DATE, HEURE, IP, ACTION
							FROM JOURNAL
							WHERE CODE_UTILISATEUR = ?
							AND CODE_SEQ = ?");
							
		$sql->execute(array($codeUtilisateur, $codeSequentiel));
							
		if($resultat = $sql->fetch())
		{
			$this->utilisateur->ConstruireParCode($resultat['CODE_UTILISATEUR']);
			$this->code = $resultat['CODE_SEQ'];
			$this->date = $resultat['DATE'];
			$this->heure = $resultat['HEURE'];
			$this->ip = $resultat['IP'];
			$this->action = $resultat['ACTION'];
		}
	}
	
	public function Ajouter()
	{
		$bdd = GetConnexion();
		
		$sql = $bdd->prepare("INSERT INTO JOURNAL (CODE_UTILISATEUR, DATE, HEURE, IP, ACTION)
							VALUES(?, ?, ?, ?, ?)");
							
		$sql->execute(array($this->utilisateur->GetCode(), $this->date, $this->heure, $this->ip, $this->action));
	}
}
?>