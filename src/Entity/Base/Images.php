<?php

namespace App\Entity\Base;

use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=ImagesRepository::class) 
 */
class Images
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Cabane::class, inversedBy="images")
     */
    private $cabanes;

    /**
     * @ORM\ManyToOne(targetEntity=Partner::class, inversedBy="images")
     */
    private $partner;

   

   

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

    public function getCabanes(): ?Cabane
    {
        return $this->cabanes;
    }

    public function setCabanes(?Cabane $cabanes): self
    {
        $this->cabanes = $cabanes;

        return $this;
    }

    public function getPartner(): ?Partner
    {
        return $this->partner;
    }

    public function setPartner(?Partner $partner): self
    {
        $this->partner = $partner;

        return $this;
    }

    

}
