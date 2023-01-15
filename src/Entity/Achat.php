<?php

namespace App\Entity;

use App\Repository\AchatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AchatRepository::class)]
#[ORM\HasLifecycleCallbacks()]
class Achat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $etat = null;

    #[ORM\ManyToOne(inversedBy: 'achats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column]
    private ?bool $isLivre = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'achats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Livre $livre = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adresse $adresseLivraison = null;

    #[ORM\ManyToOne(inversedBy: 'achats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MobileMoney $mobileMoney = null;

    #[ORM\Column(nullable: true)]
    private ?float $montantTotal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $transId = null;

    // #[ORM\ManyToOne(inversedBy: 'achats')]
    // #[ORM\JoinColumn(nullable: false)]
    // private ?Shipment $shipment = null;


    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function misAJour(){
        $this->montantTotal= ($this->getQuantite() * $this->getLivre()->getPrix())/ 100;
    }

    public function __construct(User $user)
    {
        $this->date=new \DateTimeImmutable();
        // if(!$livre->isIsPrincipalRecent()){
        //     return 0;
        // }
        $this->user=$user;
        $this->quantite=1;
        $this->isLivre=false;
        $this->etat="en cours";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function isIsLivre(): ?bool
    {
        return $this->isLivre;
    }

    public function setIsLivre(bool $isLivre): self
    {
        $this->isLivre = $isLivre;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getLivre(): ?Livre
    {
        return $this->livre;
    }

    public function setLivre(?Livre $livre): self
    {
        $this->livre = $livre;

        return $this;
    }

    public function getAdresseLivraison(): ?Adresse
    {
        return $this->adresseLivraison;
    }

    public function setAdresseLivraison(Adresse $adresseLivraison): self
    {
        $this->adresseLivraison = $adresseLivraison;

        return $this;
    }

    public function getMobileMoney(): ?MobileMoney
    {
        return $this->mobileMoney;
    }

    public function setMobileMoney(?MobileMoney $mobileMoney): self
    {
        $this->mobileMoney = $mobileMoney;

        return $this;
    }

    public function getMontantTotal(): ?float
    {
        return $this->montantTotal;
    }

    public function setMontantTotal(?float $montantTotal): self
    {
        $this->montantTotal = $montantTotal;

        return $this;
    }

    public function getTransId(): ?string
    {
        return $this->transId;
    }

    public function setTransId(?string $transId): self
    {
        $this->transId = $transId;

        return $this;
    }
}
