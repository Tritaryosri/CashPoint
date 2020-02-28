<?php

namespace Dotit\CashpointBundle\Entity;

use App\Entity\Traits\ObjectMetaDataTrait;
use App\Entity\Traits\SoftDeleteableTrait;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoucherTypeRepository")
 */
class VoucherType
{
    // <editor-fold defaultstate="collapsed" desc="traits">

    use TimestampableTrait;
    use SoftDeleteableTrait;
    use ObjectMetaDataTrait;

    // </editor-fold>

    //<editor-fold default-state="collapsed" desc="attributes">

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(groups={"add"})
     * @ORM\Column(type="string", length=30)
     */
    private $operator;

    /**
     * @Assert\NotBlank(groups={"add"})
     * @ORM\Column(type="float")
     */
    private $agentPrice;

    /**
     * @Assert\NotBlank(groups={"add"})
     * @ORM\Column(type="float")
     */
    private $cashierPrice;

    /**
     * @Assert\NotBlank(groups={"add"})
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $reference;

    /**
     * @var int
     */
    private $available;
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="relations">

    /**
     * @ORM\OneToMany(targetEntity="Voucher", mappedBy="voucherType")
     */
    private $vouchers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VoucherGenLogs", mappedBy="voucherType", orphanRemoval=true, cascade={"persist"})
     */
    private $voucherGenLogs;
    // </editor-fold>

    // <editor-fold default-state="collapsed" desc="methods"

    public function __construct()
    {
        $this->vouchers = new ArrayCollection();
        $this->voucherGenLogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOperator(): ?string
    {
        return $this->operator;
    }

    public function setOperator(string $operator): self
    {
        $this->operator = $operator;

        return $this;
    }

    public function getAgentPrice(): ?float
    {
        return $this->agentPrice;
    }

    public function setAgentPrice(float $agentPrice): self
    {
        $this->agentPrice = $agentPrice;

        return $this;
    }

    public function getCashierPrice(): ?float
    {
        return $this->cashierPrice;
    }

    public function setCashierPrice(float $cashierPrice): self
    {
        $this->cashierPrice = $cashierPrice;

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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }
    public function getAvailable():int
    {
        return $this->available;
    }
    public function setAvailable(int $available):self
    {
        $this->available = $available;
        return $this;
    }

    /**
     * @return Collection|Voucher[]
     */
    public function getVouchers(): Collection
    {
        return $this->vouchers;
    }

    public function addVuocher(Voucher $voucher): self
    {
        if (!$this->vouchers->contains($voucher)) {
            $this->vouchers[] = $voucher;
            $voucher->setVoucherType($this);
        }

        return $this;
    }

    public function removeVoucher(Voucher $voucher): self
    {
        if ($this->vouchers->contains($voucher)) {
            $this->vouchers->removeElement($voucher);
            // set the owning side to null (unless already changed)
            if ($voucher->getVoucherType() === $this) {
                $voucher->setVoucherType(null);
            }
        }

        return $this;
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
            $voucherGenLog->setVoucherType($this);
        }

        return $this;
    }

    public function removeVoucherGenLog(VoucherGenLogs $voucherGenLog): self
    {
        if ($this->voucherGenLogs->contains($voucherGenLog)) {
            $this->voucherGenLogs->removeElement($voucherGenLog);
            // set the owning side to null (unless already changed)
            if ($voucherGenLog->getVoucherType() === $this) {
                $voucherGenLog->setVoucherType(null);
            }
        }

        return $this;
    }
    // </editor-fold>
}
