<?php

namespace Pada\Tinkoff\Payment\Contract;

interface ResultInterface
{
    /**
     * 	Краткое описание ошибки
     * @return string|null
     */
    public function getMessage(): ?string;

    /**
     * Подробное описание ошибки
     * @return string|null
     */
    public function getDetails(): ?string;

    /**
     * Выполнение платежа
     * @return bool
     */
    public function isSuccess(): bool;

    /**
     * Код ошибки
     * Если ошибки не произошло, передается значение «0»
     * @return string
     */
    public function getErrorCode(): string;
}
