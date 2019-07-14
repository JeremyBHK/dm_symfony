<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SerieRepository")
 */
class Serie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee_debut;

    /**
     * @ORM\Column(type="string", length=11)
     */
    private $annee_fin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_saisons;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie")
     * @ORM\JoinColumn(nullable=false, onDelete="SET NULL")
     */
    private $categorie_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAnneeDebut(): ?int
    {
        return $this->annee_debut;
    }

    public function setAnneeDebut(int $annee_debut): self
    {
        $this->annee_debut = $annee_debut;

        return $this;
    }

    public function getAnneeFin(): ?string
    {
        return $this->annee_fin;
    }

    public function setAnneeFin(string $annee_fin): self
    {
        $this->annee_fin = $annee_fin;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getNbSaisons(): ?int
    {
        return $this->nb_saisons;
    }

    public function setNbSaisons(int $nb_saisons): self
    {
        $this->nb_saisons = $nb_saisons;

        return $this;
    }

    public function getCategorieId(): ?Categorie
    {
        return $this->categorie_id;
    }

    public function setCategorieId(?Categorie $categorie_id): self
    {
        $this->categorie_id = $categorie_id;

        return $this;
    }
}
