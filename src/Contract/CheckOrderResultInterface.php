<?php

namespace Pada\Tinkoff\Payment\Contract;

interface CheckOrderResultInterface extends ResultInterface
{
    public function getOrderId(): string;

    /**
     * @return array<PaymentInterface>
     */
    public function getPayments(): array;
}
