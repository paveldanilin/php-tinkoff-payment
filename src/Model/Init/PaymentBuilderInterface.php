<?php

namespace Pada\Tinkoff\Payment\Model\Init;

use Pada\Tinkoff\Payment\Contract\NewPaymentInterface;

interface PaymentBuilderInterface
{
    public function build(): NewPaymentInterface;
}
