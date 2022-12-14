<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $sousTitre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateParution = null;

    #[ORM\Column]
    private ?int $nombreCopieVendues = null;

    #[ORM\Column]
    private ?int $nombreCopieImprimees = null;

    #[ORM\Column]
    private ?int $nombreTasseCafes = null;

    #[ORM\Column]
    private ?int $nombreLecteurSatisfaits = null;

    #[ORM\Column(length: 255)]
    private ?string $imagePrincipale = null;

    #[ORM\Column(length: 255)]
    private ?string $imageSecondaire = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $APropos = null;

    #[ORM\OneToMany(mappedBy: 'livre', targetEntity: Chapitre::class, orphanRemoval: true ,cascade:["persist"])]
    private Collection $chapitres;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $prix = null;

    #[ORM\Column]
    private ?bool $isPrincipalRecent = null;

    #[ORM\OneToMany(mappedBy: 'livre', targetEntity: Achat::class)]
    private Collection $achats;

    
    public function __toString()
    {
        return $this->titre;
    }

    public function __construct()
    {
        $this->chapitres = new ArrayCollection();
        $this->isPrincipalRecent=false;
        $this->achats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSousTitre(): ?string
    {
        return $this->sousTitre;
    }

    public function setSousTitre(string $sousTitre): self
    {
        $this->sousTitre = $sousTitre;

        return $this;
    }

    public function getDateParution(): ?\DateTimeInterface
    {
        return $this->dateParution;
    }

    public function setDateParution(\DateTimeInterface $dateParution): self
    {
        $this->dateParution = $dateParution;

        return $this;
    }

    public function getNombreCopieVendues(): ?int
    {
        return $this->nombreCopieVendues;
    }

    public function setNombreCopieVendues(int $nombreCopieVendues): self
    {
        $this->nombreCopieVendues = $nombreCopieVendues;

        return $this;
    }

    public function getNombreCopieImprimees(): ?int
    {
        return $this->nombreCopieImprimees;
    }

    public function setNombreCopieImprimees(int $nombreCopieImprimees): self
    {
        $this->nombreCopieImprimees = $nombreCopieImprimees;

        return $this;
    }

    public function getNombreTasseCafes(): ?int
    {
        return $this->nombreTasseCafes;
    }

    public function setNombreTasseCafes(int $nombreTasseCafes): self
    {
        $this->nombreTasseCafes = $nombreTasseCafes;

        return $this;
    }

    public function getNombreLecteurSatisfaits(): ?int
    {
        return $this->nombreLecteurSatisfaits;
    }

    public function setNombreLecteurSatisfaits(int $nombreLecteurSatisfaits): self
    {
        $this->nombreLecteurSatisfaits = $nombreLecteurSatisfaits;

        return $this;
    }

    public function getImagePrincipale(): ?string
    {
        return $this->imagePrincipale;
    }

    public function setImagePrincipale(string $imagePrincipale): self
    {
        $this->imagePrincipale = $imagePrincipale;

        return $this;
    }

    public function getImageSecondaire(): ?string
    {
        return $this->imageSecondaire;
    }

    public function setImageSecondaire(string $imageSecondaire): self
    {
        $this->imageSecondaire = $imageSecondaire;

        return $this;
    }

    public function getAPropos(): ?string
    {
        return $this->APropos;
    }

    public function setAPropos(string $APropos): self
    {
        $this->APropos = $APropos;

        return $this;
    }

    /**
     * @return Collection<int, Chapitre>
     */
    public function getChapitres(): Collection
    {
        return $this->chapitres;
    }

    public function addChapitre(Chapitre $chapitre): self
    {
        if (!$this->chapitres->contains($chapitre)) {
            $this->chapitres->add($chapitre);
            $chapitre->setLivre($this);
        }

        return $this;
    }

    public function removeChapitre(Chapitre $chapitre): self
    {
        if ($this->chapitres->removeElement($chapitre)) {
            // set the owning side to null (unless already changed)
            if ($chapitre->getLivre() === $this) {
                $chapitre->setLivre(null);
            }
        }

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function isIsPrincipalRecent(): ?bool
    {
        return $this->isPrincipalRecent;
    }

    public function setIsPrincipalRecent(bool $isPrincipalRecent): self
    {
        $this->isPrincipalRecent = $isPrincipalRecent;

        return $this;
    }

    /**
     * @return Collection<int, Achat>
     */
    public function getAchats(): Collection
    {
        return $this->achats;
    }

    public function addAchat(Achat $achat): self
    {
        if (!$this->achats->contains($achat)) {
            $this->achats->add($achat);
            $achat->setLivre($this);
        }

        return $this;
    }

    public function removeAchat(Achat $achat): self
    {
        if ($this->achats->removeElement($achat)) {
            // set the owning side to null (unless already changed)
            if ($achat->getLivre() === $this) {
                $achat->setLivre(null);
            }
        }

        return $this;
    }
}
