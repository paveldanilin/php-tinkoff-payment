<?php

namespace Pada\Tinkoff\Payment;

use Pada\Tinkoff\Payment\Contract\CancelResultInterface;
use Pada\Tinkoff\Payment\Contract\CheckOrderResultInterface;
use Pada\Tinkoff\Payment\Contract\GetStateResultInterface;
use Pada\Tinkoff\Payment\Contract\NewPaymentInterface;
use Pada\Tinkoff\Payment\Contract\NewPaymentResultInterface;
use Pada\Tinkoff\Payment\Contract\ResendResultInterface;
use Pada\Tinkoff\Payment\Interceptor\TerminalKeyInterceptor;
use Pada\Tinkoff\Payment\Interceptor\TokenInterceptor;
use Pada\Tinkoff\Payment\Model\Cancel\CancelResult;
use Pada\Tinkoff\Payment\Model\CheckOrder\CheckOrderResult;
use Pada\Tinkoff\Payment\Model\GetState\GetStateResult;
use Pada\Tinkoff\Payment\Model\Init\NewPaymentResult;
use Pada\Tinkoff\Payment\Model\Resend\Resend;
use Pada\Tinkoff\Payment\Model\Resend\ResendResult;
use Pada\Tinkoff\Payment\Normalizer\CancelPaymentNormalizer;
use Pada\Tinkoff\Payment\Normalizer\CheckOrderNormalizer;
use Pada\Tinkoff\Payment\Normalizer\NewPaymentNormalizer;
use Pada\Tinkoff\Payment\Normalizer\GetStateNormalizer;
use Pada\Tinkoff\Payment\Normalizer\ResendNormalizer;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use RestClient\DefaultJsonRestClient;
use RestClient\Interceptor\LogRequestInterceptor;

class PaymentClient extends DefaultJsonRestClient implements PaymentClientInterface
{
    public function __construct(Configuration $configuration)
    {
        parent::__construct($configuration, [], $this->getNormalizer());
        $this->setInterceptors($this->getClientInterceptors());
    }

    public function setLogger(LoggerInterface $logger): void
    {
        $interceptors = $this->getClientInterceptors();
        if (!($logger instanceof NullLogger)) {
            $interceptors[] = new LogRequestInterceptor($logger);
        }
        $this->setInterceptors($interceptors);
    }

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/init-description/
     *
     * @param NewPaymentInterface $newPayment
     * @return NewPaymentResultInterface
     */
    public function init(NewPaymentInterface $newPayment): NewPaymentResultInterface
    {
        /** @var NewPaymentResult|null $result */
        $result = $this->postForObject('/v2/Init', NewPaymentResult::class, $newPayment);
        return $result;
    }

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/cancel-description/
     *
     * TODO: add Receipt
     *
     * @param int $paymentId
     * @param int|null $amount
     * @param string|null $ip
     * @return CancelResultInterface
     */
    public function cancel(int $paymentId, ?int $amount = null, ?string $ip = null): CancelResultInterface
    {
        $cancel = new Model\Cancel\CancelPayment();
        $cancel->setPaymentId($paymentId);
        $cancel->setAmount($amount);
        $cancel->setIp($ip);

        /** @var CancelResult|null $result */
        $result = $this->postForObject('/v2/Cancel', CancelResult::class, $cancel);
        return $result;
    }

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/getstate-description/
     *
     * @param int $paymentId
     * @param string|null $ip
     * @return GetStateResultInterface
     */
    public function getState(int $paymentId, ?string $ip = null): GetStateResultInterface
    {
        $getState = new Model\GetState\GetState();
        $getState->setPaymentId($paymentId);
        $getState->setIp($ip);

        /** @var GetStateResult|null $result */
        $result = $this->postForObject('/v2/GetState', GetStateResult::class, $getState);
        return $result;
    }

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/checkorder-description/
     *
     * @param int $orderId
     * @return CheckOrderResultInterface
     */
    public function checkOrder(int $orderId): CheckOrderResultInterface
    {
        $checkOrder = new Model\CheckOrder\CheckOrder();
        $checkOrder->setOrderId($orderId);

        /** @var CheckOrderResult|null $result */
        $result = $this->postForObject('/v2/CheckOrder', CheckOrderResult::class, $checkOrder);
        return $result;
    }

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/payments/resend-description/
     *
     * @return ResendResultInterface
     */
    public function resendNotifications(): ResendResultInterface
    {
        /** @var ResendResult|null $result */
        $result = $this->postForObject('/v2/Resend', ResendResult::class, new Resend());
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
        ];
    }
}
