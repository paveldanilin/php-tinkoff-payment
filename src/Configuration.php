<?php

namespace Pada\Tinkoff\Payment;

use RestClient\Configuration\DefaultConfiguration;

final class Configuration extends DefaultConfiguration
{
    private string $terminalKey = '';
    private string $password = '';

    public function __construct()
    {
        $this->setBaseUri(Constant::PAY_BASE_URI);
    }

    public function getTerminalKey(): string
    {
        return $this->terminalKey;
    }

    public function setTerminalKey(string $terminalKey): void
    {
        $this->terminalKey = $terminalKey;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
