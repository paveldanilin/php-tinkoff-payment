<?php

namespace Pada\Tinkoff\Payment\Model\Init;

use Pada\Tinkoff\Payment\Constant;
use Pada\Tinkoff\Payment\Contract\NewPaymentInterface;
use Pada\Tinkoff\Payment\Contract\ReceiptInterface;
use Pada\Tinkoff\Payment\DataKV;
use Pada\Tinkoff\Payment\Model\Receipt\AbstractItem;

final class PaymentBuilder implements PaymentBuilderInterface
{
    private int $amount = -1; // Будет посчитан как сумма amount всех item в чеке см Receipt
    private string $orderId = '';
    private ?string $payType = null;
    private ?string $ip = null;
    private ?string $description = null;
    private ?string $language = null;
    private ?string $successURL = null;
    private ?string $failURL = null;
    private ?string $notificationURL = null;
    private ?DataKV $data = null;
    private ?ReceiptInterface $receipt = null;
    private bool $isRecurrent = false;
    private ?string $customerKey = null;
    /**
     * Временная метка по стандарту ISO8601 в формате YYYY-MM-DDThh:mm:ss±hh:mm
     * @var \DateTime|null
     */
    private ?\DateTime $redirectDueDate = null;


    public static function factory(): self
    {
        return new self();
    }

    public function amount(int $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function orderId(string $orderId): self
    {
        $this->orderId = $orderId;
        return $this;
    }

    public function payType(?string $payType): self
    {
        $this->payType = $payType;
        return $this;
    }

    public function oneStep(): self
    {
        return $this->payType(Constant::PAY_TYPE_ONE_STEP);
    }

    public function twoStep(): self
    {
        return $this->payType(Constant::PAY_TYPE_TWO_STEP);
    }

    public function ip(?string $ip): self
    {
        $this->ip = $ip;
        return $this;
    }

    public function description(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function language(?string $language): self
    {
        $this->language = $language;
        return $this;
    }

    public function ru(): self
    {
        return $this->language(Constant::LANGUAGE_RU);
    }

    public function en(): self
    {
        return $this->language(Constant::LANGUAGE_EN);
    }

    public function successURL(?string $successURL): self
    {
        $this->successURL = $successURL;
        return $this;
    }

    public function failURL(?string $failURL): self
    {
        $this->failURL = $failURL;
        return $this;
    }

    public function notificationURL(?string $notificationURL): self
    {
        $this->notificationURL = $notificationURL;
        return $this;
    }

    public function data(?DataKV $dataKV): self
    {
        $this->data = $dataKV;
        return $this;
    }

    public function dataValue(string $key, string $value): self
    {
        if (null === $this->data) {
            $this->data = new DataKV();
        }
        $this->data->set($key, $value);
        return $this;
    }

    public function receipt(?ReceiptInterface $receipt): self
    {
        $this->receipt = $receipt;
        return $this;
    }

    public function recurrent(bool $recurrent): self
    {
        $this->isRecurrent = $recurrent;
        return $this;
    }

    public function customerKey(?string $customerKey): self
    {
        $this->customerKey = $customerKey;
        return $this;
    }

    public function redirectDueDate(?\DateTime $redirectDueDate): self
    {
        $this->redirectDueDate = $redirectDueDate;
        return $this;
    }


    public function build(): NewPaymentInterface
    {
        $this->calcAmount();

        if (empty($this->orderId)) {
            throw new \RuntimeException('OrderId not defined');
        }

        if ($this->isRecurrent && empty($this->customerKey)) {
            throw new \RuntimeException('Not defined customerKey');
        }

        $payment = new NewPayment();

        $payment->setAmount($this->amount);
        $payment->setOrderId($this->orderId);
        $payment->setPayType($this->payType);
        $payment->setIp($this->ip);
        $payment->setDescription($this->description);
        $payment->setLanguage($this->language);
        $payment->setSuccessURL($this->successURL);
        $payment->setFailURL($this->failURL);
        $payment->setNotificationURL($this->notificationURL);
        $payment->setData($this->data);
        $payment->setReceipt($this->receipt);
        $payment->setRecurrent($this->isRecurrent);
        $payment->setCustomerKey($this->customerKey);
        $payment->setRedirectDueDate($this->redirectDueDate);

        $this->clean();

        return $payment;
    }

    private function calcAmount(): void
    {
        if ($this->amount < 0) {
            if (null === $this->receipt) {
                throw new \RuntimeException('Amount not defined');
            }
            $this->amount = 0;
            /** @var AbstractItem $item */
            foreach ($this->receipt->getItems() as $item) {
                $this->amount += $item->getAmount();
            }
        }
    }

    private function clean(): void
    {
        $this->amount = -1;
        $this->orderId = '';
        $this->payType = null;
        $this->ip = null;
        $this->description = null;
        $this->language = null;
        $this->successURL = null;
        $this->failURL = null;
        $this->notificationURL = null;
        $this->data = null;
        $this->receipt = null;
        $this->isRecurrent = false;
        $this->customerKey = null;
        $this->redirectDueDate = null;
    }
}
