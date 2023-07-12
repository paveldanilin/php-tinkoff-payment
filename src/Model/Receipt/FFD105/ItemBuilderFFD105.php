<?php

namespace Pada\Tinkoff\Payment\Model\Receipt\FFD105;

use Pada\Tinkoff\Payment\Constant;
use Pada\Tinkoff\Payment\Model\Receipt\AbstractItem;
use Pada\Tinkoff\Payment\Model\Receipt\ItemBuilderInterface;

/**
 * @see https://www.tinkoff.ru/kassa/develop/api/receipt/#Items
 */
final class ItemBuilderFFD105 implements ItemBuilderInterface
{
    private string $name = '';
    private int $price = 0;
    private int $quantity = 0;
    private string $tax = '';
    private ?string $paymentObject = null;
    private ?string $paymentMethod = null;


    public function name(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function price(int $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function quantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function tax(string $tax): self
    {
        $this->tax = $tax;
        return $this;
    }

    /**
     * none — без НДС
     * @return $this
     */
    public function taxNone(): self
    {
        return $this->tax(Constant::TAX_NONE);
    }

    /**
     * vat0 — 0%
     * @return $this
     */
    public function taxVat0(): self
    {
        return $this->tax(Constant::TAX_VAT0);
    }

    /**
     * vat10 — 10%
     * @return $this
     */
    public function taxVat10(): self
    {
        return $this->tax(Constant::TAX_VAT10);
    }

    /**
     * vat20 — 20%
     * @return $this
     */
    public function taxVat20(): self
    {
        return $this->tax(Constant::TAX_VAT20);
    }

    /**
     * vat110 — 10/110
     * @return $this
     */
    public function taxVat110(): self
    {
        return $this->tax(Constant::TAX_VAT110);
    }

    /**
     * vat120 — 20/120
     * @return $this
     */
    public function taxVat120(): self
    {
        return $this->tax(Constant::TAX_VAT120);
    }

    public function paymentObject(?string $paymentObject): self
    {
        $this->paymentObject = $paymentObject;
        return $this;
    }

    public function paymentMethod(?string $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function build(): AbstractItem
    {
        if (empty($this->tax)) {
            throw new \BadMethodCallException('not defined tax');
        }

        $item = new ItemFFD105($this->name);
        $item->setPaymentObject($this->paymentObject);
        $item->setPaymentMethod($this->paymentMethod);
        $item->setPrice($this->price);
        $item->setTax($this->tax);
        $item->setQuantity((float)$this->quantity);

        $this->clean();

        return $item;
    }

    private function clean(): void
    {
        $this->name = '';
        $this->quantity = 0;
        $this->tax = '';
        $this->price = 0;
        $this->paymentMethod = null;
        $this->paymentObject = null;
    }
}
