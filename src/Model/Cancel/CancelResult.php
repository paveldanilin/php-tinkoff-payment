<?php

namespace Pada\Tinkoff\Payment\Model\Cancel;

use Pada\Tinkoff\Payment\Contract\CancelResultInterface;
use Pada\Tinkoff\Payment\Model\AbstractResult;

final class CancelResult extends AbstractResult implements CancelResultInterface
{
    private string $terminalKey = '';
    private string $orderId = '';
    private int $paymentId = 0;
    private int $originalAmount = 0;
    private int $newAmount = 0;
    private string $status = '';

    public function getTerminalKey(): string
    {
        return $this->terminalKey;
    }

    public function setTerminalKey(string $terminalKey): void
    {
        $this->terminalKey = $terminalKey;
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

    public function getOriginalAmount(): int
    {
        return $this->originalAmount;
    }

    public function setOriginalAmount(int $originalAmount): void
    {
        $this->originalAmount = $originalAmount;
    }

    public function getNewAmount(): int
    {
        return $this->newAmount;
    }

    public function setNewAmount(int $newAmount): void
    {
        $this->newAmount = $newAmount;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
