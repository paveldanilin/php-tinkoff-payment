<?php

namespace Pada\Tinkoff\Payment\Normalizer;

use Pada\Tinkoff\Payment\Contract\ChargeInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class ChargeNormalizer implements NormalizerInterface
{
    // NORMALIZE

    public function normalize($object, $format = null, array $context = [])
    {
        /** @var ChargeInterface $charge */
        $charge = $object;

        $data = [
            'TerminalKey' => $charge->getTerminalKey(),
            'Token' => $charge->getToken(),
            'PaymentId' => $charge->getPaymentId(),
            'RebillId' => $charge->getRebillId(),
        ];

        if (null !== $charge->getSendEmail()) {
            $data['SendEmail'] = $charge->getSendEmail();
            $data['InfoEmail'] = $charge->getInfoEmail();
        }

        if (null !== $charge->getIp()) {
            $data['Ip'] = $charge->getIp();
        }

        return $data;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof ChargeInterface;
    }
}
