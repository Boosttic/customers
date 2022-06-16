<?php

namespace App\Entity;

use App\Repository\ProviderOfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProviderOfferRepository::class)]
class ProviderOffer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $proc;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $debit;

    #[ORM\Column(type: 'boolean')]
    private $is_server;

    #[ORM\ManyToMany(targetEntity: Ram::class, inversedBy: 'providerOffers', cascade: ['persist'])]
    private $rams;

    #[ORM\ManyToMany(targetEntity: Stockage::class, inversedBy: 'providerOffers', cascade: ['persist'])]
    private $stockages;

    #[ORM\OneToMany(mappedBy: 'providerOffer', targetEntity: Machine::class)]
    private $machines;

    #[ORM\ManyToOne(targetEntity: Provider::class, inversedBy: 'providerOffers')]
    private $provider;

    public function __construct()
    {
        $this->rams = new ArrayCollection();
        $this->stockages = new ArrayCollection();
        $this->machines = new ArrayCollection();
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

    public function getProc(): ?string
    {
        return $this->proc;
    }

    public function setProc(?string $proc): self
    {
        $this->proc = $proc;

        return $this;
    }

    public function getDebit(): ?string
    {
        return $this->debit;
    }

    public function setDebit(?string $debit): self
    {
        $this->debit = $debit;

        return $this;
    }

    public function isIsServer(): ?bool
    {
        return $this->is_server;
    }

    public function setIsServer(bool $is_server): self
    {
        $this->is_server = $is_server;

        return $this;
    }


    /**
     * @return Collection<int, Ram>
     */
    public function getRams(): Collection
    {
        return $this->rams;
    }

    public function addRam(Ram $ram): self
    {
        if (!$this->rams->contains($ram)) {
            $this->rams[] = $ram;
        }

        return $this;
    }

    public function removeRam(Ram $ram): self
    {
        $this->rams->removeElement($ram);

        return $this;
    }

    /**
     * @return Collection<int, Stockage>
     */
    public function getStockages(): Collection
    {
        return $this->stockages;
    }

    public function addStockage(Stockage $stockage): self
    {
        if (!$this->stockages->contains($stockage)) {
            $this->stockages[] = $stockage;
        }

        return $this;
    }

    public function removeStockage(Stockage $stockage): self
    {
        $this->stockages->removeElement($stockage);

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
            $machine->setProviderOffer($this);
        }

        return $this;
    }

    public function removeMachine(Machine $machine): self
    {
        if ($this->machines->removeElement($machine)) {
            // set the owning side to null (unless already changed)
            if ($machine->getProviderOffer() === $this) {
                $machine->setProviderOffer(null);
            }
        }

        return $this;
    }

    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    public function setProvider(?Provider $provider): self
    {
        $this->provider = $provider;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
