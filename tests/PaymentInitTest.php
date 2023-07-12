<?php

namespace Pada\Tinkoff\Tests;

use Pada\Tinkoff\Payment\Configuration;
use Pada\Tinkoff\Payment\Constant;
use Pada\Tinkoff\Payment\PaymentClient;
use Pada\Tinkoff\Payment\PaymentClientInterface;
use PHPUnit\Framework\TestCase;
use RestClient\Testing\TestClient;
use function Pada\Tinkoff\Payment\Functions\newPayment;
use function Pada\Tinkoff\Payment\Functions\newReceipt;
use function Pada\Tinkoff\Payment\Functions\newReceiptItem;

class PaymentInitTest extends TestCase
{
    private static PaymentClientInterface $paymentClient;

    public static function setUpBeforeClass(): void
    {
        $testClient = new TestClient([
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
                    ->paymentObject(Constant::PAYMENT_OBJECT_COMMODITY)
                    ->paymentMethod(Constant::PAYMENT_METHOD_FULL)
                    ->build())
                ->build())
            ->build();

        $paymentResult = static::$paymentClient->init($payment);

        $this->assertTrue($paymentResult->isSuccess());
        $this->assertEquals('0', $paymentResult->getErrorCode());
        $this->assertEquals('TinkoffBankTest', $paymentResult->getTerminalKey());
        $this->assertEquals('NEW', $paymentResult->getStatus());
    }
}
