<?php

namespace Pada\Tinkoff\Payment\Normalizer;

use Pada\Tinkoff\Payment\Contract\CancelInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class CancelPaymentNormalizer implements NormalizerInterface
{
    use SetterTrait;
    use ReceiptNormalizerTrait;

    /**
     * @param mixed $object
     * @param string|null $format
     * @param array $context
     * @return array
     */
    public function normalize($object, $format = null, array $context = [])
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
        $this->setIfNotNull('Receipt', function () use($cancelPayment) {
            if (null === $cancelPayment->getReceipt()) {
                return null;
            }
            return $this->normalizeReceipt($cancelPayment->getReceipt());
        }, $data);

        return $data;
    }

    /**
     * @param mixed $data
     * @param string|null $format
     * @return bool
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof CancelInterface;
    }
}
