<?php

namespace App\Entity\Base;

use App\Repository\PointVueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PointVueRepository::class)
 */
class PointVue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $autheur;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity=Cabane::class, inversedBy="pointVues")
     */
    private $cabane;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAutheur(): ?string
    {
        return $this->autheur;
    }

    public function setAutheur(string $autheur): self
    {
        $this->autheur = $autheur;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getCabane(): ?Cabane
    {
        return $this->cabane;
    }

    public function setCabane(?Cabane $cabane): self
    {
        $this->cabane = $cabane;

        return $this;
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
}
