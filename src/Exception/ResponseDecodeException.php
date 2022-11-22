<?php

namespace Pada\Tinkoff\Payment\Exception;

class ResponseDecodeException extends PaymentException
{
    public const CODE = 1667737768;

    public function __construct(string $message = 'Could not decode response to target type')
    {
        parent::__construct($message, self::CODE);
    }
}
