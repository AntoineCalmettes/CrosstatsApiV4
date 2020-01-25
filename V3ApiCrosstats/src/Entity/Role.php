<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role
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
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserRoleId", mappedBy="idRole")
     */
    private $userRoleIds;

    public function __construct()
    {
        $this->userRoleIds = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
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
            $userRoleId->setIdRole($this);
        }

        return $this;
    }

    public function removeUserRoleId(UserRoleId $userRoleId): self
    {
        if ($this->userRoleIds->contains($userRoleId)) {
            $this->userRoleIds->removeElement($userRoleId);
            // set the owning side to null (unless already changed)
            if ($userRoleId->getIdRole() === $this) {
                $userRoleId->setIdRole(null);
            }
        }

        return $this;
    }

    

   
}
