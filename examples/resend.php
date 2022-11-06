<?php

use Pada\Tinkoff\Payment\PaymentClient;

require 'vendor/autoload.php';

// ------------------------------------------------------------------------------------------------
// 1 - Создание клиента

$paymentClient = PaymentClient::create('<terminal_key>', '<password>');


// ------------------------------------------------------------------------------------------------
// 2 - Вызываем API

$result = $paymentClient->resendNotifications();

if ($result->isSuccess()) {
    print 'Count: ' . $result->getCount() . "\n";
} else {
    print 'Error: ' . $result->getMessage() . "\n";
}
