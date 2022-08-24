<?php

namespace Pada\Tinkoff\Payment\Model\Init;

use Pada\Tinkoff\Payment\Constant;
use Pada\Tinkoff\Payment\Contract\NewPaymentResultInterface;
use Pada\Tinkoff\Payment\Model\AbstractResult;

final class NewPaymentResult extends AbstractResult implements NewPaymentResultInterface
{
    private string $terminalKey = '';
    private int $amount = 0;
    private string $orderId = '';
    private int $paymentId = 0;
    private ?string $paymentURL = null;
    private ?string $status = null;


    public function getTerminalKey(): string
    {
        return $this->terminalKey;
    }

    public function setTerminalKey(string $terminalKey): void
    {
        $this->terminalKey = $terminalKey;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function setOrderId(string $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function getPaymentId(): int
    {
        return $this->paymentId;
    }

    public function setPaymentId(int $paymentId): void
    {
        $this->paymentId = $paymentId;
    }

    public function getPaymentURL(): ?string
    {
        return $this->paymentURL;
    }

    public function setPaymentURL(?string $paymentURL): void
    {
        $this->paymentURL = $paymentURL;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function isStatusNew(): bool
    {
        return Constant::PAYMENT_NEW === $this->status;
    }

    public function isStatusRejected(): bool
    {
        return Constant::PAYMENT_REJECTED === $this->status;
    }
}
