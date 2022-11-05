<?php

namespace Pada\Tinkoff\Tests;

use Pada\Tinkoff\Payment\Configuration;
use Pada\Tinkoff\Payment\PaymentClient;
use Pada\Tinkoff\Payment\PaymentClientInterface;
use PHPUnit\Framework\TestCase;
use RestClient\Testing\RequestHandler;
use RestClient\Testing\TestClient;
use function Pada\Tinkoff\Payment\Functions\newPayment;
use function Pada\Tinkoff\Payment\Functions\newReceipt;
use function Pada\Tinkoff\Payment\Functions\newReceiptItem;

class PaymentClientTest extends TestCase
{
    private static PaymentClientInterface $paymentClient;

    public static function setUpBeforeClass(): void
    {
        $testClient = new TestClient(new RequestHandler(fn() => 'NOK'), [
            // https://www.tinkoff.ru/kassa/develop/api/payments/init-description/
            'POST?uri=/v2/Init' => [
                'json' => [
                    'Success' => true,
                    'ErrorCode' => "0",
                    'TerminalKey' => "TinkoffBankTest",
                    'Status' => "NEW",
                    'PaymentId' => "13660",
                    'OrderId' => "21050",
                    'Amount' => 100000,
                    'PaymentURL' => "https://securepay.tinkoff.ru/rest/Authorize/1B63Y1"
                ]
            ],
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

    public function testInit(): void
    {
        $payment = newPayment()
            ->orderId('1234')
            ->oneStep()
            ->receipt(newReceipt()
                ->email('pavel.k.danilin@gmail.com')
                ->taxationOSN()
                ->addItem(newReceiptItem()
                    ->name('Кружка')
                    ->price(1000)
                    ->quantity(1)
                    ->taxNone()
                    ->build())
                ->build())
            ->build();

        $paymentResult = static::$paymentClient->init($payment);

        $this->assertTrue($paymentResult->isSuccess());
        $this->assertEquals('0', $paymentResult->getErrorCode());
        $this->assertEquals('TinkoffBankTest', $paymentResult->getTerminalKey());
        $this->assertEquals('NEW', $paymentResult->getStatus());
    }

    public function testCancel(): void
    {
        $cancelResult = static::$paymentClient->cancel(1234);

        $this->assertTrue($cancelResult->isSuccess());
        $this->assertEquals('PAYMENT117539', $cancelResult->getOrderId());
    }

    public function testGetState(): void
    {
        $stateResult = static::$paymentClient->getState(1234);

        $this->assertTrue($stateResult->isSuccess());
        $this->assertEquals('CONFIRMED', $stateResult->getStatus());
    }

    public function testCheckOrder(): void
    {
        $checkOrderResult = static::$paymentClient->checkOrder('123');

        $this->assertTrue($checkOrderResult->isSuccess());
        $this->assertCount(3, $checkOrderResult->getPayments());
        $this->assertEquals('REJECTED', $checkOrderResult->getPayments()[0]->getStatus());
    }
}
