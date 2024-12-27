<?php

namespace App\Entity;

use App\Repository\ProbarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProbarRepository::class)]
class Probar {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, Programa>
     */
    #[ORM\ManyToMany(targetEntity: Programa::class, inversedBy: 'probars')]
    private Collection $programas;

    public function __construct() {
        $this->programas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, Programa>
     */
    public function getProgramas(): Collection
    {
        return $this->programas;
    }

    public function addPrograma(Programa $programa): static
    {
        if (!$this->programas->contains($programa)) {
            $this->programas->add($programa);
        }

        return $this;
    }

    public function removePrograma(Programa $programa): static
    {
        $this->programas->removeElement($programa);

        return $this;
    }
}
