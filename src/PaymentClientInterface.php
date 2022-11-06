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
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/init-description/
     *
     * @param NewPaymentInterface $newPayment
     * @throws ResponseDecodeException
     * @return NewPaymentResultInterface
     */
    public function init(NewPaymentInterface $newPayment): NewPaymentResultInterface;

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/cancel-description/
     *
     * @param int $paymentId
     * @param int|null $amount
     * @param string|null $ip
     * @throws ResponseDecodeException
     * @return CancelResultInterface
     */
    public function cancel(int $paymentId, ?int $amount = null, ?string $ip = null): CancelResultInterface;

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/cancel-description/
     *
     * @param int $paymentId
     * @param ReceiptInterface $receipt
     * @param string|null $ip
     * @throws ResponseDecodeException
     * @return CancelResultInterface
     */
    public function cancelWithReceipt(int $paymentId, ReceiptInterface $receipt, ?string $ip = null): CancelResultInterface;

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/getstate-description/
     *
     * @param int $paymentId
     * @param string|null $ip
     * @throws ResponseDecodeException
     * @return GetStateResultInterface
     */
    public function getState(int $paymentId, ?string $ip = null): GetStateResultInterface;

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/checkorder-description/
     *
     * @param string $orderId
     * @throws ResponseDecodeException
     * @return CheckOrderResultInterface
     */
    public function checkOrder(string $orderId): CheckOrderResultInterface;

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/resend-description/
     *
     * @throws ResponseDecodeException
     * @return ResendResultInterface
     */
    public function resendNotifications(): ResendResultInterface;
}
