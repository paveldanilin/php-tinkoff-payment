<?php

namespace Pada\Tinkoff\Payment\Contract;

use Pada\Tinkoff\Payment\DataKV;

interface NewPaymentInterface extends TerminalKeyAwareInterface, TokenAwareInterface
{
    public function getAmount(): int;
    public function getOrderId(): string;
    public function getPayType(): ?string;
    public function getSuccessURL(): ?string;
    public function getFailURL(): ?string;
    public function getNotificationURL(): ?string;
    public function getIp(): ?string;
    public function getDescription(): ?string;
    public function getLanguage(): ?string;
    public function getData(): ?DataKV;
}
