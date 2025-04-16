<?php

namespace Aality\ReassuranceBundle\Entity\Configuration;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Configuration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private ?string $backgroundColor = null;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private ?string $textColor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    public function setBackgroundColor(?string $color): void
    {
        $this->backgroundColor = $color;
    }

    public function getTextColor(): ?string
    {
        return $this->textColor;
    }

    public function setTextColor(?string $color): void
    {
        $this->textColor = $color;
    }
}