<?php

namespace Pada\Tinkoff\Tests;

use Pada\Tinkoff\Payment\Configuration;
use Pada\Tinkoff\Payment\PaymentClient;
use Pada\Tinkoff\Payment\PaymentClientInterface;
use PHPUnit\Framework\TestCase;
use RestClient\Testing\TestClient;

class CheckOrderTest extends TestCase
{
    private static PaymentClientInterface $paymentClient;

    public static function setUpBeforeClass(): void
    {
        $testClient = new TestClient([
            // https://www.tinkoff.ru/kassa/develop/api/payments/checkorder-description/
            'POST?uri=/v2/CheckOrder' => [
                'json' => [
                    "Success" => true,
                    "ErrorCode" => "0",
                    "Message" => "OK",
                    "OrderId" => "21057",
                    "TerminalKey" => "TinkoffBankTest",
                    "Payments" => [
                        [
                            "Status" => "REJECTED",
                            "PaymentId" => 10063,
                            "Rrn" => 1234567,
                            "Amount" => 555,
                            "Success" => false,
                            "ErrorCode" => "1051",
                            "Message" => "Недостаточно средств на карте"
                        ],
                        [
                            "Status" => "AUTH_FAIL",
                            "PaymentId" => 1005563,
                            "Rrn" => 1234567,
                            "Amount" => 555,
                            "Success" => false,
                            "ErrorCode" => "76",
                            "Message" => "Операция по иностранной карте недоступна."
                        ],
                        [
                            "Status" => "NEW",
                            "PaymentId" => 100553363,
                            "Rrn" => 1234567,
                            "Amount" => 555,
                            "Success" => true,
                            "ErrorCode" => "0",
                            "Message" => "ok"
                        ]
                    ]
                ]
            ]
        ]);

        static::$paymentClient = new PaymentClient(new Configuration());
        static::$paymentClient->setHttpClient($testClient);
    }

    public function testCheckOrder(): void
    {
        $checkOrderResult = static::$paymentClient->checkOrder('123');

        $this->assertTrue($checkOrderResult->isSuccess());
        $this->assertCount(3, $checkOrderResult->getPayments());
        $this->assertEquals('REJECTED', $checkOrderResult->getPayments()[0]->getStatus());
    }
}
