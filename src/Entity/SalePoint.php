<?php

namespace Dotit\CashpointBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Entity\Traits\ObjectMetaDataTrait;
use App\Entity\Traits\SoftDeleteableTrait;
use App\Entity\Traits\TimestampableTrait;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SalePointRepository")
 */
class SalePoint
{

    // <editor-fold defaultstate="collapsed" desc="traits">

    use TimestampableTrait;
    use SoftDeleteableTrait;
    use ObjectMetaDataTrait;

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="attributes">
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $reference;

    /**
     * @Assert\NotBlank(groups={"add"})
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @Assert\NotBlank(groups={"add"})
     * @ORM\Column(type="integer")
     */
    private $phone;

    /**
     * @Assert\NotBlank(groups={"add"})
     * @ORM\Column(type="string", length=180)
     */
    private $longitude;

    /**
     * @Assert\NotBlank(groups={"add"})
     * @ORM\Column(type="string", length=180)
     */
    private $latitude;
    /**
     * @ORM\Column(type="boolean")
     */
    private $active = false;

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="relations">

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="salePoint", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="methods">


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

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

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
    // </editor-fold>
}
