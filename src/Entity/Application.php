<?php

namespace App\Entity;

use App\Repository\ApplicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicationRepository::class)]
class Application
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $domainName;

    #[ORM\Column(type: 'string', length: 255)]
    private $port;

    #[ORM\ManyToMany(targetEntity: Sale::class, mappedBy: 'applications')]
    private $sales;

    #[ORM\ManyToOne(targetEntity: Machine::class, inversedBy: 'applications')]
    #[ORM\JoinColumn(nullable: false)]
    private $machine;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'applications')]
    #[ORM\JoinColumn(nullable: false)]
    private $product;

    #[ORM\OneToMany(mappedBy: 'application', targetEntity: Account::class)]
    private $accounts;

    public function __construct()
    {
        $this->sales = new ArrayCollection();
        $this->accounts = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDomainName(): ?string
    {
        return $this->domainName;
    }

    public function setDomainName(string $domainName): self
    {
        $this->domainName = $domainName;

        return $this;
    }

    public function getPort(): ?string
    {
        return $this->port;
    }

    public function setPort(string $port): self
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @return Collection<int, Sale>
     */
    public function getSales(): Collection
    {
        return $this->sales;
    }

    public function addSale(Sale $sale): self
    {
        if (!$this->sales->contains($sale)) {
            $this->sales[] = $sale;
            $sale->addApplication($this);
        }

        return $this;
    }

    public function removeSale(Sale $sale): self
    {
        if ($this->sales->removeElement($sale)) {
            $sale->removeApplication($this);
        }

        return $this;
    }

    public function getMachine(): ?Machine
    {
        return $this->machine;
    }

    public function setMachine(?Machine $machine): self
    {
        $this->machine = $machine;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

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
            $account->setApplication($this);
        }

        return $this;
    }

    public function removeAccount(Account $account): self
    {
        if ($this->accounts->removeElement($account)) {
            // set the owning side to null (unless already changed)
            if ($account->getApplication() === $this) {
                $account->setApplication(null);
            }
        }

        return $this;
    }
}
