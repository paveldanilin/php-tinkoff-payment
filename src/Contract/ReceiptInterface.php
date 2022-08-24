<?php

namespace Pada\Tinkoff\Payment\Contract;

/**
 * @see https://www.tinkoff.ru/kassa/develop/api/receipt/
 */
interface ReceiptInterface
{
    public function getFfdVersion(): string;
    public function getEmail(): ?string;
    public function getPhone(): ?string;
    public function getTaxation(): string;

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/receipt/#Items
     * @return iterable
     */
    public function getItems(): iterable;
}
