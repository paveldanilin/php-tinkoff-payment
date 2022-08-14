<?php

namespace Pada\Tinkoff\Payment\Contract;

interface GetStateInterface extends TerminalKeyAwareInterface, TokenAwareInterface
{
    public function getPaymentId(): int;
    public function getIp(): ?string;
}
