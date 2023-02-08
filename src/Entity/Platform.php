<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PlatformRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    paginationItemsPerPage: 5,
    normalizationContext: ['groups' => ['Platform:read']],
    denormalizationContext: ['groups' => ['Platform:write']],
)]

#[ORM\Entity(repositoryClass: PlatformRepository::class)]
class Platform
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['Platform:read'])]
    private ?int $id = null;

    #[Groups(['Platform:read', 'Platform:write'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['Platform:read', 'Platform:write'])]
    #[ORM\ManyToMany(targetEntity: Film::class, inversedBy: 'platforms')]
    private Collection $Film;


    public function __construct()
    {
        $this->Film = new ArrayCollection();
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


    /**
     * @return Collection<int, Film>
     */
    public function getFilm(): Collection
    {
        return $this->Film;
    }

    public function addFilm(Film $film): self
    {
        if (!$this->Film->contains($film)) {
            $this->Film->add($film);
        }

        return $this;
    }

    public function removeFilm(Film $film): self
    {
        $this->Film->removeElement($film);

        return $this;
    }
}
