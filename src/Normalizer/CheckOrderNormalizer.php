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

    public function normalize($object, string $format = null, array $context = []): array
    {
        /** @var CheckOrderInterface $checkOrder */
        $checkOrder = $object;

        return [
            'TerminalKey' => $checkOrder->getTerminalKey(),
            'Token' => $checkOrder->getToken(),
            'OrderId' => $checkOrder->getOrderId(),
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof CheckOrderInterface;
    }

    // DENORMALIZE

    public function denormalize($data, string $type, string $format = null, array $context = []): CheckOrderResult
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

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return CheckOrderResult::class === $type;
    }
}
