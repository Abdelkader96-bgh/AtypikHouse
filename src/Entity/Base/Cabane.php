<?php

namespace App\Entity\Base;

use App\Repository\CabaneRepository;
use App\Entity\Base\User;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CabaneRepository::class)
 */
class Cabane
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
    private $destination;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDisponible;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNondisponible;

    /**
     * @ORM\Column(type="text")
     */
    private $equipment;

    /**
     * @ORM\Column(type="text")
     */
    private $activite;

    /**
     * @ORM\Column(type="text")
     */
    private $commentaire;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;


    /**
     * @ORM\Column(type="text")
     */
    private $seRestaurer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrPlace;

    /**
     * @ORM\Column(type="float")
     */
    private $hauteur;

    /**
     * @ORM\OneToMany(targetEntity=PointVue::class, mappedBy="cabane")
     */
    private $pointVues;

    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="cabanes", orphanRemoval=true, cascade={"persist"})
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * 
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="cabanes")
     * @ORM\JoinColumn(nullable=true,referencedColumnName="id")
     */
    protected $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getDateDisponible(): ?\DateTimeInterface
    {
        return $this->dateDisponible;
    }

    public function setDateDisponible(\DateTimeInterface $dateDisponible): self
    {
        $this->dateDisponible = $dateDisponible;

        return $this;
    }

    public function getDateNondisponible(): ?\DateTimeInterface
    {
        return $this->dateNondisponible;
    }

    public function setDateNondisponible(\DateTimeInterface $dateNondisponible): self
    {
        $this->dateNondisponible = $dateNondisponible;

        return $this;
    }

    public function getEquipment(): ?string
    {
        return $this->equipment;
    }

    public function setEquipment(string $equipment): self
    {
        $this->equipment = $equipment;

        return $this;
    }

    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(string $activite): self
    {
        $this->activite = $activite;

        return $this;
    }
    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getHauteur(): ?float
    {
        return $this->hauteur;
    }

    public function setHauteur(float $hauteur): self
    {
        $this->hauteur = $hauteur;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

   

    public function getSeRestaurer(): ?string
    {
        return $this->seRestaurer;
    }

    public function setSeRestaurer(string $seRestaurer): self
    {
        $this->seRestaurer = $seRestaurer;

        return $this;
    }


    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNbrPlace(): ?int
    {
        return $this->nbrPlace;
    }

    public function setNbrPlace(int $nbrPlace): self
    {
        $this->nbrPlace = $nbrPlace;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|PointVue[]
     */
    public function getPointVues(): Collection
    {
        return $this->pointVues;
    }

    public function addPointVue(PointVue $pointVue): self
    {
        if (!$this->pointVues->contains($pointVue)) {
            $this->pointVues[] = $pointVue;
            $pointVue->setCabane($this);
        }

        return $this;
    }

    public function removePointVue(PointVue $pointVue): self
    {
        if ($this->pointVues->removeElement($pointVue)) {
            // set the owning side to null (unless already changed)
            if ($pointVue->getCabane() === $this) {
                $pointVue->setCabane(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Images[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setCabanes($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getCabanes() === $this) {
                $image->setCabanes(null);
            }
        }

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
   
    
}
