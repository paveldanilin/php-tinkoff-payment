<?php

namespace Pada\Tinkoff\Payment\Model\Receipt\FFD105;

use Pada\Tinkoff\Payment\Constant;
use Pada\Tinkoff\Payment\Model\Receipt\AbstractReceipt;
use Pada\Tinkoff\Payment\Model\Receipt\ReceiptBuilderInterface;

final class ReceiptBuilderFFD105 implements ReceiptBuilderInterface
{
    private ?string $phone = null;
    private ?string $email = null;
    private ?string $taxation = null;
    private array $items = [];


    public function phone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function email(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function taxation(?string $taxation): self
    {
        $this->taxation = $taxation;
        return $this;
    }

    public function taxationOSN(): self
    {
        $this->taxation = Constant::TAXATION_OSN;
        return $this;
    }

    public function taxationENVD(): self
    {
        $this->taxation = Constant::TAXATION_ENVD;
        return $this;
    }

    public function taxationESN(): self
    {
        $this->taxation = Constant::TAXATION_ESN;
        return $this;
    }

    public function taxationPatent(): self
    {
        $this->taxation = Constant::TAXATION_PATENT;
        return $this;
    }

    public function taxationUSNIncome(): self
    {
        $this->taxation = Constant::TAXATION_USN_INCOME;
        return $this;
    }

    public function taxationUSNIncomeOutcome(): self
    {
        $this->taxation = Constant::TAXATION_USN_INCOME_OUTCOME;
        return $this;
    }

    public function addItem(ItemFFD105 $itemFFD105): self
    {
        $this->items[] = $itemFFD105;
        return $this;
    }

    public function items(iterable $items): self
    {
        $this->items = [];
        foreach ($items as $item) {
            $this->addItem($item);
        }
        return $this;
    }

    public function build(): AbstractReceipt
    {
        if (empty($this->phone) && empty($this->email)) {
            throw new \BadMethodCallException('phone and email are not defined');
        }

        if (empty($this->taxation)) {
            throw new \BadMethodCallException('taxation not defined');
        }

        $receipt = new ReceiptFFD105();
        $receipt->setEmail($this->email);
        $receipt->setPhone($this->phone);
        $receipt->setTaxation($this->taxation);
        $receipt->setItems($this->items);

        $this->clean();

        return $receipt;
    }

    private function clean(): void
    {
        $this->phone = null;
        $this->email = null;
        $this->taxation = null;
        $this->items = [];
    }
}
