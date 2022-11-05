<?php

use Pada\Tinkoff\Payment\Configuration;
use Pada\Tinkoff\Payment\PaymentClient;
use Pada\Tinkoff\Payment\PaymentClientInterface;
use Pada\Tinkoff\Payment\Contract\ResendResultInterface;

require 'vendor/autoload.php';

// ------------------------------------------------------------------------------------------------
// 1 - Создание клиента

$config = new Configuration();
$config->setTerminalKey('<terminal_key>');
$config->setPassword('<password>');

/** @var PaymentClientInterface $paymentClient */
$paymentClient = new PaymentClient($config);


// ------------------------------------------------------------------------------------------------
// 2 - Вызываем API

/** @var ResendResultInterface $result */
$result = $paymentClient->resendNotifications();

if ($result->isSuccess()) {
    print 'Count: ' . $result->getCount() . "\n";
} else {
    print 'Error: ' . $result->getMessage() . "\n";
}
