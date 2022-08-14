# Tinkoff Payment API client

Клиент для проведения платежей [API Тинькофф Платежи](https://www.tinkoff.ru/kassa/develop/api/payments/).


## Примеры

### Создание клиента

```php
$config = new \Pada\Tinkoff\Payment\Configuration();
$config->setTerminalKey('<terminal_key>');
$config->setPassword('<password>');

/** @var \Pada\Tinkoff\Payment\PaymentClientInterface $paymentClient */
$paymentClient = new \Pada\Tinkoff\Payment\PaymentClient($config);
```

### Создание платежа

[Создает платеж](https://www.tinkoff.ru/kassa/develop/api/payments/init-description/)

```php
$newPayment = new \Pada\Tinkoff\Payment\Model\Init\NewPayment();
$newPayment->setAmount(102);
$newPayment->setOrderId('333335556669');
$newPayment->setPayType(\Pada\Tinkoff\Payment\Constant::PAY_TYPE_ONE_STEP);

/** @var \Pada\Tinkoff\Payment\Contract\NewPaymentResultInterface $result */
$result = $paymentClient->init($newPayment);

if ($result->isSuccess()) {
    // Do some logic
    print 'PaymentId: ' . $result->getPaymentId() . "\n";
} else {
    // Process error
    print 'Error: ' . $result->getMessage() . "\n";
}
```

### Отмена платежа

[Отменяет платеж](https://www.tinkoff.ru/kassa/develop/api/payments/cancel-description/)

```php
/** @var \Pada\Tinkoff\Payment\Contract\CancelResultInterface $result */
$result = $paymentClient->cancel(1645861116);

if ($result->isSuccess()) {
    // Do some logic
    print 'PaymentId: ' . $result->getPaymentId() . ' [' . $result->getStatus() . "]\n";
} else {
    // Process error
    print 'Error: ' . $result->getMessage() . "\n";
}
```

### Получение текущего статуса платежа

[Метод возвращает текущий статус платежа](https://www.tinkoff.ru/kassa/develop/api/payments/getstate-description/)

```php
/** @var \Pada\Tinkoff\Payment\Contract\GetStateResultInterface $result */
$result = $paymentClient->getState(1645861116);

if ($result->isSuccess()) {
    // Do some logic
    print 'PaymentId: ' . $result->getPaymentId() . ' [' . $result->getStatus() . "]\n";
} else {
    // Process error
    print 'Error: ' . $result->getMessage() . "\n";
}
```

### Получение статуса заказа

[Метод возвращает статус заказа](https://www.tinkoff.ru/kassa/develop/api/payments/checkorder-description/)

```php
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
```

### Повторить неуспешные нотификации

[Метод позволяет переотправить неуспешные нотификации в течение 24 часов с момента попадания в архив](https://www.tinkoff.ru/kassa/develop/api/payments/resend-description/)

```php
/** @var \Pada\Tinkoff\Payment\Contract\ResendResultInterface $result */
$result = $paymentClient->resendNotifications();

if ($result->isSuccess()) {
    // Do some logic
    print 'Count: ' . $result->getCount() . "\n";
} else {
    // Process error
    print 'Error: ' . $result->getMessage() . "\n";
}
```
