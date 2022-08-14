<?php

namespace Pada\Tinkoff\Payment\Model\CheckOrder;

use Pada\Tinkoff\Payment\Contract\PaymentInterface;

final class Payment implements PaymentInterface
{
    private int $paymentId = 0;
    private ?int $amount = null;
    private string $status = '';
    private ?string $RRN = null;
    private string $success = '';
    private string $errorCode = '0';
    private string $message = '';

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

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getRRN(): ?string
    {
        return $this->RRN;
    }

    public function setRRN(?string $RRN): void
    {
        $this->RRN = $RRN;
    }

    public function getSuccess(): string
    {
        return $this->success;
    }

    public function setSuccess(string $success): void
    {
        $this->success = $success;
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    public function setErrorCode(string $errorCode): void
    {
        $this->errorCode = $errorCode;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}
