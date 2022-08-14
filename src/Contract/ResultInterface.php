<?php

namespace Pada\Tinkoff\Payment\Contract;

interface ResultInterface
{
    public function getMessage(): ?string;
    public function getDetails(): ?string;
    public function isSuccess(): bool;
    public function getErrorCode(): string;
}
