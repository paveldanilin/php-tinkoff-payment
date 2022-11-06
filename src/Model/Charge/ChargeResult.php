<?php

namespace Pada\Tinkoff\Payment\Model\Charge;

use Pada\Tinkoff\Payment\Contract\ChargeResultInterface;
use Pada\Tinkoff\Payment\Model\AbstractResult;

/**
 * @see @see https://www.tinkoff.ru/kassa/develop/api/autopayments/charge-response/
 */
final class ChargeResult extends AbstractResult implements ChargeResultInterface
{
    /**
     * Идентификатор терминала. Выдается продавцу банком при заведении терминала
     * @var string
     */
    private string $terminalKey = '';

    /**
     * Сумма в копейках
     * @var int
     */
    private int $amount = 0;

    /**
     * Идентификатор заказа в системе продавца
     * @var string
     */
    private string $orderId = '';

    /**
     * Статус платежа
     * @var string
     */
    private string $status = '';

    /**
     * Уникальный идентификатор транзакции в системе банка
     * @var int
     */
    private int $paymentId = 0;


    public function getTerminalKey(): string
    {
        return $this->terminalKey;
    }

    public function setTerminalKey(string $terminalKey): void
    {
        $this->terminalKey = $terminalKey;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function setOrderId(string $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getPaymentId(): int
    {
        return $this->paymentId;
    }

    public function setPaymentId(int $paymentId): void
    {
        $this->paymentId = $paymentId;
    }
}
