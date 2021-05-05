<?php

namespace App\Entity\Base;
use App\Entity\Base\User;
use App\Repository\HoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HoteRepository::class)
 */
abstract class Hote extends User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function __construct()
    {
        parent::__construct();
        $this->roles = ['ROLE_HOTE'];
        $this->cabanes = new ArrayCollection();
    }


    public function getRoles(): array
    {
        return ['ROLE_HOTE'];
    }

    
}
