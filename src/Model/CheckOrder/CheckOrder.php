<?php

namespace Pada\Tinkoff\Payment\Model\CheckOrder;

use Pada\Tinkoff\Payment\Contract\CheckOrderInterface;
use Pada\Tinkoff\Payment\Model\AbstractRequest;

final class CheckOrder extends AbstractRequest implements CheckOrderInterface
{
    private string $orderId = '';

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function setOrderId(string $orderId): void
    {
        $this->orderId = $orderId;
    }
}
