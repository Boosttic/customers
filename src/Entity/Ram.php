<?php

namespace App\Entity;

use App\Repository\RamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RamRepository::class)]
class Ram
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $capacity;

    #[ORM\ManyToMany(targetEntity: ProviderOffer::class, mappedBy: 'rams')]
    private $providerOffers;

    public function __construct()
    {
        $this->providerOffers = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCapacity(): ?string
    {
        return $this->capacity;
    }

    public function setCapacity(string $capacity): self
    {
        $this->capacity = $capacity;

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
            $providerOffer->addRam($this);
        }

        return $this;
    }

    public function removeProviderOffer(ProviderOffer $providerOffer): self
    {
        if ($this->providerOffers->removeElement($providerOffer)) {
            $providerOffer->removeRam($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->capacity;
    }
}
