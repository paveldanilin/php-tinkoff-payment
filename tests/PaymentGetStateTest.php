<?php

namespace Pada\Tinkoff\Tests;

use Pada\Tinkoff\Payment\Configuration;
use Pada\Tinkoff\Payment\PaymentClient;
use Pada\Tinkoff\Payment\PaymentClientInterface;
use PHPUnit\Framework\TestCase;
use RestClient\Testing\TestClient;

class PaymentGetStateTest extends TestCase
{
    private static PaymentClientInterface $paymentClient;

    public static function setUpBeforeClass(): void
    {
        $testClient = new TestClient([
            // https://www.tinkoff.ru/kassa/develop/api/payments/getstate-description/
            'POST?uri=/v2/GetState' => [
                'json' => [
                    "Success" => true,
                    "ErrorCode" => "0",
                    "Message" => "OK",
                    "TerminalKey" => "TinkoffBankTest",
                    "Status" => "CONFIRMED",
                    "PaymentId" => "2304882",
                    "OrderId" => "#419",
                    "Amount" => 1000
                ]
            ],
        ]);

        static::$paymentClient = new PaymentClient(new Configuration());
        static::$paymentClient->setHttpClient($testClient);
    }

    public function testGetState(): void
    {
        $stateResult = static::$paymentClient->getState(1234);

        $this->assertTrue($stateResult->isSuccess());
        $this->assertEquals('CONFIRMED', $stateResult->getStatus());
    }
}
