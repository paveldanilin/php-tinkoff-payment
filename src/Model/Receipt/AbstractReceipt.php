<?php

namespace Pada\Tinkoff\Payment\Model\Receipt;


use Pada\Tinkoff\Payment\Constant;
use Pada\Tinkoff\Payment\Contract\ReceiptInterface;
use Pada\Tinkoff\Payment\Model\Receipt\FFD105\ReceiptBuilderFFD105;

/**
 * @see https://www.tinkoff.ru/kassa/develop/api/receipt/
 */
abstract class AbstractReceipt implements ReceiptInterface
{
    /**
     * Электронная почта покупателя
     * Обязательный: Нет, если передан параметр Phone
     * Length: 64
     *
     * @var string|null
     */
    private ?string $email = null;

    /**
     * Телефон покупателя в формате +{Ц}
     * Обязательный: Нет, если передан параметр Email
     * Length: 64
     *
     * @var string|null
     */
    private ?string $phone = null;

    /**
     * Constant::TAXATION_XXX
     * Обязательный
     *
     * @var string
     */
    private string $taxation = '';

    /**
     * Массив позиций чека с информацией о товарах
     * Обязательный
     *
     * @var array<AbstractItem>
     */
    private array $items = [];

    /**
     * @var array<string>
     */
    private array $itemNames = [];

    // TODO: Payments Объект с информацией о видах оплаты заказа. См.

    /**
     * Constant::FFD_XXX
     * Необязательный
     *
     * @var string
     */
    private string $ffdVersion;


    public function __construct(string $ffdVersion)
    {
        $this->setFfdVersion($ffdVersion);
    }

    public static function getBuilderFFD105(): ReceiptBuilderFFD105
    {
        return new ReceiptBuilderFFD105();
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        if (null !== $phone && '+' !== $phone[0]) {
            throw new \InvalidArgumentException('Bad phone format: missed leading "+" sign');
        }
        $this->phone = $phone;
    }

    public function getTaxation(): string
    {
        return $this->taxation;
    }

    public function setTaxation(string $taxation): void
    {
        if (Constant::taxationInvalid($taxation)) {
            throw new \InvalidArgumentException('Unknown Taxation value');
        }
        $this->taxation = $taxation;
    }

    /**
     * @return iterable<AbstractItem>
     */
    public function getItems(): iterable
    {
        return $this->items;
    }

    /**
     * @param array<AbstractItem> $items
     */
    public function setItems(array $items): void
    {
        $this->items = [];
        $this->itemNames = [];
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    public function addItem(AbstractItem $item): void
    {
        if (\in_array($item->getName(), $this->itemNames, true)){
            return;
        }
        $this->items[] = $item;
        $this->itemNames[] = $item->getName();
    }

    public function getFfdVersion(): string
    {
        return $this->ffdVersion;
    }

    private function setFfdVersion(string $ffdVersion): void
    {
        if (Constant::ffdVersionInvalid($ffdVersion)) {
            throw new \InvalidArgumentException('Unknown FFD version');
        }
        $this->ffdVersion = $ffdVersion;
    }
}
