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

/** @var \Pada\Tinkoff\Payment\Contract\CancelResultInterface $result */
$result = $paymentClient->cancel(1645861116);

if ($result->isSuccess()) {
    // Do some logic
    print 'PaymentId: ' . $result->getPaymentId() . ' [' . $result->getStatus() . "]\n";
} else {
    // Process error
    print 'Error: ' . $result->getMessage() . "\n";
}
