<?php

namespace Pada\Tinkoff\Payment\Functions;

use Pada\Tinkoff\Payment\Model\Charge\Charge;
use Pada\Tinkoff\Payment\Model\Init\PaymentBuilder;
use Pada\Tinkoff\Payment\Model\Receipt\FFD105\ItemBuilderFFD105;
use Pada\Tinkoff\Payment\Model\Receipt\FFD105\ReceiptBuilderFFD105;

function newPayment(): PaymentBuilder
{
    return new PaymentBuilder();
}

/**
 * ФФД 1.05
 * @return ReceiptBuilderFFD105
 */
function newReceipt(): ReceiptBuilderFFD105
{
    return new ReceiptBuilderFFD105();
}

/**
 * ФФД 1.05
 * @return ItemBuilderFFD105
 */
function newReceiptItem(): ItemBuilderFFD105
{
    return new ItemBuilderFFD105();
}

function newCharge(int $paymentId, int $rebillId): Charge {
    $chargeModel = new Charge();
    $chargeModel->setPaymentId($paymentId);
    $chargeModel->setRebillId($rebillId);
    return $chargeModel;
}
