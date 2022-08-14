<?php

namespace Pada\Tinkoff\Payment\Normalizer;

use Pada\Tinkoff\Payment\Contract\NewPaymentInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class NewPaymentNormalizer implements NormalizerInterface
{
    use SetterTrait;

    public function normalize($object, string $format = null, array $context = []): array
    {
        /** @var NewPaymentInterface $init */
        $init = $object;

        $data = [
            'TerminalKey' => $init->getTerminalKey(),
            'Amount' => $init->getAmount(),
            'OrderId' => $init->getOrderId(),
            'Token' => $init->getToken(),
        ];

        $this->setIfNotNull('FailURL', $init->getFailURL(), $data);
        $this->setIfNotNull('NotificationURL', $init->getNotificationURL(), $data);
        $this->setIfNotNull('SuccessURL', $init->getSuccessURL(), $data);
        $this->setIfNotNull('IP', $init->getIp(), $data);
        $this->setIfNotNull('Description', $init->getDescription(), $data);
        $this->setIfNotNull('Language', $init->getLanguage(), $data);
        $this->setIfNotNull('PayType', $init->getPayType(), $data);
        $this->setIfNotNull('DATA', function () use($init) {
            if (null === $init->getData()) {
                return null;
            }
            return $init->getData()->getAll();
        }, $data);

        return $data;
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof NewPaymentInterface;
    }
}
