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
    private $name;

    #[ORM\OneToMany(mappedBy: 'ram', targetEntity: server::class, orphanRemoval: true)]
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
            $server->setRam($this);
        }

        return $this;
    }

}
