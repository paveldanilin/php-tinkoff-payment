<?php

namespace Pada\Tinkoff\Payment\Contract;

/**
 * @see https://www.tinkoff.ru/kassa/develop/api/autopayments/charge-request/
 */
interface ChargeInterface extends TerminalKeyAwareInterface, TokenAwareInterface
{
    /**
     * Идентификатор платежа в системе банка
     * @return int
     */
    public function getPaymentId(): int;

    /**
     * Идентификатор автоплатежа
     * @return int
     */
    public function getRebillId(): int;

    /**
     * Получение покупателем уведомлений на электронную почту
     * @return bool|null
     */
    public function getSendEmail(): ?bool;

    /**
     * Электронная почта покупателя
     * Обязательный, если передан параметр SendEmail
     * @return string
     */
    public function getInfoEmail(): string;

    /**
     * IP-адрес покупателя
     * @return string|null
     */
    public function getIp(): ?string;
}
