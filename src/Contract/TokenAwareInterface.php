<?php

namespace Pada\Tinkoff\Payment\Contract;

interface TokenAwareInterface
{
    public function setToken(string $token): void;
    public function getToken(): string;
}
