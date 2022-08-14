<?php

namespace Pada\Tinkoff\Payment\Normalizer;

use Pada\Tinkoff\Payment\Model\Resend\Resend;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class ResendNormalizer implements NormalizerInterface
{
    public function normalize($object, string $format = null, array $context = []): array
    {
        /** @var Resend $resend */
        $resend = $object;
        return [
            'TerminalKey' => $resend->getTerminalKey(),
            'Token' => $resend->getToken(),
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof Resend;
    }
}
