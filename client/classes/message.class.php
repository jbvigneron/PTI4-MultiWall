<?php
include_once("sql.php");
include_once("classes/utilisateur.class.php");

// Liste de messages
class ListeMessages
{
	private $liste;
	
	// Construire la liste
	public function ConstruireListeRecus($codeDestinataire)
	{
		$this->liste = array();
		$bdd = GetConnexion();
		
		$sql = $bdd->prepare("SELECT CODE_UTILISATEUR_EMETTEUR, CODE_MESSAGE
							FROM MESSAGE
							WHERE CODE_UTILISATEUR_DESTINATAIRE = ?
							ORDER BY DATE DESC, HEURE DESC, CODE_MESSAGE DESC");
							
		$sql->execute(array($codeDestinataire));
							
		while($resultat = $sql->fetch())
		{
			$message = new Message();
			$message->Construire($resultat["CODE_UTILISATEUR_EMETTEUR"], $resultat["CODE_MESSAGE"], $codeDestinataire);
			array_push($this->liste, $message);
		}
	}

	public function ConstruireListeEnvoyes($codeEmetteur)
	{
		$this->liste = array();
		$bdd = GetConnexion();
		
		$sql = $bdd->prepare("SELECT CODE_MESSAGE, CODE_UTILISATEUR_DESTINATAIRE
							FROM MESSAGE
							WHERE CODE_UTILISATEUR_EMETTEUR = ?
							ORDER BY DATE DESC, HEURE DESC, CODE_MESSAGE DESC");
							
		$sql->execute(array($codeEmetteur));
							
		while($resultat = $sql->fetch())
		{
			$message = new Message();
			$message->Construire($codeEmetteur, $resultat["CODE_MESSAGE"], $resultat['CODE_UTILISATEUR_DESTINATAIRE']);
			array_push($this->liste, $message);
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
}

// Un utilisateur

class Message
{
    private $emetteur;
    private $code;
    private $destinataire;
    private $date;
    private $heure;
    private $message;
	
	public function Message()
	{
		$this->emetteur = new Utilisateur();
		$this->destinataire = new Utilisateur();
	}

    public function GetEmetteur()
    {
        return $this->emetteur;
    }

    public function SetEmetteur($codeEmetteur)
    {
		$this->emetteur->ConstruireParCode($codeEmetteur);
    }

    public function GetCode()
    {
        return $this->code;
    }

    public function SetCode($code)
    {
        $this->code = $code;
    }

    public function GetDestinataire()
    {
        return $this->destinataire;
    }

    public function SetDestinataire($codeDestinataire)
    {
		$this->destinataire->ConstruireParCode($codeDestinataire);
    }

    public function GetDate()
    {
        $date = explode("-", $this->date);
		
		$libelleMois = array("", "Janvier", "F&eacute;vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "D&eacute;cembre");
		
		return $date[2]." ".$libelleMois[intval($date[1])]." ".$date[0];
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

    public function GetMessage()
    {
        return $this->message;
    }

    public function SetMessage($message)
    {
        $this->message = $message;
    }
	
	// Construire l'objet depuis la BDD
	public function Construire($codeEmetteur, $codeMessage, $codeDestinataire)
	{
		$bdd = GetConnexion();
		
		$sql = $bdd->prepare("SELECT DATE, HEURE, MESSAGE
							FROM MESSAGE
							WHERE CODE_UTILISATEUR_EMETTEUR = ?
							AND CODE_MESSAGE = ?
							AND CODE_UTILISATEUR_DESTINATAIRE = ?");
							
		$sql->execute(array($codeEmetteur, $codeMessage, $codeDestinataire));
							
		if($resultat = $sql->fetch())
		{
			$this->SetEmetteur($codeEmetteur);
			$this->code = $codeMessage;
			$this->SetDestinataire($codeDestinataire);
			$this->date = $resultat['DATE'];
			$this->heure = $resultat['HEURE'];
			$this->message = $resultat['MESSAGE'];
		}
	}
	
	// Ajouter un message
	public function Ajouter()
	{
		$bdd = GetConnexion();
		
		$sql = $bdd->prepare("INSERT INTO MESSAGE (CODE_UTILISATEUR_EMETTEUR, CODE_UTILISATEUR_DESTINATAIRE, DATE, HEURE, MESSAGE)
							VALUES(?, ?, ?, ?, ?)");
							
		$sql->execute(array($this->emetteur->GetCode(), $this->destinataire->GetCode(), $this->date, $this->heure, $this->message));
	}
	
	// Supprimer un message
	public function Supprimer()
	{
		
	}
}

?>