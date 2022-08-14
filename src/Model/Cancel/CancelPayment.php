<?php

namespace Pada\Tinkoff\Payment\Model\Cancel;

use Pada\Tinkoff\Payment\Contract\CancelInterface;
use Pada\Tinkoff\Payment\Model\AbstractRequest;

final class CancelPayment extends AbstractRequest implements CancelInterface
{
    private int $paymentId = 0;
    private ?int $amount = null;
    private ?string $ip = null;

    // TODO: Receipt	Массив данных чека. См. Структура объекта Receipt
    //В чеке указываются данные товаров, подлежащих возврату	object	Да, если настроена интеграция онлайн-кассы

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
}
