<?php

namespace Pada\Tinkoff\Tests;

use Pada\Tinkoff\Payment\Configuration;
use Pada\Tinkoff\Payment\Model\Charge\Charge;
use Pada\Tinkoff\Payment\PaymentClient;
use Pada\Tinkoff\Payment\PaymentClientInterface;
use PHPUnit\Framework\TestCase;
use RestClient\Testing\TestClient;

class ChargeTest extends TestCase
{
    private static PaymentClientInterface $paymentClient;

    public static function setUpBeforeClass(): void
    {
        $testClient = new TestClient([
            // https://www.tinkoff.ru/kassa/develop/api/autopayments/charge-description/
            'POST?uri=/v2/Charge' => [
                'json' => [
                    "Success" => true,
                    "ErrorCode" => "0",
                    "TerminalKey" => "TestB",
                    "Status" => "CONFIRMED",
                    "PaymentId" => "10063",
                    "OrderId" =>  "21054",
                ]
            ],
        ]);

        static::$paymentClient = new PaymentClient(new Configuration());
        static::$paymentClient->setHttpClient($testClient);
    }

    public function testCharge(): void
    {
        $charge = new Charge();
        $charge->setPaymentId(10063);
        $charge->setRebillId(1234);
        $chargeResult = static::$paymentClient->charge($charge);

        $this->assertTrue($chargeResult->isSuccess());
        $this->assertEquals('CONFIRMED', $chargeResult->getStatus());
        $this->assertEquals(10063, $chargeResult->getPaymentId());
    }
}
