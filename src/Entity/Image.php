<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
#[ORM\Table(name: 'tbl_image')]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    /**
     * @var Collection<int, Credits>
     */
    #[ORM\ManyToMany(targetEntity: Credits::class, inversedBy: 'images')]
    private Collection $credits;

    public function __construct()
    {
        $this->credits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection<int, Credits>
     */
    public function getCredits(): Collection
    {
        return $this->credits;
    }

    public function addCredit(Credits $credit): static
    {
        if (!$this->credits->contains($credit)) {
            $this->credits->add($credit);
        }

        return $this;
    }

    public function removeCredit(Credits $credit): static
    {
        $this->credits->removeElement($credit);

        return $this;
    }
}
