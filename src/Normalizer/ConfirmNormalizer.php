<?php

namespace Pada\Tinkoff\Payment\Normalizer;

use Pada\Tinkoff\Payment\Contract\ConfirmInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class ConfirmNormalizer implements NormalizerInterface
{
    use SetterTrait;
    use ReceiptNormalizerTrait;

    public function normalize($object, $format = null, array $context = [])
    {
        /** @var ConfirmInterface $confirm */
        $confirm = $object;

        $data = [
            'TerminalKey' => $confirm->getTerminalKey(),
            'Token' => $confirm->getToken(),
            'PaymentId' => $confirm->getPaymentId(),
        ];

        $this->setIfNotNull('IP', $confirm->getIp(), $data);
        $this->setIfNotNull('Amount', $confirm->getAmount(), $data);
        $this->setIfNotNull('Receipt', function () use($confirm) {
            if (null === $confirm->getReceipt()) {
                return null;
            }
            return $this->normalizeReceipt($confirm->getReceipt());
        }, $data);

        return $data;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof ConfirmInterface;
    }
}
