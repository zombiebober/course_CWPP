<?php


namespace Service\Order;

use Service\Billing\IBilling;
use Service\Communication\ICommunication;
use Service\Discount\IDiscount;
use Service\User\ISecurity;

class BasketBuilder
{
    /**
     * @var IDiscount
     */
    private $discount;

    /**
     * @var IBilling
     */
    private $billing;

    /**
     * @var ISecurity
     */
    private $security;

    /**
     * @var ICommunication
     */
    private $communication;

    /**
     * @return IDiscount
     */
    public function getDiscount(): IDiscount
    {
        return $this->discount;
    }

    /**
     * @param IDiscount $discount
     * @return BasketBuilder
     */
    public function setDiscount(IDiscount $discount): BasketBuilder
    {
        $this->discount = $discount;
        return $this;
    }

    /**
     * @return IBilling
     */
    public function getBilling(): IBilling
    {
        return $this->billing;
    }

    /**
     * @param IBilling $billing
     * @return BasketBuilder
     */
    public function setBilling(IBilling $billing): BasketBuilder
    {
        $this->billing = $billing;
        return $this;
    }

    /**
     * @return ISecurity
     */
    public function getSecurity(): ISecurity
    {
        return $this->security;
    }

    /**
     * @param ISecurity $security
     * @return BasketBuilder
     */
    public function setSecurity(ISecurity $security): BasketBuilder
    {
        $this->security = $security;
        return $this;
    }

    /**
     * @return ICommunication
     */
    public function getCommunication(): ICommunication
    {
        return $this->communication;
    }

    /**
     * @param ICommunication $communication
     * @return BasketBuilder
     */
    public function setCommunication(ICommunication $communication): BasketBuilder
    {
        $this->communication = $communication;
        return $this;
    }

    public function build(): CheckoutProcess
    {
        return new CheckoutProcess($this);
    }
}
