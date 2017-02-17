<?php

namespace LAShowroom\RocketShipitBundle\Model\Dimensions;

class Weight
{
    const UNIT_LBS = 'LBS';
    const UNIT_KG = 'KG';

    /**
     * @var float
     */
    private $weight;

    /**
     * @var string
     */
    private $unit;

    /**
     * @param float  $weight
     * @param string $unit
     */
    public function __construct($weight, $unit)
    {
        $this->weight = $weight;
        $this->unit = $unit;

        if (!in_array($unit, [self::UNIT_KG, self::UNIT_LBS])) {
            throw new \InvalidArgumentException('Invalid unit: ' . $unit);
        }
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }
}
