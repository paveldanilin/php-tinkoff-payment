<?php

use Pada\Tinkoff\Payment\PaymentClient;

require 'vendor/autoload.php';

// ------------------------------------------------------------------------------------------------
// 1 - Создание клиента

$paymentClient = PaymentClient::create('<terminal_key>', '<password>');


// ------------------------------------------------------------------------------------------------
// 2 - Вызываем API

$result = $paymentClient->cancel(1234567890);

if ($result->isSuccess()) {
    print 'PaymentId: ' . $result->getPaymentId() . ' [' . $result->getStatus() . "]\n";
} else {
    print 'Error: ' . $result->getMessage() . "\n";
}
