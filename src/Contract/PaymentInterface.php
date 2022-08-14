<?php

namespace Pada\Tinkoff\Payment\Contract;

interface PaymentInterface
{
    public function getPaymentId(): int;
    public function getAmount(): ?int;
    public function getStatus(): string;
    public function getRRN(): ?string;
    public function getSuccess(): string;
    public function getErrorCode(): string;
    public function getMessage(): string;
}
