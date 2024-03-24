<?php

namespace App\Entity;

use App\Repository\MusicBandRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MusicBandRepository::class)]
class MusicBand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $origin = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[Assert\NotBlank]
    #[ORM\Column]
    private ?int $foundation_year = null;

    #[ORM\Column(nullable: true)]
    private ?int $separation_year = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $founders = null;

    #[ORM\Column(nullable: true)]
    private ?int $total_members = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $style = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): static
    {
        $this->origin = $origin;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getFoundationYear(): ?int
    {
        return $this->foundation_year;
    }

    public function setFoundationYear(int $foundation_year): static
    {
        $this->foundation_year = $foundation_year;

        return $this;
    }

    public function getSeparationYear(): ?int
    {
        return $this->separation_year;
    }

    public function setSeparationYear(?int $separation_year): static
    {
        $this->separation_year = $separation_year;

        return $this;
    }

    public function getFounders(): ?string
    {
        return $this->founders;
    }

    public function setFounders(?string $founders): static
    {
        $this->founders = $founders;

        return $this;
    }

    public function getTotalMembers(): ?int
    {
        return $this->total_members;
    }

    public function setTotalMembers(?int $total_members): static
    {
        $this->total_members = $total_members;

        return $this;
    }

    public function getStyle(): ?string
    {
        return $this->style;
    }

    public function setStyle(?string $style): static
    {
        $this->style = $style;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
