<?php

namespace Pada\Tinkoff\Payment\Contract;

interface GetStateResultInterface extends ResultInterface
{
    public function getTerminalKey(): string;
    public function getOrderId(): string;
    public function getPaymentId(): int;
    public function getAmount(): int;
    public function getStatus(): string;
}
