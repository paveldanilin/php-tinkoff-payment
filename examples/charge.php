<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Pada\Tinkoff\Payment\PaymentClient;
use Psr\Log\LogLevel;
use RestClient\Interceptor\LogRequestInterceptor;
use function Pada\Tinkoff\Payment\Functions\newCharge;
use function Pada\Tinkoff\Payment\Functions\newPayment;
use function Pada\Tinkoff\Payment\Functions\newReceipt;
use function Pada\Tinkoff\Payment\Functions\newReceiptItem;

require 'vendor/autoload.php';


// 1 - Создание клиента
$paymentClient = PaymentClient::create('<terminal_key>', '<password>');

// Создаем логгер
$logger = new Logger('payment');
$logger->pushHandler(new StreamHandler('payment.log', LogLevel::DEBUG));

$paymentClient->pushInterceptor(new LogRequestInterceptor($logger));

// 2 - Создание обьекта платежа
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

// 3 - Создаем платеж
$paymentID = null;
$result = $paymentClient->init($payment);

if ($result->isSuccess()) {
    $paymentID = $result->getPaymentId();
    print 'PaymentId:  ' . $result->getPaymentId() . "\n";
    print 'PaymentURL: ' . $result->getPaymentURL() . "\n";
} else {
    die('Error: ' . $result->getMessage() . "\n" . 'Details: ' . ($result->getDetails() ?? '') . "\n" . 'Error code:' . $result->getErrorCode() . "\n");
}

// 4 - Вызываем Charge
$charge = newCharge($paymentID, 3310);
$chargeResult = $paymentClient->charge($charge);

if ($chargeResult->isSuccess()) {
    print "Charge - OK\n";
} else {
    die('Error: ' . $chargeResult->getMessage() . "\n" . 'Details: ' . ($chargeResult->getDetails() ?? '') . "\n" . 'Error code:' . $chargeResult->getErrorCode() . "\n");
}
