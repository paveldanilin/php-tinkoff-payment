<?php

namespace Pada\Tinkoff\Payment\Contract;

/**
 * @see https://www.tinkoff.ru/kassa/develop/api/payments/confirm-response/
 */
interface ConfirmResultInterface extends ResultInterface
{
    /**
     * Идентификатор терминала. Выдается продавцу банком при заведении терминала
     * @return string
     */
    public function getTerminalKey(): string;

    /**
     * Идентификатор заказа в системе продавца
     * @return string
     */
    public function getOrderId(): string;

    /**
     * Уникальный идентификатор транзакции в системе банка
     * @return int
     */
    public function getPaymentId(): int;

    /**
     * Статус платежа
     * @return string
     */
    public function getStatus(): string;
}
