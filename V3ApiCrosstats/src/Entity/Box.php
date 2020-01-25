<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BoxRepository")
 */
class Box
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"detail"})
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"detail"})
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"detail"})
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"detail"})
     */
    private $siret;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"detail"})
     */
    private $certifate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserBoxId", mappedBy="boxId")
     */
    private $userBoxIds;

    public function __construct()
    {
        $this->userBoxIds = new ArrayCollection();
    }

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

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(?string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getCertifate(): ?bool
    {
        return $this->certifate;
    }

    public function setCertifate(?bool $certifate): self
    {
        $this->certifate = $certifate;

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
            $userBoxId->setBoxId($this);
        }

        return $this;
    }

    public function removeUserBoxId(UserBoxId $userBoxId): self
    {
        if ($this->userBoxIds->contains($userBoxId)) {
            $this->userBoxIds->removeElement($userBoxId);
            // set the owning side to null (unless already changed)
            if ($userBoxId->getBoxId() === $this) {
                $userBoxId->setBoxId(null);
            }
        }

        return $this;
    }
}
