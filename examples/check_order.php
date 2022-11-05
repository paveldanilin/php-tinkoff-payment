<?php

use Pada\Tinkoff\Payment\Configuration;
use Pada\Tinkoff\Payment\PaymentClient;
use Pada\Tinkoff\Payment\PaymentClientInterface;
use Pada\Tinkoff\Payment\Contract\CheckOrderResultInterface;

require 'vendor/autoload.php';

// ------------------------------------------------------------------------------------------------
// 1 - Создание клиента

$config = new Configuration();
$config->setTerminalKey('<terminal_key>');
$config->setPassword('<password>');

/** @var PaymentClientInterface $paymentClient */
$paymentClient = new PaymentClient($config);


// ------------------------------------------------------------------------------------------------
// 2 -  Вызываем API

/** @var CheckOrderResultInterface $result */
$result = $paymentClient->checkOrder(1234567890);

if ($result->isSuccess()) {
    print 'OrderID: ' . $result->getOrderId() . "\n";
    print '-----' . "\n";
    foreach ($result->getPayments() as $payment) {
        print 'PaymentID: ' . $payment->getPaymentId() . "\n";
        print 'Status: ' . $payment->getStatus() . "\n";
        print 'Success: ' . $payment->getSuccess() . "\n";
        print 'RRN: ' . $payment->getRRN() . "\n";
        print '=====' . "\n";
    }
} else {
    print 'Error: ' . $result->getMessage() . "\n";
}
