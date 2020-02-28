<?php

namespace Dotit\CashpointBundle\Entity;

use App\Entity\Traits\ObjectMetaDataTrait;
use App\Entity\Traits\SoftDeleteableTrait;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Symfony\Component\HttpFoundation\File\File;


/**
 * @ORM\Entity(repositoryClass="App\Repository\VoucherRepository")
 * @Vich\Uploadable
 */
class Voucher
{
    // <editor-fold defaultstate="collapsed" desc="traits">

    use TimestampableTrait;
    use SoftDeleteableTrait;
    use ObjectMetaDataTrait;

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="attributes"

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $serieNumber;


    /**
     * @ORM\Column(type="boolean")
     */
    private $status =false;

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="relations"

    /**
     * @ORM\ManyToOne(targetEntity="VoucherType", inversedBy="vouchers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $voucherType;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Wallet", inversedBy="vouchers")
     */
    private $wallet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\VoucherGenLogs", inversedBy="vouchers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $voucherGenLogs;



    // <editor-fold defaultstate="collapsed" desc="methods">

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getSerieNumber(): ?string
    {
        return $this->serieNumber;
    }

    public function setSerieNumber(string $serieNumber): self
    {
        $this->serieNumber = $serieNumber;

        return $this;
    }



    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

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

    public function getWallet(): ?Wallet
    {
        return $this->wallet;
    }

    public function setWallet(?Wallet $wallet): self
    {
        $this->wallet = $wallet;

        return $this;
    }

    public function getVoucherGenLogs(): ?VoucherGenLogs
    {
        return $this->voucherGenLogs;
    }

    public function setVoucherGenLogs(?VoucherGenLogs $voucherGenLogs): self
    {
        $this->voucherGenLogs = $voucherGenLogs;

        return $this;
    }
    // </editor-fold>

}
