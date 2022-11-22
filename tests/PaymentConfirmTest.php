<?php

namespace Pada\Tinkoff\Tests;

use Pada\Tinkoff\Payment\Configuration;
use Pada\Tinkoff\Payment\PaymentClient;
use Pada\Tinkoff\Payment\PaymentClientInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use RestClient\Testing\TestClient;
use function Pada\Tinkoff\Payment\Functions\newReceipt;

class PaymentConfirmTest extends TestCase
{
    private static PaymentClientInterface $paymentClient;

    public static function setUpBeforeClass(): void
    {
        $testClient = new TestClient([
            // https://www.tinkoff.ru/kassa/develop/api/payments/confirm-description/
            'POST?uri=/v2/Confirm' => static function (RequestInterface $request) {
                $jsonBody = \json_decode((string)$request->getBody(), true);

                if ($jsonBody['PaymentId'] === 123) {
                    return \json_encode([
                        "Success" => true,
                        "ErrorCode" => "0",
                        "TerminalKey" => "TinkoffBankTest",
                        "Status" => "CONFIRMED",
                        "PaymentId" => "123",
                        "OrderId" => "PAYMENT117539",
                    ]);
                }

                if ($jsonBody['PaymentId'] === 321) {
                    return \json_encode([
                        "Success" => true,
                        "ErrorCode" => "0",
                        "TerminalKey" => "TinkoffBankTest",
                        "Status" => "CONFIRMED",
                        "PaymentId" => "321",
                        "OrderId" => "PAYMENT117539",
                    ]);
                }

                return \json_encode([
                    'Success' => false
                ]);
            },
        ]);

        static::$paymentClient = new PaymentClient(new Configuration());
        static::$paymentClient->setHttpClient($testClient);
    }

    public function testConfirm(): void
    {
        $confirmResult = static::$paymentClient->confirm(321);

        $this->assertTrue($confirmResult->isSuccess());
        $this->assertEquals('PAYMENT117539', $confirmResult->getOrderId());
        $this->assertEquals('CONFIRMED', $confirmResult->getStatus());
        $this->assertEquals('TinkoffBankTest', $confirmResult->getTerminalKey());
        $this->assertEquals('321', $confirmResult->getPaymentId());
    }

    public function testConfirmWithReceipt(): void
    {
        $confirmResult = static::$paymentClient->confirmWithReceipt(123, newReceipt()
            ->email('user@mail.com')
            ->taxationENVD()
            ->build());

        $this->assertTrue($confirmResult->isSuccess());
        $this->assertEquals('PAYMENT117539', $confirmResult->getOrderId());
        $this->assertEquals('CONFIRMED', $confirmResult->getStatus());
        $this->assertEquals('TinkoffBankTest', $confirmResult->getTerminalKey());
        $this->assertEquals('123', $confirmResult->getPaymentId());
    }
}
