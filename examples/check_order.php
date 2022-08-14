<?php

require 'vendor/autoload.php';

// ------------------------------------------------------------------------------------------------
// 1 - Create Payment client

$config = new \Pada\Tinkoff\Payment\Configuration();
$config->setTerminalKey('<terminal_key>');
$config->setPassword('<password>');

/** @var \Pada\Tinkoff\Payment\PaymentClientInterface $paymentClient */
$paymentClient = new \Pada\Tinkoff\Payment\PaymentClient($config);


// ------------------------------------------------------------------------------------------------
// 2 - Invoke API and process response

/** @var \Pada\Tinkoff\Payment\Contract\CheckOrderResultInterface $result */
$result = $paymentClient->checkOrder(333335556669);

if ($result->isSuccess()) {
    // Do some logic
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
    // Process error
    print 'Error: ' . $result->getMessage() . "\n";
}
