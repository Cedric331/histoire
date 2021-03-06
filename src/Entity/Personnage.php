<?php

namespace App\Entity;

use App\Repository\PersonnageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonnageRepository::class)
 * @Vich\Uploadable 
 */
class Personnage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $birth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $death;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $people;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $history;

    /**
     * @ORM\OneToMany(targetEntity=Citation::class, mappedBy="personnage")
     */
    private $citations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

   /**
     * @Vich\UploadableField(mapping="personnage", fileNameProperty="image")
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function __construct()
    {
        $this->citations = new ArrayCollection();
    }

    public function __toString()
    {
       return $this->name;
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

    public function getBirth(): ?int
    {
        return $this->birth;
    }

    public function setBirth(?int $birth): self
    {
        $this->birth = $birth;

        return $this;
    }

    public function getDeath(): ?int
    {
        return $this->death;
    }

    public function setDeath(?int $death): self
    {
        $this->death = $death;

        return $this;
    }

    public function getPeople(): ?string
    {
        return $this->people;
    }

    public function setPeople(?string $people): self
    {
        $this->people = $people;

        return $this;
    }

    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(?string $history): self
    {
        $this->history = $history;

        return $this;
    }

    /**
     * @return Collection|Citation[]
     */
    public function getCitations(): Collection
    {
        return $this->citations;
    }

    public function addCitation(Citation $citation): self
    {
        if (!$this->citations->contains($citation)) {
            $this->citations[] = $citation;
            $citation->setPersonnage($this);
        }

        return $this;
    }

    public function removeCitation(Citation $citation): self
    {
        if ($this->citations->removeElement($citation)) {
            // set the owning side to null (unless already changed)
            if ($citation->getPersonnage() === $this) {
                $citation->setPersonnage(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImageFile () : ?File
    {
        return  $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
