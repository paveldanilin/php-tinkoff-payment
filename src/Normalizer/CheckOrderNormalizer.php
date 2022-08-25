<?php

namespace Pada\Tinkoff\Payment\Normalizer;

use Pada\Tinkoff\Payment\Contract\CheckOrderInterface;
use Pada\Tinkoff\Payment\Model\CheckOrder\CheckOrderResult;
use Pada\Tinkoff\Payment\Model\CheckOrder\Payment;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class CheckOrderNormalizer implements NormalizerInterface, DenormalizerInterface
{
    // NORMALIZE

    /**
     * @param mixed $object
     * @param string|null $format
     * @param array $context
     * @return array
     */
    public function normalize($object, $format = null, array $context = [])
    {
        /** @var CheckOrderInterface $checkOrder */
        $checkOrder = $object;

        return [
            'TerminalKey' => $checkOrder->getTerminalKey(),
            'Token' => $checkOrder->getToken(),
            'OrderId' => $checkOrder->getOrderId(),
        ];
    }

    /**
     * @param mixed $data
     * @param string|null $format
     * @return bool
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof CheckOrderInterface;
    }

    // DENORMALIZE

    /**
     * @param mixed $data
     * @param string $type
     * @param string|null $format
     * @param array $context
     * @return CheckOrderResult
     */
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $checkOrderResponse = new CheckOrderResult();

        $checkOrderResponse->setOrderId($data['OrderId'] ?? '');
        $checkOrderResponse->setSuccess($data['Success'] ?? false);
        $checkOrderResponse->setErrorCode($data['ErrorCode'] ?? '-999');
        $checkOrderResponse->setMessage($data['Message'] ?? null);
        $checkOrderResponse->setDetails($data['Details'] ?? null);

        $dataPayments = $data['Payments'] ?? [];
        $payments = [];
        foreach ($dataPayments as $dataPayment) {
            $payment = new Payment();
            $payment->setPaymentId($dataPayment['PaymentId'] ?? -1);
            $payment->setAmount($dataPayment['Amount'] ?? null);
            $payment->setStatus($dataPayment['Status'] ?? '');
            $payment->setRRN($dataPayment['RRN'] ?? null);
            $payment->setSuccess($dataPayment['Success'] ?? 'false');
            $payment->setErrorCode($dataPayment['ErrorCode'] ?? '-999');
            $payment->setMessage($dataPayment['Message'] ?? '');
            $payments[] = $payment;
        }
        $checkOrderResponse->setPayments($payments);

        return $checkOrderResponse;
    }

    /**
     * @param mixed $data
     * @param string $type
     * @param string|null $format
     * @return bool
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return CheckOrderResult::class === $type;
    }
}
