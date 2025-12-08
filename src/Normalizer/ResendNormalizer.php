<?php

namespace Pada\Tinkoff\Payment\Normalizer;

use Pada\Tinkoff\Payment\Model\Resend\Resend;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class ResendNormalizer implements NormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function normalize(mixed $object, ?string $format = null, array $context = [])
    {
        /** @var Resend $resend */
        $resend = $object;
        return [
            'TerminalKey' => $resend->getTerminalKey(),
            'Token' => $resend->getToken(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof Resend;
    }
}
