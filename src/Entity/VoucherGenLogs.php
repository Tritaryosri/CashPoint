<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\ObjectMetaDataTrait;
use App\Entity\Traits\SoftDeleteableTrait;
use App\Entity\Traits\TimestampableTrait;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoucherGenLogsRepository")
 */
class VoucherGenLogs
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
     * @ORM\Column(type="string", length=30)
     */
    private $reference;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="relations" >

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="voucherGenLogs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Voucher", mappedBy="voucherGenLogs", orphanRemoval=true)
     */
    private $vouchers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\VoucherType", inversedBy="voucherGenLogs", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $voucherType;
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="methods">

    public function __construct()
    {
        $this->vouchers = new ArrayCollection();
    }

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

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
     * @return Collection|Voucher[]
     */
    public function getVouchers(): Collection
    {
        return $this->vouchers;
    }

    public function addVoucher(Voucher $voucher): self
    {
        if (!$this->vouchers->contains($voucher)) {
            $this->vouchers[] = $voucher;
            $voucher->setVoucherGenLogs($this);
        }

        return $this;
    }

    public function removeVoucher(Voucher $voucher): self
    {
        if ($this->vouchers->contains($voucher)) {
            $this->vouchers->removeElement($voucher);
            // set the owning side to null (unless already changed)
            if ($voucher->getVoucherGenLogs() === $this) {
                $voucher->setVoucherGenLogs(null);
            }
        }

        return $this;
    }

    public function getVoucherType(): ?VoucherType
    {
        return $this->voucherType;
    }

    public function setVoucherType(?VoucherType $voucherType): self
    {
        $this->voucherType = $voucherType;

        return $this;
    }
    // </editor-fold>
}
