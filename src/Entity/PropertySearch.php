<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch
{
    /**
     * @Assert\Range(min=100000)
     * @var int|null
     */
    private $maxPrice;


    /**
     * @Assert\Range(min=20,max=400)
     * @var int|null
     */
    private $minSurface;
    
    /**
     * @var ArrayCollection
     */
    private $options;

    public function __construct()
    {   
        $this->options = new ArrayCollection();
    }


    /**
     * 
     * @return ArrayCollection
     */
    public function getOptions():ArrayCollection
    {   
        return $this->options;
    }
    
    /**
     * 
     * @param ArrayCollection
     */
    public function setOptions(ArrayCollection $options):void
    {   
       $this->options=$options;
    }
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(int $maxPrice): self
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    public function setMinSurface(int $minSurface): self
    {
        $this->minSurface = $minSurface;

        return $this;
    }
}
