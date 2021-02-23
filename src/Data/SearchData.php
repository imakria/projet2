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

    /**
     * @var boolean
     */
    private $organisateur = false;

    /**
     * @var boolean
     */
    private $inscrit = false;


    /**
     * @var boolean
     */
    private $pasInscrit = false;

    /**
     * @var boolean
     */
    private $sortiesPassees = false;

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
     * @return bool
     */
    public function isOrganisateur(): bool
    {
        return $this->organisateur;
    }

    /**
     * @param bool $organisateur
     */
    public function setOrganisateur(bool $organisateur): void
    {
        $this->organisateur = $organisateur;
    }

    /**
     * @return bool
     */
    public function isInscrit(): bool
    {
        return $this->inscrit;
    }

    /**
     * @param bool $inscrit
     */
    public function setInscrit(bool $inscrit): void
    {
        $this->inscrit = $inscrit;
    }

    /**
     * @return bool
     */
    public function isPasInscrit(): bool
    {
        return $this->pasInscrit;
    }

    /**
     * @param bool $pasInscrit
     */
    public function setPasInscrit(bool $pasInscrit): void
    {
        $this->pasInscrit = $pasInscrit;
    }

    /**
     * @return bool
     */
    public function isSortiesPassees(): bool
    {
        return $this->sortiesPassees;
    }

    /**
     * @param bool $sortiesPassees
     */
    public function setSortiesPassees(bool $sortiesPassees): void
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