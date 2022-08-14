<?php

namespace Pada\Tinkoff\Payment\Model\GetState;

use Pada\Tinkoff\Payment\Contract\GetStateInterface;
use Pada\Tinkoff\Payment\Model\AbstractRequest;

final class GetState extends AbstractRequest implements GetStateInterface
{
    private int $paymentId = 0;
    private ?string $ip = null;

    public function getPaymentId(): int
    {
        return $this->paymentId;
    }

    public function setPaymentId(int $paymentId): void
    {
        $this->paymentId = $paymentId;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(?string $ip): void
    {
        $this->ip = $ip;
    }
}
