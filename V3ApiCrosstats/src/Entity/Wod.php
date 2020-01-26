<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\WodRepository")
 */
class Wod
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\WodType", mappedBy="wod")
     */
    private $wodType;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="wod")
     */
    private $user;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $totalTime;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modifiedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $score;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $partage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $partageAll;

    public function __construct()
    {
        $this->wodType = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|WodType[]
     */
    public function getWodType(): Collection
    {
        return $this->wodType;
    }

    public function addWodType(WodType $wodType): self
    {
        if (!$this->wodType->contains($wodType)) {
            $this->wodType[] = $wodType;
            $wodType->setWod($this);
        }

        return $this;
    }

    public function removeWodType(WodType $wodType): self
    {
        if ($this->wodType->contains($wodType)) {
            $this->wodType->removeElement($wodType);
            // set the owning side to null (unless already changed)
            if ($wodType->getWod() === $this) {
                $wodType->setWod(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setWod($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getWod() === $this) {
                $user->setWod(null);
            }
        }

        return $this;
    }

    public function getTotalTime(): ?\DateTimeInterface
    {
        return $this->totalTime;
    }

    public function setTotalTime(?\DateTimeInterface $totalTime): self
    {
        $this->totalTime = $totalTime;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(?\DateTimeInterface $modifiedAt): self
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(?string $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getPartage(): ?bool
    {
        return $this->partage;
    }

    public function setPartage(?bool $partage): self
    {
        $this->partage = $partage;

        return $this;
    }

    public function getPartageAll(): ?bool
    {
        return $this->partageAll;
    }

    public function setPartageAll(?bool $partageAll): self
    {
        $this->partageAll = $partageAll;

        return $this;
    }
}
