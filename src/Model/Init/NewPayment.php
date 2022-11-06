<?php

namespace Pada\Tinkoff\Payment\Model\Init;

use Pada\Tinkoff\Payment\Contract\NewPaymentInterface;
use Pada\Tinkoff\Payment\Contract\ReceiptInterface;
use Pada\Tinkoff\Payment\DataKV;
use Pada\Tinkoff\Payment\Model\AbstractRequest;

/**
 * @see https://www.tinkoff.ru/kassa/develop/api/payments/init-request/
 */
final class NewPayment extends AbstractRequest implements NewPaymentInterface
{
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
     * Тип оплаты:
     *   O — одностадийная
     *   T — двухстадийная
     * @var string|null
     */
    private ?string $payType = null;

    /**
     * IP-адрес покупателя
     * @var string|null
     */
    private ?string $ip = null;

    /**
     * Описание заказа
     * @var string|null
     */
    private ?string $description = null;

    /**
     * Язык платежной формы:
     *   ru — русский
     *   en — английский
     * Если не передан, форма откроется на русском языке
     * @var string|null
     */
    private ?string $language = null;

    /**
     * Страница успеха
     * Если не передан, принимает значение, указанное в настройках терминала
     * @var string|null
     */
    private ?string $successURL = null;

    /**
     * Страница ошибки
     * Если не передан, принимает значение, указанное в настройках терминала
     * @var string|null
     */
    private ?string $failURL = null;

    /**
     * Адрес для получения http нотификаций
     * Если не передан, принимает значение, указанное в настройках терминала
     * @var string|null
     */
    private ?string $notificationURL = null;

    /**
     * Дополнительные параметры платежа в формате "ключ":"значение" (не более 20 пар).
     * Наименование самого параметра должно быть в верхнем регистре, иначе его содержимое будет игнорироваться.
     * @var DataKV|null
     */
    private ?DataKV $data = null;

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/receipt/
     *
     * Массив данных чека.
     * @var ReceiptInterface|null
     */
    private ?ReceiptInterface $receipt = null;

    /**
     * Для регистрации автоплатежа
     * @var bool
     */
    private bool $isRecurrent = false;

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/autopayments/getcardlist-description/
     *
     * Идентификатор покупателя в системе продавца. Передается вместе с параметром CardId.
     * Также необходим для сохранения карт на платежной форме (платежи в один клик).
     * @var string|null
     */
    private ?string $customerKey = null;

    /**
     * Временная метка по стандарту ISO8601 в формате YYYY-MM-DDThh:mm:ss±hh:mm
     * @var \DateTime|null
     */
    private ?\DateTime $redirectDueDate = null;


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

    public function getPayType(): ?string
    {
        return $this->payType;
    }

    public function setPayType(?string $payType): void
    {
        $this->payType = $payType;
    }

    public function getSuccessURL(): ?string
    {
        return $this->successURL;
    }

    public function setSuccessURL(?string $successURL): void
    {
        $this->successURL = $successURL;
    }

    public function getFailURL(): ?string
    {
        return $this->failURL;
    }

    public function setFailURL(?string $failURL): void
    {
        $this->failURL = $failURL;
    }

    public function getNotificationURL(): ?string
    {
        return $this->notificationURL;
    }

    public function setNotificationURL(?string $notificationURL): void
    {
        $this->notificationURL = $notificationURL;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(?string $ip): void
    {
        $this->ip = $ip;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): void
    {
        $this->language = $language;
    }

    public function getData(): ?DataKV
    {
        return $this->data;
    }

    public function setData(?DataKV $data): void
    {
        $this->data = $data;
    }

    public function getReceipt(): ?ReceiptInterface
    {
        return $this->receipt;
    }

    public function setReceipt(?ReceiptInterface $receipt): void
    {
        $this->receipt = $receipt;
    }

    public function isRecurrent(): bool
    {
        return $this->isRecurrent;
    }

    public function setRecurrent(bool $recurrent): void
    {
        $this->isRecurrent = $recurrent;
    }

    public function getCustomerKey(): ?string
    {
        return $this->customerKey;
    }

    public function setCustomerKey(?string $customerKey): void
    {
        $this->customerKey = $customerKey;
    }

    public function getRedirectDueDate(): ?\DateTime
    {
        return $this->redirectDueDate;
    }

    public function setRedirectDueDate(?\DateTime $redirectDueDate): void
    {
        $this->redirectDueDate = $redirectDueDate;
    }
}
