<?php

namespace App\Entity\Base;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Base\Cabane;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(
 *  fields={"email"},
 *  message="l'email que vous indiqué est déjà utilisé!"
 * )
 */
 class User implements UserInterface  
                     {
                         /**
                          * @ORM\Id
                          * @ORM\GeneratedValue(strategy="AUTO")
                          * @ORM\Column(type="integer")
                          */
                         private $id;
                     
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
                          * @Assert\Length(min="8",minMessage="votre mot de passe doit faire 8 caractères minimum")
                          * @Assert\EqualTo(propertyPath="confirm_password")
                          */
                         private $password;
                     
                         /**
                          * @ORM\Column(type="string", length=255)
                          * @Assert\EqualTo(propertyPath="password")
                          */
                         public $confirm_password;
                     
                         /**
                          * @ORM\Column(name="is_active",type="boolean")
                          */
                         private $isActive;
                     
                         /**
                          * @ORM\Column(type="string", length=255,unique=true)
                          * @Assert\NotBlank()
                          * @Assert\Email()
                          */
                         private $email;
                     
                          /**
                          * @ORM\Column(name="roles" ,type="json")
                          */
                           private $roles=[];
           
                           /**
                            * @ORM\OneToMany(targetEntity=Cabane::class, mappedBy="user")
                            * @ORM\OrderBy({"createdAt" = "DESC"})
                            */
                         
                           private $cabanes;
                   
                         public function __construct()
                         {
                            
                             $this->isActive=true;
                            $this->cabanes = new ArrayCollection();
                             
                         }
                     
                         public function getUsername(){
                             return $this->email;
                         }
                         public function getSalt() {
                             return null;
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
                         public function getPassword(): ?string
                         {
                             return $this->password;
                         }
                     
                         public function setPassword(string $password): self
                         {
                             $this->password = $password;
                     
                             return $this;
                         }
                     
                         public function getIsActive() {
                             return $this->isActive;
                         }
                     
                          public function setIsActive( $isActive) {
                             $this->isActive = $isActive;
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
                        
                         public function getRoles(): array {
                             $roles =$this->roles;
                             $roles[]= 'ROLE_USER';
                            return array_unique($roles);
                         }
                                
                            public function setRoles(array $roles): self
                            {
                                $this->roles =$roles;
                                return $this;
                            }
                     
                         function addRole($role) {
                             $this->roles[] = $role;
                         }
                        
                     
                     
                         public function eraseCredentials() {
                            
                         }
                        
                         /** @see \Serializable::serialize() */
                         public function serialize() {
                             return serialize(array(
                                 $this->id,
                                 $this->email,
                                 $this->password,
                                 $this->isActive,
                                     // see section on salt below
                                     // $this->salt,
                             ));
                         }
                     
                         /** @see \Serializable::unserialize() */
                         public function unserialize($serialized) {
                             list (
                                     $this->id,
                                     $this->email,
                                     $this->password,
                                     $this->isActive,
                                     // see section on salt below
                                     // $this->salt
                                     ) = unserialize($serialized);
                         }
      
                         /**
                         * @return Collection|Cabane[]
                         */
                      
                         public function getCabanes(): Collection
                         {
                             return $this->cabanes;
                         }
   
                         public function addCabane(Cabane $cabane): self
                         {
                             if (!$this->cabanes->contains($cabane)) {
                                 $this->cabanes[] = $cabane;
                                 $cabane->setUser($this);
                             }
   
                             return $this;
                         }

                         public function removeCabane(Cabane $cabane): self
                         {
                             if ($this->cabanes->removeElement($cabane)) {
                                 // set the owning side to null (unless already changed)
                                 if ($cabane->getUser() === $this) {
                                     $cabane->setUser(null);
                                 }
                             }

                             return $this;
                         }
                     
                      
                     
                     }
