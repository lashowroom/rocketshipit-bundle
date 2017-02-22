<?php

namespace LAShowroom\RocketShipitBundle\Model\RateRequest;

use LAShowroom\RocketShipitBundle\Model\Response\Rate;
use Money\Currency;
use Money\Money;

class RateResponse
{
    /**
     * @var Rate[]
     */
    private $rates;

    /**
     * @var RateRequest
     */
    private $request;

    public function __construct(RateRequest $rateRequest, array $response)
    {
        $this->request = $rateRequest;

        foreach ($response['RatingServiceSelectionResponse']['RatedShipment'] as $ratedShipment) {
            if (!empty($ratedShipment['NegotiatedRates'])) {
                $negotiatedRate = new Money(
                    (int) ($ratedShipment['NegotiatedRates']['NetSummaryCharges']['GrandTotal']['MonetaryValue'] * 100),
                    new Currency($ratedShipment['NegotiatedRates']['NetSummaryCharges']['GrandTotal']['CurrencyCode'])
                );
            } else {
                $negotiatedRate = null;
            }

            $this->rates[] = new Rate(
                $ratedShipment['Service']['Code'],
                $rateRequest->getCarrier()->getServiceDescription($ratedShipment['Service']['Code']),
                new Money(
                    (int) ($ratedShipment['TransportationCharges']['MonetaryValue'] * 100),
                    new Currency($ratedShipment['TransportationCharges']['CurrencyCode'])
                ),
                new Money(
                    (int) ($ratedShipment['ServiceOptionsCharges']['MonetaryValue'] * 100),
                    new Currency($ratedShipment['ServiceOptionsCharges']['CurrencyCode'])
                ),
                new Money(
                    (int) ($ratedShipment['TotalCharges']['MonetaryValue'] * 100),
                    new Currency($ratedShipment['TotalCharges']['CurrencyCode'])
                ),
                $negotiatedRate
            );
        }
    }

    /**
     * @return Rate[]
     */
    public function getRates(): array
    {
        return $this->rates;
    }

    /**
     * @return RateRequest
     */
    public function getRequest(): RateRequest
    {
        return $this->request;
    }
}
