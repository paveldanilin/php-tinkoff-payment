<?php

namespace Pada\Tinkoff\Payment\Model\CheckOrder;

use Pada\Tinkoff\Payment\Contract\CheckOrderInterface;
use Pada\Tinkoff\Payment\Model\AbstractRequest;

final class CheckOrder extends AbstractRequest implements CheckOrderInterface
{
    private int $orderId = 0;

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): void
    {
        $this->orderId = $orderId;
    }
}
