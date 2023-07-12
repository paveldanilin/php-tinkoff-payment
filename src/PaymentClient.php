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
use Pada\Tinkoff\Payment\Interceptor\TerminalKeyInterceptor;
use Pada\Tinkoff\Payment\Interceptor\TokenInterceptor;
use Pada\Tinkoff\Payment\Model\Cancel\CancelResult;
use Pada\Tinkoff\Payment\Model\Charge\ChargeResult;
use Pada\Tinkoff\Payment\Model\CheckOrder\CheckOrderResult;
use Pada\Tinkoff\Payment\Model\Confirm\ConfirmResult;
use Pada\Tinkoff\Payment\Model\GetState\GetStateResult;
use Pada\Tinkoff\Payment\Model\Init\NewPaymentResult;
use Pada\Tinkoff\Payment\Model\Resend\Resend;
use Pada\Tinkoff\Payment\Model\Resend\ResendResult;
use Pada\Tinkoff\Payment\Normalizer\CancelPaymentNormalizer;
use Pada\Tinkoff\Payment\Normalizer\ChargeNormalizer;
use Pada\Tinkoff\Payment\Normalizer\CheckOrderNormalizer;
use Pada\Tinkoff\Payment\Normalizer\ConfirmNormalizer;
use Pada\Tinkoff\Payment\Normalizer\NewPaymentNormalizer;
use Pada\Tinkoff\Payment\Normalizer\GetStateNormalizer;
use Pada\Tinkoff\Payment\Normalizer\ResendNormalizer;
use RestClient\DefaultJsonRestClient;


class PaymentClient extends DefaultJsonRestClient implements PaymentClientInterface
{
    public function __construct(Configuration $configuration)
    {
        parent::__construct($configuration, [], $this->getNormalizer());
        $this->setInterceptors($this->getClientInterceptors());
    }

