<?php

namespace LAShowroom\RocketShipitBundle\Model\Carrier;

class Ups extends Carrier
{
    const PACKAGING_TYPE_BAG = '01';
    const PACKAGING_TYPE_BOX = '02';
    const PACKAGING_TYPE_CARTON = '03';
    const PACKAGING_TYPE_CRATE = '04';
    const PACKAGING_TYPE_DRUM = '05';
    const PACKAGING_TYPE_PALLET = '06';
    const PACKAGING_TYPE_ROLL = '07';
    const PACKAGING_TYPE_TUBE = '08';

    const PICKUP_TYPE_DAILY = '01';
    const PICKUP_TYPE_CUSTOMER_COUNTER = '03';
    const PICKUP_TYPE_ONE_TIME_PICKUP = '06';
    const PICKUP_TYPE_ON_CALL_AIR = '07';
    const PICKUP_TYPE_RETAIL_RATES = '11';
    const PICKUP_TYPE_LETTER_CENTER = '19';
    const PICKUP_TYPE_AIR_SERVICE_CENTER = '20';

    /**
     * @return string
     */
    public function __toString()
    {
        return 'UPS';
    }

    public function getServiceDescription($serviceCode)
    {
        if ('01' === $serviceCode) {
            return 'UPS Next Day Air';
        } elseif ('02' === $serviceCode) {
            return 'UPS 2nd Day Air';
        } elseif ('03' === $serviceCode) {
            return 'UPS Ground';
        } elseif ('07' === $serviceCode) {
            return 'UPS Worldwide Express';
        } elseif ('08' === $serviceCode) {
            return 'UPS Worldwide Expedited';
        } elseif ('11' === $serviceCode) {
            return 'UPS Standard';
        } elseif ('12' === $serviceCode) {
            return 'UPS 3 Day Select';
        } elseif ('13' === $serviceCode) {
            return 'UPS Next Day Air Saver';
        } elseif ('14' === $serviceCode) {
            return 'UPS Next Day Air Early AM';
        } elseif ('54' === $serviceCode) {
            return 'UPS Worldwide Express Plus';
        } elseif ('59' === $serviceCode) {
            return 'UPS Second Day Air AM';
        } elseif ('65' === $serviceCode) {
            return 'UPS Worldwide Saver';
        } elseif ('M2' === $serviceCode) {
            return 'UPS First-Class Mail';
        } elseif ('M3' === $serviceCode) {
            return 'UPS Priority Mail';
        } elseif ('M4' === $serviceCode) {
            return 'UPS Expedited Mail Innovations';
        } elseif ('M5' === $serviceCode) {
            return 'UPS Priority Mail Innovations';
        } elseif ('M6' === $serviceCode) {
            return 'UPS Economy Mail Innovations';
        }

        throw new \InvalidArgumentException('Invalid UPS service code: ' . $serviceCode);
    }

    public static function isValidPickupType($pickupType)
    {
        return in_array($pickupType, [
            self::PICKUP_TYPE_DAILY,
            self::PICKUP_TYPE_CUSTOMER_COUNTER,
            self::PICKUP_TYPE_ONE_TIME_PICKUP,
            self::PICKUP_TYPE_ON_CALL_AIR,
            self::PICKUP_TYPE_RETAIL_RATES,
            self::PICKUP_TYPE_LETTER_CENTER,
            self::PICKUP_TYPE_AIR_SERVICE_CENTER
        ]);

    }
}
