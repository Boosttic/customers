<?php

namespace App\Entity;

use App\Repository\StockageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockageRepository::class)]
class Stockage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'stockage', targetEntity: server::class)]
    private $server;

    public function __construct()
    {
        $this->server = new ArrayCollection();
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
     * @return Collection<int, server>
     */
    public function getServer(): Collection
    {
        return $this->server;
    }

    public function addServer(server $server): self
    {
        if (!$this->server->contains($server)) {
            $this->server[] = $server;
            $server->setStockage($this);
        }

        return $this;
    }

    public function removeServer(server $server): self
    {
        if ($this->server->removeElement($server)) {
            // set the owning side to null (unless already changed)
            if ($server->getStockage() === $this) {
                $server->setStockage(null);
            }
        }

        return $this;
    }
}
