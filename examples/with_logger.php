<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Pada\Tinkoff\Payment\PaymentClient;
use Psr\Log\LogLevel;
use RestClient\Interceptor\LogRequestInterceptor;
use function Pada\Tinkoff\Payment\Functions\newPayment;
use function Pada\Tinkoff\Payment\Functions\newReceipt;
use function Pada\Tinkoff\Payment\Functions\newReceiptItem;

require 'vendor/autoload.php';

// ------------------------------------------------------------------------------------------------
// 1 - Создание клиента

$paymentClient = PaymentClient::create('<terminal_key>', '<password>');


// ------------------------------------------------------------------------------------------------
// 2 - Создаем логгер
$logger = new Logger('payment');
$logger->pushHandler(new StreamHandler('payment.log', LogLevel::DEBUG));

$paymentClient->pushInterceptor(new LogRequestInterceptor($logger));


// ------------------------------------------------------------------------------------------------
// 3 - Вызываем API

$newPayment = newPayment()
    ->amount(100)
    ->orderId('123')
    ->oneStep()
    ->receipt(newReceipt()
        ->email('pavel.k.danilin@gmail.com')
        ->taxationENVD()
        ->addItem(newReceiptItem()
            ->name('Товар')
            ->price(100)
            ->quantity(1)
            ->taxNone()
            ->build())
        ->build())
->build();

// ------------------------------------------------------------------------------------------------
// 4 - Invoke API and process response

$result = $paymentClient->init($newPayment);

if ($result->isSuccess()) {
    print 'PaymentId: ' . $result->getPaymentId() . "\n";
} else {
    print 'Error: ' . $result->getMessage() . "\n";
}
