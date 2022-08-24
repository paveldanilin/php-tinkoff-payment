<?php

namespace Pada\Tinkoff\Payment\Model\Receipt;

interface ItemBuilderInterface
{
    public function build(): AbstractItem;
}
