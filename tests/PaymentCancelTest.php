<?php

namespace Pada\Tinkoff\Tests;

use Pada\Tinkoff\Payment\Configuration;
use Pada\Tinkoff\Payment\PaymentClient;
use Pada\Tinkoff\Payment\PaymentClientInterface;
use PHPUnit\Framework\TestCase;
use RestClient\Testing\TestClient;

class PaymentCancelTest extends TestCase
{
    private static PaymentClientInterface $paymentClient;

    public static function setUpBeforeClass(): void
    {
        $testClient = new TestClient([
            // https://www.tinkoff.ru/kassa/develop/api/payments/cancel-description/
            'POST?uri=/v2/Cancel' => [
                'json' => [
                    "Success" => true,
                    "ErrorCode" => "0",
                    "TerminalKey" => "TinkoffBankTest",
                    "Status" => "REFUNDED",
                    "PaymentId" => "2164657",
                    "OrderId" => "PAYMENT117539",
                    "OriginalAmount" => 1000,
                    "NewAmount" => 0
                ]
            ],
        ]);

        static::$paymentClient = new PaymentClient(new Configuration());
        static::$paymentClient->setHttpClient($testClient);
    }

    public function testCancel(): void
    {
        $cancelResult = static::$paymentClient->cancel(1234);

        $this->assertTrue($cancelResult->isSuccess());
        $this->assertEquals('PAYMENT117539', $cancelResult->getOrderId());
    }
}
