<?php
include_once("sql.php");

// Liste d'utilisateurs
class ListeUtilisateurs
{
	private $liste;
	
	// Construire la liste
	public function Construire()
	{
		$this->liste = array();
		$bdd = GetConnexion();
		
		$sql = $bdd->query("SELECT CODE_UTILISATEUR
							FROM UTILISATEUR");
							
		while($resultat = $sql->fetch())
		{
			$utilisateur = new Utilisateur();
			$utilisateur->ConstruireParCode($resultat["CODE_UTILISATEUR"]);
			array_push($this->liste, $utilisateur);
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
class Utilisateur
{
    private $code;
    private $nom;
    private $prenom;
    private $pseudo;
    private $motDePasse;

    public function GetCode()
    {
        return $this->code;
    }

    public function SetCode($code)
    {
        $this->code = $code;
    }

    public function GetNom()
    {
        return $this->nom;
    }

    public function SetNom($nom)
    {
        $this->nom = $nom;
    }

    public function GetPrenom()
    {
        return $this->prenom;
    }

    public function SetPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function GetPseudo()
    {
        return $this->pseudo;
    }

    public function SetPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function GetMotDePasse()
    {
        return $this->motDePasse;
    }

    public function SetMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }
	
	// Construire l'objet depuis la BDD
	public function ConstruireParCode($code)
	{
		$bdd = GetConnexion();
		
		$sql = $bdd->prepare("SELECT NOM, PRENOM, PSEUDO, MOT_DE_PASSE
							FROM UTILISATEUR
							WHERE CODE_UTILISATEUR = ?");
							
		$sql->execute(array($code));
							
		if($resultat = $sql->fetch())
		{
			$this->code = $code;
			$this->nom = $resultat['NOM'];
			$this->prenom = $resultat['PRENOM'];
			$this->pseudo = $resultat['PSEUDO'];
			$this->motDePasse = $resultat['MOT_DE_PASSE'];
		}
	}
	
	// Construire l'objet depuis la BDD
	public function ConstruireParPseudo($pseudo)
	{
		$bdd = GetConnexion();
		
		$sql = $bdd->prepare("SELECT CODE_UTILISATEUR, NOM, PRENOM, MOT_DE_PASSE
							FROM UTILISATEUR
							WHERE PSEUDO = ?");
							
		$sql->execute(array($pseudo));
							
		if($resultat = $sql->fetch())
		{
			$this->code = $resultat['CODE_UTILISATEUR'];
			$this->nom = $resultat['NOM'];
			$this->prenom = $resultat['PRENOM'];
			$this->pseudo = $pseudo;
			$this->motDePasse = $resultat['MOT_DE_PASSE'];
		}
	}
	
	// Vérifier si l'utilisateur existe
	public function Verifier($pseudo, $motDePasse)
	{
		$retour = false;
		$bdd = GetConnexion();
		
		$sql = $bdd->prepare("SELECT CODE_UTILISATEUR
							FROM UTILISATEUR
							WHERE PSEUDO = ?
							AND MOT_DE_PASSE = ?");
							
		$sql->execute(array($pseudo, $motDePasse));
							
		if($sql->rowCount() == 1)
		{
			$retour = true;
		}
		
		return $retour;
	}
	
	// Vérifier si l'utilisateur existe
	public function Existe($pseudo)
	{
		$retour = false;
		$bdd = GetConnexion();
		
		$sql = $bdd->prepare("SELECT CODE_UTILISATEUR
							FROM UTILISATEUR
							WHERE PSEUDO = ?");
							
		$sql->execute(array($pseudo));
							
		if($sql->rowCount() == 1)
		{
			$retour = true;
		}
		
		return $retour;
	}
}
?>