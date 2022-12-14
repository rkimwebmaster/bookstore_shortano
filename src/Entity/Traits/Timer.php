<?php
namespace App\Entity\Traits;
use Doctrine\ORM\Mapping as ORM;


trait Timer {
    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    
    #[ORM\PrePersist]
    public function misAJour(){
        dd('testons');
        $this->createdAt=new \Datetime();
    }

    #[ORM\PreUpdate]
    public function misAJour2(){
        $this->updatedAt=new \Datetime();
    }
    
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }
    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}