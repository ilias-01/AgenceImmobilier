<?php

namespace App\Entity;
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
