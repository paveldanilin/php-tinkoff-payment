<?php

namespace Pada\Tinkoff\Payment\Contract;

interface CancelResultInterface extends ResultInterface
{
    public function getTerminalKey(): string;
    public function getOrderId(): string;
    public function getPaymentId(): int;
    public function getOriginalAmount(): int;
    public function getNewAmount(): int;
    public function getStatus(): string;
}
