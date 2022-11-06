<?php

namespace Pada\Tinkoff\Payment;

use Pada\Tinkoff\Payment\Contract\CancelResultInterface;
use Pada\Tinkoff\Payment\Contract\CheckOrderResultInterface;
use Pada\Tinkoff\Payment\Contract\GetStateResultInterface;
use Pada\Tinkoff\Payment\Contract\NewPaymentInterface;
use Pada\Tinkoff\Payment\Contract\NewPaymentResultInterface;
use Pada\Tinkoff\Payment\Contract\ReceiptInterface;
use Pada\Tinkoff\Payment\Contract\ResendResultInterface;
use Pada\Tinkoff\Payment\Exception\ResponseDecodeException;

interface PaymentClientInterface
{
    /**
     * @param NewPaymentInterface $newPayment
     * @throws ResponseDecodeException
     * @return NewPaymentResultInterface
     */
    public function init(NewPaymentInterface $newPayment): NewPaymentResultInterface;

    /**
     * @param int $paymentId
     * @param int|null $amount
     * @param string|null $ip
     * @throws ResponseDecodeException
     * @return CancelResultInterface
     */
    public function cancel(int $paymentId, ?int $amount = null, ?string $ip = null): CancelResultInterface;

    /**
     * @param int $paymentId
     * @param ReceiptInterface $receipt
     * @param string|null $ip
     * @throws ResponseDecodeException
     * @return CancelResultInterface
     */
    public function cancelWithReceipt(int $paymentId, ReceiptInterface $receipt, ?string $ip = null): CancelResultInterface;

    /**
     * @param int $paymentId
     * @param string|null $ip
     * @throws ResponseDecodeException
     * @return GetStateResultInterface
     */
    public function getState(int $paymentId, ?string $ip = null): GetStateResultInterface;

    /**
     * @param string $orderId
     * @throws ResponseDecodeException
     * @return CheckOrderResultInterface
     */
    public function checkOrder(string $orderId): CheckOrderResultInterface;

    /**
     * @throws ResponseDecodeException
     * @return ResendResultInterface
     */
    public function resendNotifications(): ResendResultInterface;
}
