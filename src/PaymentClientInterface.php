<?php

namespace Pada\Tinkoff\Payment;

use Pada\Tinkoff\Payment\Contract\CancelResultInterface;
use Pada\Tinkoff\Payment\Contract\ChargeInterface;
use Pada\Tinkoff\Payment\Contract\ChargeResultInterface;
use Pada\Tinkoff\Payment\Contract\CheckOrderResultInterface;
use Pada\Tinkoff\Payment\Contract\ConfirmResultInterface;
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

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/confirm-description/
     *
     * Метод подтверждает платеж и списывает ранее заблокированные средства.
     * Используется при двухстадийной оплате. При одностадийной оплате вызывается автоматически.
     * Применим к платежу только в статусе AUTHORIZED и только один раз.
     * Сумма подтверждения не может быть больше заблокированной.
     * Если сумма подтверждения меньше заблокированной, будет выполнено частичное подтверждение.
     *
     * @param int $paymentId
     * @param int|null $amount
     * @param string|null $ip
     * @return ConfirmResultInterface
     */
    public function confirm(int $paymentId, ?int $amount = null, ?string $ip = null): ConfirmResultInterface;

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/confirm-description/
     *
     * @param int $paymentId
     * @param ReceiptInterface $receipt
     * @param int|null $amount
     * @param string|null $ip
     * @return ConfirmResultInterface
     */
    public function confirmWithReceipt(int $paymentId, ReceiptInterface $receipt, ?int $amount = null, ?string $ip = null): ConfirmResultInterface;

    // TODO: разделить интерфейсы payment/autopayment

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/autopayments/charge-description/
     *
     * Метод осуществляет автоплатеж.
     * Всегда работает по типу одностадийной оплаты:
     * во время выполнения метода на Notification URL будет отправлен синхронный запрос,
     * на который требуется корректный ответ.
     *
     * 1. Вызовите метод Init со стандартным набором параметров (параметр Recurrent передавать не нужно)
     * 2. Получите в ответ на Init параметр PaymentID
     * 3. Вызовите метод Charge с параметрами RebillID и PaymentID
     *
     * @param ChargeInterface $charge
     * @throws ResponseDecodeException
     * @return ChargeResultInterface
     */
    public function charge(ChargeInterface $charge): ChargeResultInterface;
}
