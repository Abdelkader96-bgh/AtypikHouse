<?php

namespace App\Entity\Base;

use App\Repository\PartnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=PartnerRepository::class)
 */
 class Partner 
                  {
                   /**
                    * @ORM\Id
                    * @ORM\GeneratedValue
                    * @ORM\Column(type="integer")
                    */private $id;
                                 
                   /**
                    * @ORM\Column(type="string", length=255)
                    */
                    private $nom;
                                 
                      /**
                       * @ORM\Column(type="string", length=255)
                       */
                       private $prenom;              
                                 
                                     /**
                                      * @ORM\Column(type="string", length=255)
                                      */
                                    private $email;
                                 
                                 
                                 
                                     /**
                                      * @ORM\Column(type="integer")
                                      */
                                     private $telephone;
                                 
                                     /**
                                      * @ORM\Column(type="string", length=255)
                                      */
                                     private $nom_entreprise;
                                 
                                     /**
                                      * @ORM\Column(type="string", length=255)
                                      */
                                     private $statut;
                                 
                                     /**
                                      * @ORM\Column(type="integer")
                                      */
                                     private $codePostal;
                                 
                                     /**
                                      * @ORM\Column(type="string", length=255)
                                      */
                                     private $ville;
                                 
                                     /**
                                      * @ORM\Column(type="string", length=255)
                                      */
                                     private $departement;
                                 
                                     /**
                                      * @ORM\Column(type="string", length=255)
                                      */
                                     private $regeion;
                                 
                                     /**
                                      * @ORM\Column(type="array", length=255)
                                      */
                                     private $typologie;
                                 
                                      /**
                                      * @ORM\Column(type="datetime", nullable=true)
                                      */
                                     protected $createdAt;
                                 
                                     /**
                                      * @ORM\Column(type="string", length=255)
                                      */
                                     private $commentaire;
                                 
                                     /**
                                      * @ORM\Column(type="array", length=255)
                                      */
                                     private $partenaire;
               
                                     /**
                                      * @ORM\OneToMany(targetEntity=Images::class, mappedBy="partner" ,cascade={"persist"})
                                      */
                                     private $images;
            
                                     public function __construct()
                                     {
                                         $this->images = new ArrayCollection();
                                     }
                                 
                                  
                              
                                     
                                 
                                     public function getId(): ?int
                                     {
                                         return $this->id;
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
                                 
                                     public function getPrenom(): ?string
                                     {
                                         return $this->prenom;
                                     }
                                 
                                     public function setPrenom(string $prenom): self
                                     {
                                         $this->prenom = $prenom;
                                 
                                         return $this;
                                     }
                                 
                                     public function getEmail(): ?string
                                     {
                                         return $this->email;
                                     }
                                 
                                   public function setEmail(string $email): self
                                     {
                                         $this->email = $email;
                                 
                                         return $this;
                                      } 
                                 
                                     public function getTelephone(): ?string
                                     {
                                         return $this->telephone;
                                     }
                                 
                                     public function setTelephone(string $telephone): self
                                     {
                                         $this->telephone = $telephone;
                                 
                                         return $this;
                                     }
                                 
                                     public function getNomEntreprise(): ?string
                                     {
                                         return $this->nom_entreprise;
                                     }
                                 
                                     public function setNomEntreprise(string $nom_entreprise): self
                                     {
                                         $this->nom_entreprise = $nom_entreprise;
                                 
                                         return $this;
                                     }
                                 
                                     public function getStatut(): ?string
                                     {
                                         return $this->statut;
                                     }
                                 
                                     public function setStatut(string $statut): self
                                     {
                                         $this->statut = $statut;
                                 
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
                                 
                                     public function getCodePostal(): ?int
                                     {
                                         return $this->codePostal;
                                     }
                                 
                                     public function setCodePostal(int $codePostal): self
                                     {
                                         $this->codePostal = $codePostal;
                                 
                                         return $this;
                                     }
                                 
                                     public function getVille(): ?string
                                     {
                                         return $this->ville;
                                     }
                                 
                                     public function setVille(string $ville): self
                                     {
                                         $this->ville = $ville;
                                 
                                         return $this;
                                     }
                                 
                                     public function getDepartement(): ?string
                                     {
                                         return $this->departement;
                                     }
                                 
                                     public function setDepartement(string $departement): self
                                     {
                                         $this->departement = $departement;
                                 
                                         return $this;
                                     }
                                 
                                     public function getRegeion(): ?string
                                     {
                                         return $this->regeion;
                                     }
                                 
                                     public function setRegeion(string $regeion): self
                                     {
                                         $this->regeion = $regeion;
                                 
                                         return $this;
                                     }
                                 
                                     public function getTypologie(): ?array
                                     {
                                         return $this->typologie;
                                     }
                                 
                                     public function setTypologie(array $typologie): self
                                     {
                                         $this->typologie = $typologie;
                                 
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
                                 
                                     public function getPartenaire(): ?array
                                     {
                                         return $this->partenaire;
                                     }
                                 
                                     public function setPartenaire(array $partenaire): self
                                     {
                                         $this->partenaire = $partenaire;
                                 
                                         return $this;
                                     }
                     
                      
                                               
                               
                       
                    public function getStatus()
                                     {
                                         
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
                                             $image->setPartner($this);
                                         }
   
                                         return $this;
                                     }

                                     public function removeImage(Images $image): self
                                     {
                                         if ($this->images->removeElement($image)) {
                                             // set the owning side to null (unless already changed)
                                             if ($image->getPartner() === $this) {
                                                 $image->setPartner(null);
                                             }
                                         }

                                         return $this;
                                     }
                                 
                    }
