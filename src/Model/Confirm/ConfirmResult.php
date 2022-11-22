<?php

namespace Pada\Tinkoff\Payment\Model\Confirm;

use Pada\Tinkoff\Payment\Contract\ConfirmResultInterface;
use Pada\Tinkoff\Payment\Model\AbstractResult;

final class ConfirmResult extends AbstractResult implements ConfirmResultInterface
{
    private string $terminalKey = '';
    private string $orderId = '';
    private int $paymentId = 0;
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

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
