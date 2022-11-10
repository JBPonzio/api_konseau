<?php

namespace App\Entity;

use App\Repository\ConsommationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'consommation')]
#[ORM\Entity(repositoryClass: ConsommationRepository::class)]
class Consommation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'csm_id')]
    private ?int $id = null;

    #[ORM\Column(name: 'csm_litres', nullable: false)]
    private ?int $csm_litres = null;

    #[ORM\Column(name: 'csm_date', type: Types::DATE_MUTABLE, nullable: false)]
    private ?\DateTimeInterface $csm_date = null;

    #[ORM\ManyToOne(inversedBy: 'foy_consommations')]
    #[ORM\JoinColumn(name: "foyer_id", referencedColumnName: "foy_id" ,nullable: false)]
    private ?Foyer $csm_foyer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCsmLitres(): ?int
    {
        return $this->csm_litres;
    }

    public function setCsmLitres(int $csm_litres): self
    {
        $this->csm_litres = $csm_litres;

        return $this;
    }

    public function getCsmDate(): ?\DateTimeInterface
    {
        return $this->csm_date;
    }

    public function setCsmDate(\DateTimeInterface $csm_date): self
    {
        $this->csm_date = $csm_date;

        return $this;
    }

    public function getCsmFoyer(): ?Foyer
    {
        return $this->csm_foyer;
    }

    public function setCsmFoyer(?Foyer $csm_foyer): self
    {
        $this->csm_foyer = $csm_foyer;

        return $this;
    }
}
