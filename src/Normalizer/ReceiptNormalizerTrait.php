<?php

namespace Pada\Tinkoff\Payment\Normalizer;

use Pada\Tinkoff\Payment\Contract\ReceiptInterface;
use Pada\Tinkoff\Payment\Model\Receipt\FFD105\ReceiptFFD105;

trait ReceiptNormalizerTrait
{
    use SetterTrait;

    protected function normalizeReceipt(ReceiptInterface $receipt): array
    {
        if ($receipt instanceof ReceiptFFD105) {
            return $this->normalizeReceiptFFD105($receipt);
        }
        return [];
    }

    private function normalizeReceiptFFD105(ReceiptFFD105 $receipt): array
    {
        $data = [];
        $this->setIfNotNull('FfdVersion', $receipt->getFfdVersion(), $data);
        $this->setIfNotNull('Email', $receipt->getEmail(), $data);
        $this->setIfNotNull('Phone', $receipt->getPhone(), $data);
        $this->setIfNotNull('Taxation', $receipt->getTaxation(), $data);
        $data['Items'] = [];
        foreach ($receipt->getItems() as $item) {
            $itemData = [
                'Name' => $item->getName(),
                'Amount' => $item->getAmount(),
                'Price' => $item->getPrice(),
                'Quantity' => $item->getQuantity(),
                'Tax' => $item->getTax(),
            ];

            $this->setIfNotNull('PaymentMethod', $item->getPaymentMethod(), $itemData);
            $this->setIfNotNull('PaymentObject', $item->getPaymentObject(), $itemData);
            $this->setIfNotNull('Ean13', $item->getEan13(), $itemData);

            $data['Items'][] = $itemData;
        }
        return $data;
    }
}
