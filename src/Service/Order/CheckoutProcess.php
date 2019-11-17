<?php


namespace Service\Order;

use Service\Billing\IBilling;
use Service\Communication\ICommunication;
use Service\Discount\IDiscount;
use Service\User\ISecurity;

class CheckoutProcess
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

    public function __construct(BasketBuilder $builder)
    {
        $this->billing = $builder->getBilling();
        $this->communication = $builder->getCommunication();
        $this->discount = $builder->getDiscount();
        $this->security = $builder->getSecurity();
    }

    /**
     * Проведение всех этапов заказа
     *
     * @param Model\Entity\Product[]
     * @return void
     * @throws \Service\Billing\Exception\BillingException
     * @throws \Service\Communication\Exception\CommunicationException
     */
    public function checkoutProcess(array $products): void
    {
        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $product->getPrice();
        }

        $discount = $this->discount->getDiscount();
        $totalPrice = $totalPrice - $totalPrice * $discount;

        $this->billing->pay($totalPrice);

        $user = $this->security->getUser();
        $this->communication->process($user, 'checkout_template');
    }
}
