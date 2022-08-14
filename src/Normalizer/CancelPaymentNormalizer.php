<?php

namespace Pada\Tinkoff\Payment\Normalizer;

use Pada\Tinkoff\Payment\Contract\CancelInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class CancelPaymentNormalizer implements NormalizerInterface
{
    use SetterTrait;

    public function normalize($object, string $format = null, array $context = []): array
    {
        /** @var CancelInterface $cancelPayment */
        $cancelPayment = $object;

        $data = [
            'TerminalKey' => $cancelPayment->getTerminalKey(),
            'Token' => $cancelPayment->getToken(),
            'PaymentId' => $cancelPayment->getPaymentId(),
        ];

        $this->setIfNotNull('IP', $cancelPayment->getIp(), $data);
        $this->setIfNotNull('Amount', $cancelPayment->getAmount(), $data);

        return $data;
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof CancelInterface;
    }
}
