<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pour que l'user sera sauvegarder au niveau de la session on utilise l'interface Serializable
 * Pour que cette classe sera reconnu par l'orm comme classe des utilisateur, on implemente UserInterface
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface,\Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @Assert\EqualTo("propertyPath=password",message="Vous n'avez pas tapez le même mot de passe")
     */
    private $confirmPassword;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PropertyLike", mappedBy="user")
     */
    private $likes;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
    }
    public function getConfirmPassword(): ?int
    {
        return $this->id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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
    public function setConfirmPassword(string $password): self
    {
        $this->confirmPassword= $password;

        return $this;
    }

    /**
     * @return (Role|string)[] the user roles
     */
    public function getRoles()
    {
        return ['ROLE_ADMIN'];
    }

    /**
     * @return string|null the salt
     */
    public function getSalt()
    {
        return null;
    }
    
    public function eraseCredentials()
    {
        
    }
    
    public function __toString()
    {
        return $this->username;
    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
    }
    /**
     * @param string $serialized <p>
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password
        )=unserialize($serialized,['allowed_classes' => false]);
    }

    /**
     * @return Collection|PropertyLike[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(PropertyLike $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setUser($this);
        }

        return $this;
    }

    public function removeLike(PropertyLike $like): self
    {
        if ($this->likes->contains($like)) {
            $this->likes->removeElement($like);
            // set the owning side to null (unless already changed)
            if ($like->getUser() === $this) {
                $like->setUser(null);
            }
        }

        return $this;
    }
}
