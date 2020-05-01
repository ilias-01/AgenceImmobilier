<?php

namespace App\Entity;

use App\Repository\PropertyLikeRepository;
use App\Repository\PropertyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyLikeRepository")
 */
class PropertyLike
{
    private $propertyLikeRep;
    private $propertyRep;

    public function __construct(PropertyLikeRepository $propertyLikeRep,PropertyRepository $propertyRep)
    {
        $this->propertyLikeRep = $propertyLikeRep;
        $this->propertyRep = $propertyRep;
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Property", inversedBy="likes")
     */
    private $property;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="likes")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProperty(): ?Property
    {
        return $this->property;
    }

    public function setProperty(?Property $property): self
    {
        $this->property = $property;

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
    public function __toString()
    {
        return $this->user->getUsername();
    }
    // public function __toString()
    // {
    //     $property_ids = $this->propertyLikeRep->findByUser($this->id);
    //     $properties=[];
        
    //     foreach($property_ids as $id)
    //     {
    //         $properties[]=$this->propertyRep->findById($id);
    //     }

    //     return $properties;
    // }
}
