<?php

namespace App\Entity;

use App\Repository\ServerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServerRepository::class)]
class Server
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(mappedBy: 'server', targetEntity: Product::class, cascade: ['persist', 'remove'])]
    private $product;

    #[ORM\ManyToOne(targetEntity: Ram::class, inversedBy: 'server')]
    #[ORM\JoinColumn(nullable: true)]
    private $ram;

    #[ORM\ManyToOne(targetEntity: Stockage::class, inversedBy: 'server',cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: true)]
    private $stockage;

    #[ORM\OneToMany(mappedBy: 'server', targetEntity: Account::class, orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true)]
    private $accounts;

    #[ORM\Column(type: 'string', length: 255)]
    private $ip;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToOne(targetEntity: DB::class, cascade: ['persist', 'remove'])]
    private $dB;

    #[ORM\Column(type: 'string', length: 255)]
    private $provider;

    #[ORM\Column(type: 'boolean')]
    private $server;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $proc;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $debit;

    #[ORM\OneToMany(mappedBy: 'server', targetEntity: Application::class, orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true)]
    private $applications;

    public function __construct()
    {
        $this->accounts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        // unset the owning side of the relation if necessary
        if ($product === null && $this->product !== null) {
            $this->product->setServer(null);
        }

        // set the owning side of the relation if necessary
        if ($product !== null && $product->getServer() !== $this) {
            $product->setServer($this);
        }

        $this->product = $product;

        return $this;
    }

    public function getRam(): ?Ram
    {
        return $this->ram;
    }

    public function setRam(?Ram $ram): self
    {
        $this->ram = $ram;

        return $this;
    }

    public function getStockage(): ?Stockage
    {
        return $this->stockage;
    }

    public function setStockage(?Stockage $stockage): self
    {
        $this->stockage = $stockage;

        return $this;
    }

    /**
     * @return Collection<int, Account>
     */
    public function getAccounts(): Collection
    {
        return $this->accounts;
    }

    public function addAccount(Account $account): self
    {
        if (!$this->accounts->contains($account)) {
            $this->accounts[] = $account;
            $account->setServer($this);
        }

        return $this;
    }

    public function removeAccount(Account $account): self
    {
        if ($this->accounts->removeElement($account)) {
            // set the owning side to null (unless already changed)
            if ($account->getServer() === $this) {
                $account->setServer(null);
            }
        }

        return $this;
    }
    
    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
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

    public function getDB(): ?dB
    {
        return $this->dB;
    }

    public function setDB(?dB $dB): self
    {
        $this->dB = $dB;

        return $this;
    }

    public function getProvider(): ?string
    {
        return $this->provider;
    }

    public function setProvider(string $provider): self
    {
        $this->provider = $provider;

        return $this;
    }

    public function isServer(): ?bool
    {
        return $this->server;
    }

    public function setServer(bool $server): self
    {
        $this->server = $server;

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

    /**
     * @return Collection<int, Account>
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications[] = $application;
            $application->setServer($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->removeElement($application)) {
            // set the owning side to null (unless already changed)
            if ($application->getServer() === $this) {
                $application->setServer(null);
            }
        }

        return $this;
    }
}
