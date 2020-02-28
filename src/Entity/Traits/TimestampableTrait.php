<?php

namespace App\Entity\Traits;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait Timestampable
 *
 * @author Tritar Yosri
 */
trait TimestampableTrait
{
    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     *
     * @ORM\Column(type="datetime")
     *
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     *
     * @ORM\Column(type="datetime")
     *
     */
    private $updatedAt;

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}