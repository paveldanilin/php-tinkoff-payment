<?php

namespace Pada\Tinkoff\Payment\Contract;

interface NewPaymentResultInterface extends ResultInterface
{
    public function getTerminalKey(): string;
    public function getAmount(): int;
    public function getOrderId(): string;
    public function getPaymentId(): int;
}
