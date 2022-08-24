<?php

namespace Pada\Tinkoff\Payment\Normalizer;

use DateTimeInterface;
use Pada\Tinkoff\Payment\Contract\NewPaymentInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class NewPaymentNormalizer implements NormalizerInterface
{
    use SetterTrait;
    use ReceiptNormalizerTrait;

    public function normalize($object, string $format = null, array $context = []): array
    {
        /** @var NewPaymentInterface $initPayment */
        $initPayment = $object;

        $data = [
            'TerminalKey' => $initPayment->getTerminalKey(),
            'Amount' => $initPayment->getAmount(),
            'OrderId' => $initPayment->getOrderId(),
            'Token' => $initPayment->getToken(),
        ];

        $this->setIfNotNull('FailURL', $initPayment->getFailURL(), $data);
        $this->setIfNotNull('NotificationURL', $initPayment->getNotificationURL(), $data);
        $this->setIfNotNull('SuccessURL', $initPayment->getSuccessURL(), $data);
        $this->setIfNotNull('IP', $initPayment->getIp(), $data);
        $this->setIfNotNull('Description', $initPayment->getDescription(), $data);
        $this->setIfNotNull('Language', $initPayment->getLanguage(), $data);
        $this->setIfNotNull('PayType', $initPayment->getPayType(), $data);

        if ($initPayment->isRecurrent()) {
            $this->setIfNotNull('Recurrent', 'Y', $data);
            $this->setIfNotNull('CustomerKey', $initPayment->getCustomerKey(), $data);
        }

        $this->setIfNotNull('RedirectDueDate', function () use($initPayment) {
            if (null === $initPayment->getRedirectDueDate()) {
                return null;
            }
            return $initPayment->getRedirectDueDate()->format(DateTimeInterface::ATOM);
        }, $data);

        $this->setIfNotNull('Receipt', function () use($initPayment) {
            if (null === $initPayment->getReceipt()) {
                return null;
            }
            return $this->normalizeReceipt($initPayment->getReceipt());
        }, $data);

        $this->setIfNotNull('DATA', function () use($initPayment) {
            if (null === $initPayment->getData()) {
                return null;
            }
            return $initPayment->getData()->getAll();
        }, $data);

        return $data;
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof NewPaymentInterface;
    }
}
