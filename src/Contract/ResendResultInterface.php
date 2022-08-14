<?php

namespace Pada\Tinkoff\Payment\Contract;

interface ResendResultInterface extends ResultInterface
{
    public function getCount(): int;
}
