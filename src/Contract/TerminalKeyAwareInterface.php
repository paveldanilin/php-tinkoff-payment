<?php

namespace Pada\Tinkoff\Payment\Contract;

interface TerminalKeyAwareInterface
{
    public function setTerminalKey(string $terminalKey): void;
    public function getTerminalKey(): string;
}
