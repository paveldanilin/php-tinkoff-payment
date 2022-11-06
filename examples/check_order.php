<?php

use Pada\Tinkoff\Payment\PaymentClient;

require 'vendor/autoload.php';

// ------------------------------------------------------------------------------------------------
// 1 - Создание клиента

$paymentClient = PaymentClient::create('<terminal_key>', '<password>');


// ------------------------------------------------------------------------------------------------
// 2 -  Вызываем API

$result = $paymentClient->checkOrder('1234567890');

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
