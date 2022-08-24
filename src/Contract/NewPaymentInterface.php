<?php

namespace Pada\Tinkoff\Payment\Contract;

use Pada\Tinkoff\Payment\DataKV;

/**
 * @see https://www.tinkoff.ru/kassa/develop/api/payments/init-request/
 *
 * Метод создает платеж: продавец получает ссылку на платежную форму и должен перенаправить по ней покупателя
 */
interface NewPaymentInterface extends TerminalKeyAwareInterface, TokenAwareInterface
{
    /**
     * Сумма в копейках
     * @return int
     */
    public function getAmount(): int;

    /**
     * 	Идентификатор заказа в системе продавца
     * @return string
     */
    public function getOrderId(): string;

    /**
     * Тип оплаты
     * @return string|null
     */
    public function getPayType(): ?string;

    /**
     * Страница успеха
     * @return string|null
     */
    public function getSuccessURL(): ?string;

    /**
     * Страница ошибки
     * @return string|null
     */
    public function getFailURL(): ?string;

    /**
     * Адрес для получения http нотификаций
     * @return string|null
     */
    public function getNotificationURL(): ?string;

    /**
     * Идентификатор родительского платежа
     * @return bool
     */
    public function isRecurrent(): bool;

    /**
     * Идентификатор покупателя в системе продавца.
     * Передается вместе с параметром CardId. См. метод GetCardList
     * Также необходим для сохранения карт на платежной форме (платежи в один клик).
     * @see https://www.tinkoff.ru/kassa/develop/api/autopayments/getcardlist-description/
     * @return string|null
     */
    public function getCustomerKey(): ?string;

    /**
     * Cрок жизни ссылки или динамического QR-кода СБП, если выбран данный способ оплаты
     * Максимальное значение: 90 дней от текущей даты
     * Временная метка по стандарту ISO8601 в формате YYYY-MM-DDThh:mm:ss±hh:mm
     * @return \DateTime|null
     */
    public function getRedirectDueDate(): ?\DateTime;

    /**
     * IP-адрес покупателя
     * @return string|null
     */
    public function getIp(): ?string;

    /**
     * 	Описание заказа
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * Язык платежной формы
     * @return string|null
     */
    public function getLanguage(): ?string;

    /**
     * Дополнительные параметры платежа в формате "ключ":"значение" (не более 20 пар).
     * Наименование самого параметра должно быть в верхнем регистре, иначе его содержимое будет игнорироваться.
     * @return DataKV|null
     */
    public function getData(): ?DataKV;

    /**
     * Массив данных чека. См. Структура объекта Receipt
     * @see https://www.tinkoff.ru/kassa/develop/api/receipt/
     * @return ReceiptInterface|null
     */
    public function getReceipt(): ?ReceiptInterface;
}
