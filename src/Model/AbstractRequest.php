<?php

namespace Pada\Tinkoff\Payment\Model;

abstract class AbstractRequest
{
    private string $terminalKey = '';
    private string $token = '';

    public function setTerminalKey(string $terminalKey): void
    {
        $this->terminalKey = $terminalKey;
    }

    public function getTerminalKey(): string
    {
        return $this->terminalKey;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
