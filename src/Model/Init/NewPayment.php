<?php

namespace Pada\Tinkoff\Payment\Model\Init;

use Pada\Tinkoff\Payment\Contract\NewPaymentInterface;
use Pada\Tinkoff\Payment\DataKV;
use Pada\Tinkoff\Payment\Model\AbstractRequest;

final class NewPayment extends AbstractRequest implements NewPaymentInterface
{
    private int $amount = 0;
    private string $orderId = '';
    private ?string $payType = null; // Constant::LANGUAGE_xx
    private ?string $ip = null;
    private ?string $description = null;
    private ?string $language = null; // Constant::PAY_TYPE_xxx
    private ?string $successURL = null;
    private ?string $failURL = null;
    private ?string $notificationURL = null;
    private ?DataKV $data = null;

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

    public function setSuccessURL(string $successURL): void
    {
        $this->successURL = $successURL;
    }

    public function getFailURL(): ?string
    {
        return $this->failURL;
    }

    public function setFailURL(string $failURL): void
    {
        $this->failURL = $failURL;
    }

    public function getNotificationURL(): ?string
    {
        return $this->notificationURL;
    }

    public function setNotificationURL(string $notificationURL): void
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
}
