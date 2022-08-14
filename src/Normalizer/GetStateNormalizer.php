<?php

namespace Pada\Tinkoff\Payment\Normalizer;

use Pada\Tinkoff\Payment\Contract\GetStateInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class GetStateNormalizer implements NormalizerInterface
{
    use SetterTrait;

    public function normalize($object, string $format = null, array $context = []): array
    {
        /** @var GetStateInterface $state */
        $state = $object;

        $data = [
            'TerminalKey' => $state->getTerminalKey(),
            'Token' => $state->getToken(),
            'PaymentId' => $state->getPaymentId(),
        ];

        $this->setIfNotNull('IP', $state->getIp(), $data);

        return $data;
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof GetStateInterface;
    }
}
