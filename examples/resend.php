<?php

use Pada\Tinkoff\Payment\Configuration;
use Pada\Tinkoff\Payment\PaymentClient;
use Pada\Tinkoff\Payment\PaymentClientInterface;
use Pada\Tinkoff\Payment\Contract\ResendResultInterface;

require 'vendor/autoload.php';

// ------------------------------------------------------------------------------------------------
// 1 - Create Payment client

$config = new Configuration();
$config->setTerminalKey('<terminal_key>');
$config->setPassword('<password>');

/** @var PaymentClientInterface $paymentClient */
$paymentClient = new PaymentClient($config);


// ------------------------------------------------------------------------------------------------
// 2 - Invoke API and process response

/** @var ResendResultInterface $result */
$result = $paymentClient->resendNotifications();

if ($result->isSuccess()) {
    // Do some logic
    print 'Count: ' . $result->getCount() . "\n";
} else {
    // Process error
    print 'Error: ' . $result->getMessage() . "\n";
}