    public static function create(string $terminalKey, string $password, string $baseUri = Constant::PAY_BASE_URI): PaymentClientInterface
    {
        $config = new Configuration();
        $config->setTerminalKey($terminalKey);
        $config->setPassword($password);
        $config->setBaseUri($baseUri);
        return new self($config);
    }

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/init-description/
     *
     * @param NewPaymentInterface $newPayment
     * @throws ResponseDecodeException
     * @return NewPaymentResultInterface
     */
    public function init(NewPaymentInterface $newPayment): NewPaymentResultInterface
    {
        /** @var NewPaymentResult|null $result */
        $result = $this->postForObject('/v2/Init', NewPaymentResult::class, $newPayment);
        if (null === $result) {
            throw new ResponseDecodeException();
        }
        return $result;
    }

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/cancel-description/
     *
     * @param int $paymentId
     * @param int|null $amount
     * @param string|null $ip
     * @throws ResponseDecodeException
     * @return CancelResultInterface
     */
    public function cancel(int $paymentId, ?int $amount = null, ?string $ip = null): CancelResultInterface
    {
        $cancelPayment = new Model\Cancel\CancelPayment();
        $cancelPayment->setPaymentId($paymentId);
        $cancelPayment->setAmount($amount);
        $cancelPayment->setIp($ip);

        /** @var CancelResult|null $result */
        $result = $this->postForObject('/v2/Cancel', CancelResult::class, $cancelPayment);
        if (null === $result) {
            throw new ResponseDecodeException();
        }
        return $result;
    }

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/cancel-description/
     *
     * @param int $paymentId
     * @param ReceiptInterface $receipt
     * @param string|null $ip
     * @throws ResponseDecodeException
     * @return CancelResultInterface
     */
    public function cancelWithReceipt(int $paymentId, ReceiptInterface $receipt, ?string $ip = null): CancelResultInterface
    {
        $cancelPayment = new Model\Cancel\CancelPayment();
        $cancelPayment->setPaymentId($paymentId);
        $cancelPayment->setReceipt($receipt);
        $cancelPayment->setIp($ip);

        /** @var CancelResult|null $result */
        $result = $this->postForObject('/v2/Cancel', CancelResult::class, $cancelPayment);
        if (null === $result) {
            throw new ResponseDecodeException();
        }
        return $result;
    }

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/getstate-description/
     *
     * @param int $paymentId
     * @param string|null $ip
     * @throws ResponseDecodeException
     * @return GetStateResultInterface
     */
    public function getState(int $paymentId, ?string $ip = null): GetStateResultInterface
    {
        $getState = new Model\GetState\GetState();
        $getState->setPaymentId($paymentId);
        $getState->setIp($ip);

        /** @var GetStateResult|null $result */
        $result = $this->postForObject('/v2/GetState', GetStateResult::class, $getState);
        if (null === $result) {
            throw new ResponseDecodeException();
        }
        return $result;
    }

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/checkorder-description/
     *
     * @param string $orderId
     * @throws ResponseDecodeException
     * @return CheckOrderResultInterface
     */
    public function checkOrder(string $orderId): CheckOrderResultInterface
    {
        $checkOrder = new Model\CheckOrder\CheckOrder();
        $checkOrder->setOrderId($orderId);

        /** @var CheckOrderResult|null $result */
        $result = $this->postForObject('/v2/CheckOrder', CheckOrderResult::class, $checkOrder);
        if (null === $result) {
            throw new ResponseDecodeException();
        }
        return $result;
    }

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/resend-description/
     *
     * @throws ResponseDecodeException
     * @return ResendResultInterface
     */
    public function resendNotifications(): ResendResultInterface
    {
        /** @var ResendResult|null $result */
        $result = $this->postForObject('/v2/Resend', ResendResult::class, new Resend());
        if (null === $result) {
            throw new ResponseDecodeException();
        }
        return $result;
    }

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/confirm-description/
     *
     * @param int $paymentId
     * @param int|null $amount
     * @param string|null $ip
     * @return ConfirmResultInterface
     */
    public function confirm(int $paymentId, ?int $amount = null, ?string $ip = null): ConfirmResultInterface
    {
        $confirm = new Model\Confirm\Confirm();
        $confirm->setPaymentId($paymentId);
        $confirm->setAmount($amount);
        $confirm->setIp($ip);

        /** @var ConfirmResult|null $result */
        $result = $this->postForObject('/v2/Confirm', ConfirmResult::class, $confirm);
        if (null === $result) {
            throw new ResponseDecodeException();
        }
        return $result;
    }

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/confirm-description/
     *
     * @param int $paymentId
     * @param ReceiptInterface $receipt
     * @param int|null $amount
     * @param string|null $ip
     *
     * @return ConfirmResultInterface
     */
    public function confirmWithReceipt(int $paymentId, ReceiptInterface $receipt, ?int $amount = null, ?string $ip = null): ConfirmResultInterface
    {
        $confirm = new Model\Confirm\Confirm();
        $confirm->setPaymentId($paymentId);
        $confirm->setAmount($amount);
        $confirm->setIp($ip);
        $confirm->setReceipt($receipt);

        /** @var ConfirmResult|null $result */
        $result = $this->postForObject('/v2/Confirm', ConfirmResult::class, $confirm);
        if (null === $result) {
            throw new ResponseDecodeException();
        }
        return $result;
    }

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/autopayments/charge-description/
     *
     * @param ChargeInterface $charge
     * @return ChargeResultInterface
     */
    public function charge(ChargeInterface $charge): ChargeResultInterface
    {
        /** @var ChargeResultInterface|null $result */
        $result = $this->postForObject('/v2/Charge', ChargeResult::class, $charge);
        if (null === $result) {
            throw new ResponseDecodeException();
        }
        return $result;
    }

    private function getClientInterceptors(): array
    {
        /** @var Configuration $config */
        $config = $this->getConfiguration();
        return [
            new TerminalKeyInterceptor($config->getTerminalKey()),
            new TokenInterceptor($config->getPassword()),
        ];
    }

    private function getNormalizer(): array
    {
        return [
            new NewPaymentNormalizer(),
            new CancelPaymentNormalizer(),
            new GetStateNormalizer(),
            new CheckOrderNormalizer(),
            new ResendNormalizer(),
            new ConfirmNormalizer(),
            new ChargeNormalizer(),
        ];
    }
}
