<?php

namespace App\Entity;

use App\Repository\ProviderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProviderRepository::class)]
class Provider
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'provider', targetEntity: Machine::class, orphanRemoval: true)]
    private $machines;

    #[ORM\OneToMany(mappedBy: 'provider', targetEntity: ProviderOffer::class, orphanRemoval: true)]
    private $providerOffers;

    public function __construct()
    {
        $this->machines = new ArrayCollection();
        $this->providerOffers = new ArrayCollection();
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
     * @return Collection<int, Machine>
     */
    public function getMachines(): Collection
    {
        return $this->machines;
    }

    public function addMachine(Machine $machine): self
    {
        if (!$this->machines->contains($machine)) {
            $this->machines[] = $machine;
            $machine->setProvider($this);
        }

        return $this;
    }

    public function removeMachine(Machine $machine): self
    {
        if ($this->machines->removeElement($machine)) {
            // set the owning side to null (unless already changed)
            if ($machine->getProvider() === $this) {
                $machine->setProvider(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProviderOffer>
     */
    public function getProviderOffers(): Collection
    {
        return $this->providerOffers;
    }

    public function addProviderOffer(ProviderOffer $providerOffer): self
    {
        if (!$this->providerOffers->contains($providerOffer)) {
            $this->providerOffers[] = $providerOffer;
            $providerOffer->setProvider($this);
        }

        return $this;
    }

    public function removeProviderOffer(ProviderOffer $providerOffer): self
    {
        if ($this->providerOffers->removeElement($providerOffer)) {
            // set the owning side to null (unless already changed)
            if ($providerOffer->getProvider() === $this) {
                $providerOffer->setProvider(null);
            }
        }

        return $this;
    }
}
