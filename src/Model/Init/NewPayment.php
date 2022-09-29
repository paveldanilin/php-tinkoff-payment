<?php

namespace Pada\Tinkoff\Payment\Model\Init;

use Pada\Tinkoff\Payment\Contract\NewPaymentInterface;
use Pada\Tinkoff\Payment\Contract\ReceiptInterface;
use Pada\Tinkoff\Payment\DataKV;
use Pada\Tinkoff\Payment\Model\AbstractRequest;

final class NewPayment extends AbstractRequest implements NewPaymentInterface
{
    private int $amount = 0;
    private string $orderId = '';
    private ?string $payType = null;
    private ?string $ip = null;
    private ?string $description = null;
    private ?string $language = null;
    private ?string $successURL = null;
    private ?string $failURL = null;
    private ?string $notificationURL = null;
    private ?DataKV $data = null;
    private ?ReceiptInterface $receipt = null;
    private bool $isRecurrent = false;
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
