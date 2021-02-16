<?php
namespace App\Data;

Class SearchData
{

    /**
     * @var string
     */
    public $campus = '';

    /**
     * @var string
     */
    public $nomContient = '';

    private $dateDebut;

    private $dateFin;

    private $organisateur;

    private $inscrit;

    private $pasInscrit;

    private $sortiesPassees;

    private $recherche;


    /**
     * @return string
     */
    public function getCampus(): string
    {
        return $this->campus;
    }

    /**
     * @param string|null $campus
     */
    public function setCampus(?string $campus): void
    {
        $this->campus = $campus;
    }

    /**
     * @return string
     */
    public function getNomContient(): string
    {
        return $this->nomContient;
    }

    /**
     * @param string|null $nomContient
     */
    public function setNomContient(?string $nomContient): void
    {
        $this->nomContient = $nomContient;
    }

    /**
     * @return mixed
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param mixed $dateDebut
     */
    public function setDateDebut($dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return mixed
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param mixed $dateFin
     */
    public function setDateFin($dateFin): void
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return mixed
     */
    public function getOrganisateur()
    {
        return $this->organisateur;
    }

    /**
     * @param mixed $organisateur
     */
    public function setOrganisateur($organisateur): void
    {
        $this->organisateur = $organisateur;
    }

    /**
     * @return mixed
     */
    public function getInscrit()
    {
        return $this->inscrit;
    }

    /**
     * @param mixed $inscrit
     */
    public function setInscrit($inscrit): void
    {
        $this->inscrit = $inscrit;
    }

    /**
     * @return mixed
     */
    public function getPasInscrit()
    {
        return $this->pasInscrit;
    }

    /**
     * @param mixed $pasInscrit
     */
    public function setPasInscrit($pasInscrit): void
    {
        $this->pasInscrit = $pasInscrit;
    }

    /**
     * @return mixed
     */
    public function getSortiesPassees()
    {
        return $this->sortiesPassees;
    }

    /**
     * @param mixed $sortiesPassees
     */
    public function setSortiesPassees($sortiesPassees): void
    {
        $this->sortiesPassees = $sortiesPassees;
    }

    /**
     * @return mixed
     */
    public function getRecherche()
    {
        return $this->recherche;
    }

    /**
     * @param mixed $recherche
     */
    public function setRecherche($recherche): void
    {
        $this->recherche = $recherche;
    }




}