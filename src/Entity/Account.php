<?php

namespace App\Entity;

use App\Repository\AccountRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $username;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    #[ORM\ManyToOne(targetEntity: server::class, inversedBy: 'accounts')]
    #[ORM\JoinColumn(nullable: true)]
    private $server;

    #[ORM\Column(type: 'integer')]
    private $type;

    #[ORM\ManyToOne(targetEntity: Application::class)]
    #[ORM\JoinColumn(nullable: true)]
    private $Application;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $url;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getApplication(): ?Application
    {
        return $this->Application;
    }

    public function setApplication(?Application $Application): self
    {
        $this->Application = $Application;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
