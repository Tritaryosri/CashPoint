<?php

namespace Dotit\CashpointBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait SoftDeleteable
 *
 * @author Tritar Yosri
 */
trait SoftDeleteableTrait
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }
}
