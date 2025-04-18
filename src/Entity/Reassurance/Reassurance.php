<?php

namespace Aality\ReassuranceBundle\Entity\Reassurance;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Aality\ReassuranceBundle\Repository\ReassuranceRepository;

#[ORM\Entity(repositoryClass: ReassuranceRepository::class)]
class Reassurance implements ReassuranceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $title = null;


    #[Assert\NotBlank]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $image = null;

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

}
