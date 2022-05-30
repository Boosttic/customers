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

    #[ORM\Column(type: 'string', length: 255)]
    private $proc;

    #[ORM\Column(type: 'string', length: 255)]
    private $debit;

    #[ORM\Column(type: 'string', length: 255)]
    private $url;

    #[ORM\OneToOne(mappedBy: 'server', targetEntity: Product::class, cascade: ['persist', 'remove'])]
    private $product;

    #[ORM\ManyToOne(targetEntity: Ram::class, inversedBy: 'server')]
    #[ORM\JoinColumn(nullable: false)]
    private $ram;

    #[ORM\ManyToOne(targetEntity: Stockage::class, inversedBy: 'server',cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private $stockage;

    #[ORM\OneToMany(mappedBy: 'server', targetEntity: Account::class, orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true)]
    private $accounts;

    public function __construct()
    {
        $this->accounts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProc(): ?string
    {
        return $this->proc;
    }

    public function setProc(string $proc): self
    {
        $this->proc = $proc;

        return $this;
    }

    public function getDebit(): ?string
    {
        return $this->debit;
    }

    public function setDebit(string $debit): self
    {
        $this->debit = $debit;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
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
}
