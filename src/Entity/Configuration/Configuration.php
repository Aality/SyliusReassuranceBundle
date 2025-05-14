<?php

namespace Aality\SyliusReassuranceBundle\Entity\Configuration;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'aality_sylius_reassurance_configuration')]
class Configuration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    public const REASSURANCE_THEMES = [
        'Classique style' => 'classic',
        'Sylius style' => 'sylius'
    ];

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $reassuranceTheme = 'classic';

    public function getReassuranceTheme(): ?string
    {
        return $this->reassuranceTheme;
    }

    public function setReassuranceTheme(?string $reassuranceTheme): void
    {
        $this->reassuranceTheme = $reassuranceTheme;
    }

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private ?string $backgroundColor = null;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private ?string $titleColor = null;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private ?string $textColor = null;


    #[ORM\Column(type: 'integer', nullable: true)]
    private ?string $iconSize = null;


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

    public function getTitleColor(): ?string
    {
        return $this->titleColor;
    }

    public function setTitleColor(?string $color): void
    {
        $this->titleColor = $color;
    }

    public function getIconSize(): ?int
    {
        return $this->iconSize;
    }

    public function setIconSize(?int $size): void
    {
        $this->iconSize = $size;
    }
}
