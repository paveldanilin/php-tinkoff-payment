<?php

namespace Pada\Tinkoff\Payment\Model\Init;

use Pada\Tinkoff\Payment\Constant;
use Pada\Tinkoff\Payment\Contract\NewPaymentResultInterface;
use Pada\Tinkoff\Payment\Model\AbstractResult;

/**
 * @see https://www.tinkoff.ru/kassa/develop/api/payments/init-response/
 */
final class NewPaymentResult extends AbstractResult implements NewPaymentResultInterface
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
     * Идентификатор платежа в системе банка
     * @var int
     */
    private int $paymentId = 0;

    /**
     * Ссылка на платежную форму
     * @var string|null
     */
    private ?string $paymentURL = null;

    /**
     * Статус платежа
     * @var string|null
     */
    private ?string $status = null;


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

    public function getPaymentId(): int
    {
        return $this->paymentId;
    }

    public function setPaymentId(int $paymentId): void
    {
        $this->paymentId = $paymentId;
    }

    public function getPaymentURL(): ?string
    {
        return $this->paymentURL;
    }

    public function setPaymentURL(?string $paymentURL): void
    {
        $this->paymentURL = $paymentURL;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function isStatusNew(): bool
    {
        return Constant::PAYMENT_NEW === $this->status;
    }

    public function isStatusRejected(): bool
    {
        return Constant::PAYMENT_REJECTED === $this->status;
    }
}
