<?php

namespace Pada\Tinkoff\Payment\Model\Receipt;

use Pada\Tinkoff\Payment\Constant;
use Pada\Tinkoff\Payment\Model\Receipt\FFD105\ItemBuilderFFD105;

abstract class AbstractItem
{
    /**
     * Наименование товара
     * Обязательный
     * Length: 128
     *
     * @var string
     */
    private string $name;

    /**
     * Количество или вес товара
     * Обязательный
     * Для FFD12 может быть числом с точкой
     *
     * @var float
     */
    private float $quantity = 0;

    /**
     * Цена за единицу товара в копейках
     * Обязательный
     *
     * @var int
     */
    private int $price = 0;

    /**
     * Constant::PAYMENT_METHOD_XXX
     * Признак способа расчета
     * Если не передан, в кассу отправляется значение full_payment
     *
     * @var string|null
     */
    private ?string $paymentMethod = null;

    /**
     * Constant::PAYMENT_OBJECT_XXX
     * Признак предмета расчета
     * Если не передан, в кассу отправляется значение commodity
     *
     * @var string|null
     */
    private ?string $paymentObject = null;

    /**
     * Constant::TAX_XXX
     * Ставка НДС
     * Обязательный
     *
     * @var string
     */
    private string $tax = '';

    /**
     * Штрих-код в требуемом формате. В зависимости от типа кассы требования могут отличаться
     * Необязательный
     * Length: 20
     *
     * @var string|null
     */
    private ?string $ean13 = null;


    public function __construct(string $name)
    {
        $this->setName($name);
    }

    public static function getBuilderFFD105(): ItemBuilderFFD105
    {
        return new ItemBuilderFFD105();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $len = \strlen($name);
        if ($len > 128) {
            throw new \InvalidArgumentException('Name too long, max length 128 chars');
        }
        $this->name = $name;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @see https://www.tinkoff.ru/kassa/develop/api/receipt/#Items
     * Стоимость товара в копейках
     * Произведение Quantity и Price
     *
     * @return int
     */
    public function getAmount(): int
    {
        return (int)($this->quantity * $this->price);
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(?string $paymentMethod): void
    {
        if (null !== $paymentMethod && Constant::paymentMethodInvalid($paymentMethod)) {
            throw new \InvalidArgumentException('Unknown payment method');
        }
        $this->paymentMethod = $paymentMethod;
    }

    public function getPaymentObject(): ?string
    {
        return $this->paymentObject;
    }

    public function setPaymentObject(?string $paymentObject): void
    {
        $this->paymentObject = $paymentObject;
    }

    public function getTax(): string
    {
        return $this->tax;
    }

    public function setTax(string $tax): void
    {
        $this->tax = $tax;
    }

    public function getEan13(): ?string
    {
        return $this->ean13;
    }

    public function setEan13(?string $ean13): void
    {
        $this->ean13 = $ean13;
    }
}
