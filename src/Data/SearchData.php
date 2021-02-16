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
     * @return string
     */
    public function getCampus(): string
    {
        return $this->campus;
    }

    /**
     * @param string $campus
     */
    public function setCampus(string $campus): void
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
     * @param string $nomContient
     */
    public function setNomContient(string $nomContient): void
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




}