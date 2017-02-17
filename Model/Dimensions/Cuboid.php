<?php

namespace LAShowroom\RocketShipitBundle\Model\Dimensions;

class Cuboid
{
    const UNIT_INCH = 'IN';
    const UNIT_CM = 'CM';

    /**
     * @var float
     */
    private $height;

    /**
     * @var float
     */
    private $length;

    /**
     * @var float
     */
    private $width;

    /**
     * @var string
     */
    private $unit;

    /**
     * @param float  $height
     * @param float  $length
     * @param float  $width
     * @param string $unit
     */
    public function __construct($height, $length, $width, $unit)
    {
        $this->height = $height;
        $this->length = $length;
        $this->width = $width;
        $this->unit = $unit;

        if (!in_array($unit, [self::UNIT_CM, self::UNIT_INCH])) {
            throw new \InvalidArgumentException('Invalid unit: ' . $unit);
        }
    }

    /**
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * @return float
     */
    public function getLength(): float
    {
        return $this->length;
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }
}
