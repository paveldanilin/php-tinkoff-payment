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

/** @var \Pada\Tinkoff\Payment\Contract\ResendResultInterface $result */
$result = $paymentClient->resendNotifications();

if ($result->isSuccess()) {
    // Do some logic
    print 'Count: ' . $result->getCount() . "\n";
} else {
    // Process error
    print 'Error: ' . $result->getMessage() . "\n";
}
