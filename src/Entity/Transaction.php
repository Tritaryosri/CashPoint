<?php

namespace App\Entity;

use App\Entity\Traits\ObjectMetaDataTrait;
use App\Entity\Traits\SoftDeleteableTrait;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 */
class Transaction
{
    // <editor-fold defaultstate="collapsed" desc="traits">

    use TimestampableTrait;
    use SoftDeleteableTrait;
    use ObjectMetaDataTrait;

    // </editor-fold>

    // <editor-fold defaultsatae="collapsed" desc="attributes">
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30, unique=true, nullable=false)
     */
    private $reference;

    /**
     * transaction secret code
     * @ORM\Column(type="string", length=30,nullable=true)
     *
     */
    private $pin;

    /**
     * @ORM\Column(type="float")
     */
    private $BalanceBefore = 0;

    /**
     * @ORM\Column(type="float")
     */
    private $balanceAfter = 0;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;
    /**
     * @ORM\Column(type="boolean")
     */
    private $active = false;

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="relations">

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Balance", inversedBy="transactions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $balance;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Transfer", mappedBy="transaction", cascade={"persist", "remove"})
     */
    private $transfer;



    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="methods">

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBalanceBefore(): ?float
    {
        return $this->BalanceBefore;
    }

    public function setBalanceBefore(float $BalanceBefore): self
    {
        $this->BalanceBefore = $BalanceBefore;

        return $this;
    }

    public function getBalanceAfter(): ?float
    {
        return $this->balanceAfter;
    }

    public function setBalanceAfter(float $balanceAfter): self
    {
        $this->balanceAfter = $balanceAfter;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
    public function getBalance(): ?Balance
    {
        return $this->balance;
    }

    public function setBalance(?Balance $balance): self
    {
        $this->balance = $balance;

        return $this;
    }


    public function getReference(): string
    {
        return $this->reference;
    }
    public function setReference(string $reference):self
    {
        $this->reference = $reference;
        return $this;
    }
    public function getPin():string
    {
        return $this->pin;
    }
    public function setPin(string $pin):self
    {
        $this->pin = $pin;
        return $this;
    }

    public function getTransfer(): ?Transfer
    {
        return $this->transfer;
    }

    public function setTransfer(?Transfer $transfer): self
    {
        $this->transfer = $transfer;

        // set (or unset) the owning side of the relation if necessary
        $newTransaction = null === $transfer ? null : $this;
        if ($transfer->getTransaction() !== $newTransaction) {
            $transfer->setTransaction($newTransaction);
        }

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
