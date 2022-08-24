<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Pada\Tinkoff\Payment\Configuration;
use Pada\Tinkoff\Payment\PaymentClient;
use Pada\Tinkoff\Payment\PaymentClientInterface;
use Pada\Tinkoff\Payment\Contract\NewPaymentResultInterface;
use Psr\Log\LogLevel;
use function Pada\Tinkoff\Payment\Functions\newPayment;
use function Pada\Tinkoff\Payment\Functions\newReceipt;
use function Pada\Tinkoff\Payment\Functions\newReceiptItem;

require 'vendor/autoload.php';

// ------------------------------------------------------------------------------------------------
// 1 - Create Payment client

$config = new Configuration();
$config->setTerminalKey('<terminal_key>');
$config->setPassword('<password>');

/** @var PaymentClientInterface $paymentClient */
$paymentClient = new PaymentClient($config);


// ------------------------------------------------------------------------------------------------
// 2 - Init logger
$logger = new Logger('payment');
// Now add some handlers
$logger->pushHandler(new StreamHandler('payment.log', LogLevel::DEBUG));

$paymentClient->setLogger($logger);


// ------------------------------------------------------------------------------------------------
// 3 - Create New payment model

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

/** @var NewPaymentResultInterface $result */
$result = $paymentClient->init($newPayment);

if ($result->isSuccess()) {
    // Do some logic
    print 'PaymentId: ' . $result->getPaymentId() . "\n";
} else {
    // Process error
    print 'Error: ' . $result->getMessage() . "\n";
}
