<?php

namespace App\Entity\Traits;

/**
 * Trait ObjectMetaDataTrait

 * @author Tritar Yosri
 */
trait ObjectMetaDataTrait
{
    /**
     * Getting object short class name
     *
     * @return string
     * @throws \ReflectionException
     */
    public function getClass()
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}