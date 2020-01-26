<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserBoxIdRepository")
 */
class UserBoxId
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Box", inversedBy="userBoxIds",cascade={"persist"})
     * @Groups({"detail"})
     */
    private $boxId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userBoxIds")
     */
    private $userId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBoxId(): ?Box
    {
        return $this->boxId;
    }

    public function setBoxId(?Box $boxId): self
    {
        $this->boxId = $boxId;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }
}
