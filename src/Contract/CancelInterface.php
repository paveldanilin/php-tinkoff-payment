<?php

namespace Pada\Tinkoff\Payment\Contract;

interface CancelInterface extends TerminalKeyAwareInterface, TokenAwareInterface
{
    public function getPaymentId(): int;
    public function getAmount(): ?int;
    public function getIp(): ?string;
    public function getReceipt(): ?ReceiptInterface;
}
