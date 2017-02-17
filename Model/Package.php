<?php

namespace LAShowroom\RocketShipitBundle\Model;

use LAShowroom\RocketShipitBundle\Model\Dimensions\Cuboid;
use LAShowroom\RocketShipitBundle\Model\Dimensions\Weight;

class Package
{
    /**
     * @var Weight
     */
    private $weight;

    /**
     * @var Cuboid
     */
    private $dimensions;

    /**
     * @var string
     */
    private $packagingType;

    /**
     * @param Weight $weight
     * @param Cuboid $dimensions
     * @param string $packagingType
     */
    public function __construct(Weight $weight, Cuboid $dimensions, $packagingType)
    {
        $this->weight = $weight;
        $this->dimensions = $dimensions;
        $this->packagingType = $packagingType;
    }

    /**
     * @return Weight
     */
    public function getWeight(): Weight
    {
        return $this->weight;
    }

    /**
     * @return Cuboid
     */
    public function getDimensions(): Cuboid
    {
        return $this->dimensions;
    }

    /**
     * @return string
     */
    public function getPackagingType(): string
    {
        return $this->packagingType;
    }
}
