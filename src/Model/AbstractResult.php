<?php

namespace Pada\Tinkoff\Payment\Model;

abstract class AbstractResult
{
    private bool $success = false;
    private string $errorCode = '0';
    private ?string $message = null;
    private ?string $details = null;

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): void
    {
        $this->details = $details;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): void
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
}
