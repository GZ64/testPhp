<?php

namespace Models;

use \Date;

class Hebergement {
	
	protected $idcamping = 0;
	protected $prix;
	protected $date;
	protected $type_hebergement = '';
	protected $gamme;
	protected $nom_hebergement;
	
	public function __construct($data) {
		$this->hydrate($data);
	}
	
	/* les getters */
	public function getIdcamping() {
		return $this->idcamping;
	}
	
	public function getType_hebergement() {
		return $this->type_hebergement;
	}
	
	public function getDate() {
		if ($this->date != NULL) {
			return $this->date->format('d M Y');
		}
	}
	
	public function getPrix() {
		return $this->prix;
	}
	
	public function getGamme() {
		return $this->gamme;
	}
	
	public function getNom_hebergement() {
		return $this->gamme;
	}
	
	/* les setters */
	public function setIdcamping($id) {
		if (!is_string($id)) // S'il ne s'agit pas d'un string.
		{
			if ($id != NULL) {
				trigger_error('Mauvais type de donnée: String attendu', E_WARNING);
				return;
			}
		} else {
			$this->idcamping = htmlspecialchars($id);
		}
	}
	
	public function setType_hebergement($type) {
		if (!is_string($type)) {
			if ($type != NULL) {
				trigger_error('Mauvais type de donnée: String attendu', E_WARNING);
				return;
			}
		} else {
			$this->type_hebergement = htmlspecialchars($type);
		}
	}
	
	public function setDate($date) {
		if (!is_string($date)) {
			if ($date != NULL) {
				trigger_error('Mauvais type de donnée: String attendu', E_WARNING);
				return;
			}
		} else {
			$this->date = new \library\core\DateTimeFrench($date);
		}
	}
	
	public function setPrix($prix) {
		if (!is_string($prix)) {
			if ($prix != NULL) {
				trigger_error('Mauvais type de donnée: String attendu', E_WARNING);
				return;
			}
		} else {
			$this->prix = htmlspecialchars($prix);
		}
	}
	
	public function setGamme($gamme) {
		if (!is_string($gamme)) {
			if ($gamme != NULL) {
				trigger_error('Mauvais type de donnée: String attendu', E_WARNING);
				return;
			}
		} else {
			$this->gamme = htmlspecialchars($gamme);
		}
	}
	
	public function setNom_hebergement($nomHebergement) {
		if (!is_string($nomHebergement)) {
			if ($nomHebergement != NULL) {
				trigger_error('Mauvais type de donnée: String attendu', E_WARNING);
				return;
			}
		} else {
			$this->gamme = htmlspecialchars($nomHebergement);
		}
	}
	
	public function hydrate(array $donnees) {
		foreach ($donnees as $key => $value) {
			// On récupère le nom du setter correspondant à l'attribut.
			$method = 'set' . ucfirst($key);
			
			// Si le setter correspondant existe.
			if (method_exists($this, $method)) {
				// On appelle le setter.
				$this->$method($value);
			}
		}
	}
}