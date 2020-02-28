<?php

namespace Dotit\CashpointBundle\Entity;

use App\Application\Sonata\UserBundle\Entity\User as User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Sonata\UserBundle\Model\UserInterface;

/**
 * @ORM\Entity
 * @UniqueEntity("cin")
 */

/**
 * @ORM\Entity(repositoryClass="App\Repository\BackUsersRepository")
 */
class BackUsers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="integer")
     */
    private $code_postal;

    /**
     * @ORM\Column(type="string",nullable=true,name="cin",unique=true,length=8)
     * @Assert\NotBlank
     *   * @Assert\Regex(
     *     pattern     = "/^[0-9]{8}$/",
     *     message="Your cin must contain 8 digits"
     *
     * )
     */
    private $cin;

    /**
     * @ORM\OneToOne(targetEntity="App\Application\Sonata\UserBundle\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user", referencedColumnName="id", nullable=True)
     */
    protected $user ;

    public static function getGenderList()
    {
        return array(
            UserInterface::GENDER_UNKNOWN => 'u',
            UserInterface::GENDER_FEMALE  => 'f',
            UserInterface::GENDER_MALE    => 'm',
        );
    }


    /**
     * *@var code_postal
     * @var address
     * @var name
     *@var cin
     * @var num_compte
     *@var user
     */
    public function __construct($code_postal,$address,$cin,$name,$num_compte,$user)
    {
        Parent::__construct();
        $this->cin=$cin;
        $this->code_postal=$code_postal;
        $this->address=$address;
        $this->num_compte=$num_compte;
        $this->name=$name;
        $this->user=$user;
       // $this->commandes = new ArrayCollection();
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(int $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(int $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user= $user;

        return $this;
    }
}
