<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: CommandeProduct::class, orphanRemoval: true)]
    private Collection $commandeProducts;

    public function __construct()
    {
        $this->commandeProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, CommandeProduct>
     */
    public function getCommandeProducts(): Collection
    {
        return $this->commandeProducts;
    }

    public function addCommandeProduct(CommandeProduct $commandeProduct): self
    {
        if (!$this->commandeProducts->contains($commandeProduct)) {
            $this->commandeProducts->add($commandeProduct);
            $commandeProduct->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeProduct(CommandeProduct $commandeProduct): self
    {
        if ($this->commandeProducts->removeElement($commandeProduct)) {
            // set the owning side to null (unless already changed)
            if ($commandeProduct->getCommande() === $this) {
                $commandeProduct->setCommande(null);
            }
        }

        return $this;
    }
}
