<?php

namespace Pada\Tinkoff\Payment\Contract;

/**
 * @see https://www.tinkoff.ru/kassa/develop/api/payments/confirm-request/
 */
interface ConfirmInterface extends TerminalKeyAwareInterface, TokenAwareInterface
{
    /**
     * Идентификатор платежа в системе банка
     * @return int
     */
    public function getPaymentId(): int;

    /**
     * Сумма в копейках
     * @return int|null
     */
    public function getAmount(): ?int;

    /**
     * IP-адрес покупателя
     * @return string|null
     */
    public function getIp(): ?string;

    /**
     * Массив данных чека. См. Структура объекта Receipt
     * Имеет приоритет над данными, переданными в методе Init
     * @return ReceiptInterface|null
     */
    public function getReceipt(): ?ReceiptInterface;
}
