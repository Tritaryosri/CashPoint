<?php

namespace App\Entity;

use App\Entity\Traits\ObjectMetaDataTrait;
use App\Entity\Traits\SoftDeleteableTrait;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WalletRepository")
 */
class Wallet
{
    // <editor-fold defaultstate="collapsed" desc="traits">

    use TimestampableTrait;
    use SoftDeleteableTrait;
    use ObjectMetaDataTrait;

    // </editor-fold>

    // <editor-fold default-state="collapsed" desc="attributes">

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    // </editor-fold>

    // <editor-fold default-state="collapsed" desc="relations">

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="wallet", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Voucher", mappedBy="wallet")
     */
    private $vouchers;

    // </editor-fold>

    //<editor-fold default-state="collapsed" desc="methods">

    public function __construct()
    {
        $this->vouchers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $voucher->setWallet($this);
        }

        return $this;
    }

    public function removeVoucher(Voucher $voucher): self
    {
        if ($this->vouchers->contains($voucher)) {
            $this->vouchers->removeElement($voucher);
            // set the owning side to null (unless already changed)
            if ($voucher->getWallet() === $this) {
                $voucher->setWallet(null);
            }
        }

        return $this;
    }
    // </editor-fold>
}
