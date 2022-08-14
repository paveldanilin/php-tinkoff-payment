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
// 2 - Init logger
$logger = new \Monolog\Logger('payment');
// Now add some handlers
$logger->pushHandler(new \Monolog\Handler\StreamHandler('payment.log', \Psr\Log\LogLevel::DEBUG));

$paymentClient->setLogger($logger);


// ------------------------------------------------------------------------------------------------
// 3 - Create New payment model

$newPayment = new \Pada\Tinkoff\Payment\Model\Init\NewPayment();
$newPayment->setAmount(105);
$newPayment->setOrderId('333335556669');
$newPayment->setPayType(\Pada\Tinkoff\Payment\Constant::PAY_TYPE_ONE_STEP);


// ------------------------------------------------------------------------------------------------
// 4 - Invoke API and process response

/** @var \Pada\Tinkoff\Payment\Contract\NewPaymentResultInterface $result */
$result = $paymentClient->init($newPayment);

if ($result->isSuccess()) {
    // Do some logic
    print 'PaymentId: ' . $result->getPaymentId() . "\n";
} else {
    // Process error
    print 'Error: ' . $result->getMessage() . "\n";
}
