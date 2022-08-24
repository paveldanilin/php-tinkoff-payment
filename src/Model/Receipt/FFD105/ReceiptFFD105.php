<?php

namespace Pada\Tinkoff\Payment\Model\Receipt\FFD105;

use Pada\Tinkoff\Payment\Constant;
use Pada\Tinkoff\Payment\Model\Receipt\AbstractReceipt;

final class ReceiptFFD105 extends AbstractReceipt
{
    public function __construct()
    {
        parent::__construct(Constant::FFD_VERSION_1_05);
    }

    public static function getBuilder(): ReceiptBuilderFFD105
    {
        return new ReceiptBuilderFFD105();
    }
}
