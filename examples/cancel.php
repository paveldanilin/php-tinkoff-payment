<?php

use Pada\Tinkoff\Payment\Configuration;
use Pada\Tinkoff\Payment\PaymentClient;
use Pada\Tinkoff\Payment\PaymentClientInterface;
use Pada\Tinkoff\Payment\Contract\CancelResultInterface;

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

/** @var CancelResultInterface $result */
$result = $paymentClient->cancel(1234567890);

if ($result->isSuccess()) {
    print 'PaymentId: ' . $result->getPaymentId() . ' [' . $result->getStatus() . "]\n";
} else {
    print 'Error: ' . $result->getMessage() . "\n";
}
