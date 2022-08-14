<?php

namespace Pada\Tinkoff\Payment\Model\Resend;

use Pada\Tinkoff\Payment\Contract\ResendResultInterface;
use Pada\Tinkoff\Payment\Model\AbstractResult;

final class ResendResult extends AbstractResult implements ResendResultInterface
{
    private int $count = 0;

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): void
    {
        $this->count = $count;
    }
}
