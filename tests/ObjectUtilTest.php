<?php

namespace Pada\Tinkoff\Tests;

use Pada\Tinkoff\Payment\ObjectUtil;
use PHPUnit\Framework\TestCase;
use function Pada\Tinkoff\Payment\Functions\newPayment;

class ObjectUtilTest extends TestCase
{
    public function testToArrayWithDateAndTime(): void
    {
        $now = new \DateTime();

        $payment = newPayment()
            ->orderId('123')
            ->oneStep()
            ->amount(123)
            ->redirectDueDate($now);

        $arr = ObjectUtil::toArray($payment);

        $this->assertEquals($now->format(\DateTime::ATOM), $arr['redirectDueDate'] ?? '');
    }
}
