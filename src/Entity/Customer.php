<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Contact::class, cascade: ['persist'], orphanRemoval: true)]
    private $contacts;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Sale::class, orphanRemoval: true)]
    private $sales;

    #[ORM\Column(type: 'string', length: 255)]
    private $juridicalName;

    #[ORM\Column(type: 'string', length: 255)]
    private $tradeName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $phone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $siret;

    #[ORM\ManyToOne(targetEntity: Address::class, cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private $postalAddress;

    #[ORM\ManyToOne(targetEntity: Address::class, cascade: ['persist'])]
    private $billingAddress;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
        $this->sales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setCustomer($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getCustomer() === $this) {
                $contact->setCustomer(null);
            }
        }

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
            $sale->setCustomer($this);
        }

        return $this;
    }

    public function removeSale(Sale $sale): self
    {
        if ($this->sales->removeElement($sale)) {
            // set the owning side to null (unless already changed)
            if ($sale->getCustomer() === $this) {
                $sale->setCustomer(null);
            }
        }

        return $this;
    }

    public function getJuridicalName(): ?string
    {
        return $this->juridicalName;
    }

    public function setJuridicalName(string $juridicalName): self
    {
        $this->juridicalName = $juridicalName;

        return $this;
    }

    public function getTradeName(): ?string
    {
        return $this->tradeName;
    }

    public function setTradeName(string $tradeName): self
    {
        $this->tradeName = $tradeName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getPostalAddress(): ?Address
    {
        return $this->postalAddress;
    }

    public function setPostalAddress(?Address $postalAddress): self
    {
        $this->postalAddress = $postalAddress;

        return $this;
    }

    public function getBillingAddress(): ?Address
    {
        return $this->billingAddress;
    }

    public function setBillingAddress(?Address $billingAddress): self
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

}
