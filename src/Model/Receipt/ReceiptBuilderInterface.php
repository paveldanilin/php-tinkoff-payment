<?php

namespace Pada\Tinkoff\Payment\Model\Receipt;

use Pada\Tinkoff\Payment\Contract\ReceiptInterface;

interface ReceiptBuilderInterface
{
    public function build(): ReceiptInterface;
}
