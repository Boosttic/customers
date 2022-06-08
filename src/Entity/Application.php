<?php

namespace App\Entity;

use App\Repository\ApplicationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicationRepository::class)]
class Application
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToOne(targetEntity: Port::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $port;

    #[ORM\ManyToOne(targetEntity: Server::class)]
    private $server;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $dns;

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

    public function getPort(): ?port
    {
        return $this->port;
    }

    public function setPort(port $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function getServer(): ?server
    {
        return $this->server;
    }

    public function setServer(?server $server): self
    {
        $this->server = $server;

        return $this;
    }

    public function getDns(): ?string
    {
        return $this->dns;
    }

    public function setDns(?string $dns): self
    {
        $this->dns = $dns;

        return $this;
    }
}
