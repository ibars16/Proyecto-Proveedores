<?php

namespace App\Entity;

use App\Repository\ARepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ARepository::class)
 */
class A
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $a;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getA(): ?\DateTimeInterface
    {
        return $this->a;
    }

    public function setA(\DateTimeInterface $a): self
    {
        $this->a = $a;

        return $this;
    }
}
