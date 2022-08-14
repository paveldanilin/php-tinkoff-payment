<?php

namespace Pada\Tinkoff\Payment\Model\CheckOrder;

use Pada\Tinkoff\Payment\Contract\CheckOrderResultInterface;
use Pada\Tinkoff\Payment\Contract\PaymentInterface;
use Pada\Tinkoff\Payment\Model\AbstractResult;

final class CheckOrderResult extends AbstractResult implements CheckOrderResultInterface
{
    private string $orderId = '';

    /**
     * @var array<PaymentInterface>
     */
    private array $payments = [];

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function setOrderId(string $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function getPayments(): array
    {
        return $this->payments;
    }

    public function setPayments(array $payments): void
    {
        $this->payments = $payments;
    }
}
