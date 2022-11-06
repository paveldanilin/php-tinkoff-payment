<?php

namespace Pada\Tinkoff\Payment\Model\Charge;

use Pada\Tinkoff\Payment\Contract\ChargeInterface;
use Pada\Tinkoff\Payment\Model\AbstractRequest;

/**
 * @see https://www.tinkoff.ru/kassa/develop/api/autopayments/charge-request/
 */
final class Charge extends AbstractRequest implements ChargeInterface
{
    /**
     * Идентификатор платежа в системе банка
     * @var int
     */
    private int $paymentId = 0;

    /**
     * Идентификатор автоплатежа
     * @var int
     */
    private int $rebillId = 0;

    /**
     * Получение покупателем уведомлений на электронную почту
     * @var bool|null
     */
    private ?bool $sendEmail = null;

    /**
     * Электронная почта покупателя
     * Обязательный, если передан параметр SendEmail
     * @var string
     */
    private string $infoEmail = '';

    /**
     * IP-адрес покупателя
     * @var string|null
     */
    private ?string $ip = null;

    public function getPaymentId(): int
    {
        return $this->paymentId;
    }

    public function setPaymentId(int $paymentId): void
    {
        $this->paymentId = $paymentId;
    }

    public function getRebillId(): int
    {
        return $this->rebillId;
    }

    public function setRebillId(int $rebillId): void
    {
        $this->rebillId = $rebillId;
    }

    public function getSendEmail(): ?bool
    {
        return $this->sendEmail;
    }

    public function setSendEmail(?bool $sendEmail): void
    {
        $this->sendEmail = $sendEmail;
    }

    public function getInfoEmail(): string
    {
        return $this->infoEmail;
    }

    public function setInfoEmail(string $infoEmail): void
    {
        $this->infoEmail = $infoEmail;
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
