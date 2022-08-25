<?php

namespace Pada\Tinkoff\Payment\Normalizer;

use Pada\Tinkoff\Payment\Model\Resend\Resend;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class ResendNormalizer implements NormalizerInterface
{
    /**
     * @param mixed $object
     * @param string|null $format
     * @param array $context
     * @return array
     */
    public function normalize($object, $format = null, array $context = [])
    {
        /** @var Resend $resend */
        $resend = $object;
        return [
            'TerminalKey' => $resend->getTerminalKey(),
            'Token' => $resend->getToken(),
        ];
    }

    /**
     * @param mixed $data
     * @param string|null $format
     * @return bool
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Resend;
    }
}
