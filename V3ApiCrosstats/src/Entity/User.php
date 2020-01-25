<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ApiResource()
 * @UniqueEntity( fields={"email"},
 *     errorPath="email",
 *     message="Votre email est déja existant")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"detail"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"detail"})
     * @Assert\NotNull
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=255,unique=true)
     * @Groups({"detail"})
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"detail"})
     */
    private $cellphone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"detail"})
     * @Assert\Length(
     *      min = 6,
     *      max = 150,
     *      minMessage = "Votre mot de passe doit contenir au minimun {{ limit }} caractères ",
     *      maxMessage = "Votre mot de passe doit contenir au maximun {{ limit }} caractères"
     * )
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserRoleId", mappedBy="idUser")
     * @Groups({"detail"})
     * 
     */
    private $userRoleIds;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserBoxId", mappedBy="userId")
     * @Groups({"detail"})
     */
    private $userBoxIds;

    public function __construct()
    {
        $this->userRoleIds = new ArrayCollection();
        $this->userBoxIds = new ArrayCollection();
    }

   

  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

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

    public function getCellphone(): ?string
    {
        return $this->cellphone;
    }

    public function setCellphone(?string $cellphone): self
    {
        $this->cellphone = $cellphone;

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

     /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     */
    public function getRoles(){
        return ['ne pas prendre en compte cette valeur'];
    }

  
    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt(){
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername(){
        return $this->getEmail();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials(){
        return null;
    }

    /**
     * @return Collection|UserRoleId[]
     */
    public function getUserRoleIds(): Collection
    {
        return $this->userRoleIds;
    }

    public function addUserRoleId(UserRoleId $userRoleId): self
    {
        if (!$this->userRoleIds->contains($userRoleId)) {
            $this->userRoleIds[] = $userRoleId;
            $userRoleId->setIdUser($this);
        }

        return $this;
    }

    public function removeUserRoleId(UserRoleId $userRoleId): self
    {
        if ($this->userRoleIds->contains($userRoleId)) {
            $this->userRoleIds->removeElement($userRoleId);
            // set the owning side to null (unless already changed)
            if ($userRoleId->getIdUser() === $this) {
                $userRoleId->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserBoxId[]
     */
    public function getUserBoxIds(): Collection
    {
        return $this->userBoxIds;
    }

    public function addUserBoxId(UserBoxId $userBoxId): self
    {
        if (!$this->userBoxIds->contains($userBoxId)) {
            $this->userBoxIds[] = $userBoxId;
            $userBoxId->setUserId($this);
        }

        return $this;
    }

    public function removeUserBoxId(UserBoxId $userBoxId): self
    {
        if ($this->userBoxIds->contains($userBoxId)) {
            $this->userBoxIds->removeElement($userBoxId);
            // set the owning side to null (unless already changed)
            if ($userBoxId->getUserId() === $this) {
                $userBoxId->setUserId(null);
            }
        }

        return $this;
    }


}
