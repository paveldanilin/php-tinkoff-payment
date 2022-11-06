<?php

namespace Pada\Tinkoff\Payment\Contract;

/**
 * @see https://www.tinkoff.ru/kassa/develop/api/autopayments/charge-response/
 */
interface ChargeResultInterface extends ResultInterface
{
    public function getTerminalKey(): string;
    public function getAmount(): int;
    public function getOrderId(): string;
    public function getStatus(): string;
    public function getPaymentId(): int;
}
