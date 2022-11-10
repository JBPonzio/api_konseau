<?php

namespace App\Entity;

use App\Repository\FoyerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FoyerRepository::class)]
class Foyer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'foy_id')]
    private ?int $id = null;

    #[ORM\Column(name: 'foy_nb_personnes')]
    private ?int $foy_nb_personnes = null;

    #[ORM\OneToMany(mappedBy: 'csm_foyer', targetEntity: Consommation::class)]
    private Collection $foy_consommations;


    public function __construct()
    {
        $this->foy_consommations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFoyNbPersonnes(): ?int
    {
        return $this->foy_nb_personnes;
    }

    public function setFoyNbPersonnes(int $foy_nb_personnes): self
    {
        $this->foy_nb_personnes = $foy_nb_personnes;

        return $this;
    }

    /**
     * @return Collection<int, Consommation>
     */
    public function getFoyConsommations(): Collection
    {
        return $this->foy_consommations;
    }

    public function addFoyConsommation(Consommation $foyConsommation): self
    {
        if (!$this->foy_consommations->contains($foyConsommation)) {
            $this->foy_consommations->add($foyConsommation);
            $foyConsommation->setCsmFoyer($this);
        }

        return $this;
    }

    public function removeFoyConsommation(Consommation $foyConsommation): self
    {
        if ($this->foy_consommations->removeElement($foyConsommation)) {
            // set the owning side to null (unless already changed)
            if ($foyConsommation->getCsmFoyer() === $this) {
                $foyConsommation->setCsmFoyer(null);
            }
        }

        return $this;
    }
}
