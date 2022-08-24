<?php

namespace Pada\Tinkoff\Payment\Contract;

interface NewPaymentResultInterface extends ResultInterface
{
    /**
     * Идентификатор терминала. Выдается продавцу банком при заведении терминала
     * @return string
     */
    public function getTerminalKey(): string;

    /**
     * Сумма в копейках
     * @return int
     */
    public function getAmount(): int;

    /**
     * Идентификатор заказа в системе продавца
     * @return string
     */
    public function getOrderId(): string;

    /**
     * Идентификатор платежа в системе банка
     * @return int
     */
    public function getPaymentId(): int;

    /**
     * Ссылка на платежную форму
     * @return string|null
     */
    public function getPaymentURL(): ?string;

    /**
     * Статус платежа:
     * - NEW:       В случае успешного сценария
     * - REJECTED:  В случае неуспешного сценария
     * @return string|null
     */
    public function getStatus(): ?string;

    /**
     * В случае успешного сценария
     * @return bool
     */
    public function isStatusNew(): bool;

    /**
     * В случае неуспешного сценария
     * @return bool
     */
    public function isStatusRejected(): bool;
}
