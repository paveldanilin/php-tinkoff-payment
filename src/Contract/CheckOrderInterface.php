<?php

namespace Pada\Tinkoff\Payment\Contract;

interface CheckOrderInterface extends TerminalKeyAwareInterface, TokenAwareInterface
{
    public function getOrderId(): string;
}
