<?php

namespace Pada\Tinkoff\Payment\Model\Confirm;

use Pada\Tinkoff\Payment\Contract\ConfirmInterface;
use Pada\Tinkoff\Payment\Contract\ReceiptInterface;
use Pada\Tinkoff\Payment\Model\AbstractRequest;

final class Confirm extends AbstractRequest implements ConfirmInterface
{
    private int $paymentId = 0;
    private ?int $amount = null;
    private ?string $ip = null;
    private ?ReceiptInterface $receipt = null;

    public function getPaymentId(): int
    {
        return $this->paymentId;
    }

    public function setPaymentId(int $paymentId): void
    {
        $this->paymentId = $paymentId;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): void
    {
        $this->amount = $amount;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(?string $ip): void
    {
        $this->ip = $ip;
    }

    public function getReceipt(): ?ReceiptInterface
    {
        return $this->receipt;
    }

    public function setReceipt(?ReceiptInterface $receipt): void
    {
        $this->receipt = $receipt;
    }
}
