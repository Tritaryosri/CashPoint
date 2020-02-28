<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Traits\ObjectMetaDataTrait;
use App\Entity\Traits\SoftDeleteableTrait;
use App\Entity\Traits\TimestampableTrait;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *     fields={"email"},
 *     message="This email address is already used.",
 * )
 * @UniqueEntity(
 *     fields={"phoneNumber"},
 *     message="This phone number is already used.",
 * )
 *
 *
 */
class User implements UserInterface
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
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @var array The User roles
     *
     * @Assert\NotBlank(groups={"addUser"})
     * @ORM\Column(type="json_array")
     */
    private $roles = ['ROLE_USER'];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string The user plain password
     *
     * @Assert\NotBlank(groups={"registration"})
     * @Assert\Length(
     *      min = 8,
     *      minMessage="The password must be at least {{ limit }} characters long",
     * )
     */
    private $plainPassword;

    /**
     * @var boolean The user account status
     *
     * @ORM\Column(type="boolean")
     */
    private $active = false;

    /**
     * @var string The token used for account validation
     *
     * @ORM\Column(name="confirmation_token", type="string", length=255, nullable=true)
     */
    private $confirmationToken;

    /**
     * @var string The user first name
     *
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 3,
     *      minMessage="The firstname must be at least {{ limit }} characters long",
     * )
     */
    private $firstName;



    /**
     * @var string The user last name
     *
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 3,
     *      minMessage="The lastname must be at least {{ limit }} characters long",
     * )
     */
    private $lastName;

    /**
     * @var int The user phone number
     *
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      exactMessage="The phone number should have exactly {{ limit }} characters"
     * )
     */
    private $phoneNumber;

    /**
     * @var \DateTime The last datetime at which the user requested for a new password
     *
     * @ORM\Column(name="password_requested_at", type="datetime", nullable=true)
     */
    private $passwordRequestedAt;

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="relations">

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Balance", mappedBy="user", cascade={"persist", "remove"})
     */
    private $balance;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Wallet", mappedBy="user", cascade={"persist", "remove"})
     */
    private $wallet;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\SalePoint", mappedBy="user", cascade={"persist", "remove"})
     */
    private $salePoint;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Notification", mappedBy="user", orphanRemoval=true)
     */
    private $notifications;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VoucherGenLogs", mappedBy="user", orphanRemoval=true)
     */
    private $voucherGenLogs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transfer", mappedBy="user", orphanRemoval=true)
     */
    private $transfers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="users")
     */
    private $client;

    public function __construct()
    {
        $this->notifications = new ArrayCollection();
        $this->voucherGenLogs = new ArrayCollection();
        $this->transfers = new ArrayCollection();
    }


    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="methods">

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);

    }

    public function setRoles(string $roles): self
    {

        $role [] = $roles;
        $this->roles = $role;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword)
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }
    /**
     * Returns confirmation token used for registration or password resetting
     *
     * @return string|null
     */
    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    public function setConfirmationToken($confirmationToken)
    {
        $this->confirmationToken = $confirmationToken;
        return $this;
    }
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getFullname()
    {
        return sprintf('%s %s', $this->getFirstName(), $this->getLastName());
    }
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }
    /**
     * Returns checking whether the user account is active or not ?
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $status)
    {
        $this->active = $status;
        return $this;
    }

    public function getPasswordRequestedAt(): ?\DateTimeInterface
    {
        return $this->passwordRequestedAt;
    }

    public function setPasswordRequestedAt($passwordRequestedAt)
    {
        $this->passwordRequestedAt = $passwordRequestedAt;
        return $this;
    }

    public function getBalance(): ?Balance
    {
        return $this->balance;
    }

    public function setBalance(Balance $balance): self
    {
        $this->balance = $balance;

        // set the owning side of the relation if necessary
        if ($balance->getUser() !== $this) {
            $balance->setUser($this);
        }

        return $this;
    }

    public function getWallet(): ?Wallet
    {
        return $this->wallet;
    }

    public function setWallet(?Wallet $wallet): self
    {
        $this->wallet = $wallet;

        // set (or unset) the owning side of the relation if necessary
        $newUser = null === $wallet ? null : $this;
        if ($wallet->getUser() !== $newUser) {
            $wallet->setUser($newUser);
        }

        return $this;
    }

    public function getSalePoint(): ?SalePoint
    {
        return $this->salePoint;
    }

    public function setSalePoint(SalePoint $salePoint): self
    {
        $this->salePoint = $salePoint;

        // set the owning side of the relation if necessary
        if ($salePoint->getUser() !== $this) {
            $salePoint->setUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Notification[]
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): self
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications[] = $notification;
            $notification->setUser($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): self
    {
        if ($this->notifications->contains($notification)) {
            $this->notifications->removeElement($notification);
            // set the owning side to null (unless already changed)
            if ($notification->getUser() === $this) {
                $notification->setUser(null);
            }
        }

        return $this;
    }
    public function isAdmin():bool
    {
        if( array_search( 'ROLE_ADMIN',$this->getRoles())=== false)
        {
            return false;
        }
        return true;
    }
    public function isCashier():bool
    {
        if( array_search( 'ROLE_CASHIER',$this->getRoles())=== false)
        {
            return false;
        }
        return true;
    }
    public function isAgent():bool
    {
        if( array_search( 'ROLE_AGENT',$this->getRoles())=== false)
        {
            return false;
        }
        return true;
    }

    /**
     * @return Collection|VoucherGenLogs[]
     */
    public function getVoucherGenLogs(): Collection
    {
        return $this->voucherGenLogs;
    }

    public function addVoucherGenLog(VoucherGenLogs $voucherGenLog): self
    {
        if (!$this->voucherGenLogs->contains($voucherGenLog)) {
            $this->voucherGenLogs[] = $voucherGenLog;
            $voucherGenLog->setUser($this);
        }

        return $this;
    }

    public function removeVoucherGenLog(VoucherGenLogs $voucherGenLog): self
    {
        if ($this->voucherGenLogs->contains($voucherGenLog)) {
            $this->voucherGenLogs->removeElement($voucherGenLog);
            // set the owning side to null (unless already changed)
            if ($voucherGenLog->getUser() === $this) {
                $voucherGenLog->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Transfer[]
     */
    public function getTransfers(): Collection
    {
        return $this->transfers;
    }

    public function addTransfer(Transfer $transfer): self
    {
        if (!$this->transfers->contains($transfer)) {
            $this->transfers[] = $transfer;
            $transfer->setUser($this);
        }

        return $this;
    }

    public function removeTransfer(Transfer $transfer): self
    {
        if ($this->transfers->contains($transfer)) {
            $this->transfers->removeElement($transfer);
            // set the owning side to null (unless already changed)
            if ($transfer->getUser() === $this) {
                $transfer->setUser(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    // </editor-fold>

}
