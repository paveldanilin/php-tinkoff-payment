<?php

namespace Pada\Tinkoff\Payment\Normalizer;

use Pada\Tinkoff\Payment\Contract\GetStateInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class GetStateNormalizer implements NormalizerInterface
{
    use SetterTrait;

    /**
     * @param mixed $object
     * @param string|null $format
     * @param array $context
     * @return array
     */
    public function normalize($object, $format = null, array $context = [])
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

    /**
     * @param mixed $data
     * @param string|null $format
     * @return bool
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof GetStateInterface;
    }
}
