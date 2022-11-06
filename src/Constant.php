<?php

namespace Pada\Tinkoff\Payment;

abstract class Constant
{
    public const PAY_BASE_URI = 'https://securepay.tinkoff.ru';

    // PAYMENT STATUS

    // Создан
    public const PAYMENT_NEW = 'NEW';
    // Платежная форма открыта покупателем
    public const PAYMENT_FORM_SHOWED = 'FORM_SHOWED';
    // Платежная сессия закрыта в связи с превышением срока отсутствия активности по текущему статусу
    public const PAYMENT_DEADLINE_EXPIRED = 'DEADLINE_EXPIRED';
    // Отменен
    public const PAYMENT_CANCELED = 'CANCELED';
    // Проверка платежных данных
    public const PAYMENT_PREAUTHORIZING = 'PREAUTHORIZING';
    // Резервируется
    public const PAYMENT_AUTHORIZING = 'AUTHORIZING';
    // Не прошел авторизацию
    public const PAYMENT_AUTH_FAIL = 'AUTH_FAIL';
    // Отклонен
    public const PAYMENT_REJECTED = 'REJECTED';
    // Проверяется по протоколу 3-D Secure
    public const PAYMENT_3DS_CHECKING = '3DS_CHECKING';
    // Проверен по протоколу 3-D Secure
    public const PAYMENT_3DS_CHECKED = '3DS_CHECKED';
    // Платеж обрабатывается
    public const PAYMENT_PAY_CHECKING = 'PAY_CHECKING';
    // Зарезервирован
    public const PAYMENT_AUTHORIZED = 'AUTHORIZED';
    // Резервирование отменяется
    public const PAYMENT_REVERSING = 'REVERSING';
    // Резервирование отменено частично
    public const PAYMENT_PARTIAL_REVERSED = 'PARTIAL_REVERSED';
    // Резервирование отменено
    public const PAYMENT_REVERSED = 'REVERSED';
    // Подтверждается
    public const PAYMENT_CONFIRMING = 'CONFIRMING';
    // Платеж обрабатывается
    public const PAYMENT_CONFIRM_CHECKING = 'CONFIRM_CHECKING';
    // Подтвержден
    public const PAYMENT_CONFIRMED = 'CONFIRMED';
    // Возвращается
    public const PAYMENT_REFUNDING = 'REFUNDING';
    // Возвращен частично
    public const PAYMENT_PARTIAL_REFUNDED = 'PARTIAL_REFUNDED';
    // Возвращен полностью
    public const PAYMENT_REFUNDED = 'REFUNDED';


    // LANGUAGE

    public const LANGUAGE_RU = 'ru';
    public const LANGUAGE_EN = 'en';


    // PAY_TYPE

    // одностадийная
    public const PAY_TYPE_ONE_STEP = 'O';
    // двухстадийная
    public const PAY_TYPE_TWO_STEP = 'T';


    // TAXATION @see https://www.tinkoff.ru/kassa/develop/api/receipt/#Payments

    // общая
    public const TAXATION_OSN = 'osn';
    //  упрощенная (доходы)
    public const TAXATION_USN_INCOME = 'usn_income';
    // упрощенная (доходы минус расходы)
    public const TAXATION_USN_INCOME_OUTCOME = 'usn_income_outcome';
    // патентная
    public const TAXATION_PATENT = 'patent';
    // единый налог на вмененный доход
    public const TAXATION_ENVD = 'envd';
    // единый сельскохозяйственный налог
    public const TAXATION_ESN = 'esn';


    // FFD

    public const FFD_VERSION_1_2 = '1.2';
    public const FFD_VERSION_1_05 = '1.05';


    // PAYMENT_METHOD

    //  полный расчет
    public const PAYMENT_METHOD_FULL = 'full_payment';
    // предоплата 100%
    public const PAYMENT_METHOD_FULL_REPAYMENT = 'full_prepayment';
    // предоплата
    public const PAYMENT_METHOD_PREPAYMENT = 'prepayment';
    // аванс
    public const PAYMENT_METHOD_ADVANCE = 'advance';
    // частичный расчет и кредит
    public const PAYMENT_METHOD_PARTIAL = 'partial_payment';
    // передача в кредит
    public const PAYMENT_METHOD_CREDIT = 'credit';
    // оплата кредита
    public const PAYMENT_METHOD_CREDIT_PAYMENT = 'credit_payment';


    // PAYMENT_OBJECT

    // товар
    public const PAYMENT_OBJECT_COMMODITY = 'commodity';
    // подакцизный товар
    public const PAYMENT_OBJECT_EXCISE = 'excise';
    // работа
    public const PAYMENT_OBJECT_JOB = 'job';
    // услуга
    public const PAYMENT_OBJECT_SERVICE = 'service';
    // ставка азартной игры
    public const PAYMENT_OBJECT_GAMBLING_BET = 'gambling_bet';
    // выигрыш азартной игры
    public const PAYMENT_OBJECT_GAMBLING_PRIZE = 'gambling_prize';
    // лотерейный билет
    public const PAYMENT_OBJECT_LOTTERY = 'lottery';
    // выигрыш лотереи
    public const PAYMENT_OBJECT_LOTTERY_PRIZE = 'lottery_prize';
    // предоставление результатов интеллектуальной деятельности
    public const PAYMENT_OBJECT_INTELLECTUAL_ACTIVITY = 'intellectual_activity';
    // платеж
    public const PAYMENT_OBJECT_PAYMENT = 'payment';
    // агентское вознаграждение
    public const PAYMENT_OBJECT_AGENT_COMMISSION = 'agent_commission';
    // составной предмет расчета
    public const PAYMENT_OBJECT_COMPOSITE = 'composite';
    // иной предмет расчета
    public const PAYMENT_OBJECT_ANOTHER = 'another';
    // выплата
    public const PAYMENT_OBJECT_CONTRIBUTION = 'contribution';
    // имущественное право
    public const PAYMENT_OBJECT_PROPERTY_RIGHTS = 'property_rights';
    // внереализационный доход
    public const PAYMENT_OBJECT_UNREALIZATION = 'unrealization';
    // иные платежи и взносы
    public const PAYMENT_OBJECT_TAX_REDUCTION = 'tax_reduction';
    // торговый сбор
    public const PAYMENT_OBJECT_TRADE_FEE = 'trade_fee';
    // курортный сбор
    public const PAYMENT_OBJECT_RESORT_TAX = 'resort_tax';
    // залог
    public const PAYMENT_OBJECT_PLEDGE = 'pledge';
    // расход
    public const PAYMENT_OBJECT_INCOME_DECREASE = 'income_decrease';
    // взносы на ОПС ИП
    public const PAYMENT_OBJECT_IE_PENSION_INSURANCE_WITHOUT_PAYMENTS = 'ie_pension_insurance_without_payments';
    // взносы на ОПС
    public const PAYMENT_OBJECT_IE_PENSION_INSURANCE_WITH_PAYMENTS = 'ie_pension_insurance_with_payments';
    // взносы на ОМС ИП
    public const PAYMENT_OBJECT_IE_MEDICAL_INSURANCE_WITHOUT_PAYMENTS = 'ie_medical_insurance_without_payments';
    // взносы на ОМС
    public const PAYMENT_OBJECT_IE_MEDICAL_INSURANCE_WITH_PAYMENTS = 'ie_medical_insurance_with_payments';
    // взносы на ОСС
    public const PAYMENT_OBJECT_SOCIAL_INSURANCE = 'social_insurance';
    // платеж казино
    public const PAYMENT_OBJECT_CASINO_CHIPS = 'casino_chips';
    // выдача ДС
    public const PAYMENT_OBJECT_AGENT_PAYMENT = 'agent_payment';
    // АТНМ
    public const PAYMENT_OBJECT_EXCISABLE_GOODS_WITHOUT_MARKING_CODE = 'excisable_goods_without_marking_code';
    // АТМ
    public const PAYMENT_OBJECT_EXCISABLE_GOODS_WITH_MARKING_CODE = 'excisable_goods_with_marking_code';
    // ТНМ
    public const PAYMENT_OBJECT_GOODS_WITHOUT_MARKING_CODE = 'goods_without_marking_code';
    // ТМ
    public const PAYMENT_OBJECT_GOODS_WITH_MARKING_CODE = 'goods_with_marking_code';


    // TAX

    // без НДС
    public const TAX_NONE = 'none';
    // 0%
    public const TAX_VAT0 = 'vat0';
    // 10%
    public const TAX_VAT10 = 'vat10';
    // 20%
    public const TAX_VAT20 = 'vat20';
    // 10/110
    public const TAX_VAT110 = 'vat110';
    // 18/118
    public const TAX_VAT118 = 'vat118';
    // 20/120
    public const TAX_VAT120 = 'vat120';


    // AGENT_SIGN

    // банковский платежный агент
    public const AGENT_SIGN_BANK_PAYING_AGENT = 'bank_paying_agent';
    // банковский платежный субагент
    public const AGENT_SIGN_BANK_PAYING_SUBAGENT = 'bank_paying_subagent';
    // латежный агент
    public const AGENT_SIGN_PAYING_AGENT = 'paying_agent';
    // платежный субагент
    public const AGENT_SIGN_PAYING_SUBAGENT = 'paying_subagent';
    // поверенный
    public const AGENT_SIGN_ATTORNEY = 'attorney';
    // комиссионер
    public const AGENT_SIGN_COMMISSION_AGENT = 'commission_agent';
    // другой тип агента
    public const AGENT_SIGN_ANOTHER = 'another';


    // MARK_CODE

    // код товара, формат которого не идентифицирован, как один из реквизитов
    public const MARK_CODE_UNKNOWN = 'Unknown';
    // код товара в формате EAN-8
    public const MARK_CODE_EAN8 = 'ean8';
    // код товара в формате EAN-13
    public const MARK_CODE_EAN13 = 'ean13';
    // код товара в формате ITF-14
    public const MARK_CODE_ITF14 = 'itf14';
    // код товара в формате GS1, нанесенный на товар, не подлежащий маркировке
    public const MARK_CODE_GS10 = 'gs10';
    // код товара в формате GS1, нанесенный на товар, подлежащий маркировке
    public const MARK_CODE_GS1M = 'gs1m';
    // код товара в формате короткого кода маркировки, нанесенный на товар
    public const MARK_CODE_SHORT = 'short';
    // контрольно-идентификационный знак мехового изделия
    public const MARK_CODE_FUR = 'fur';
    // код товара в формате ЕГАИС-2.0
    public const MARK_CODE_EGAIS20 = 'egais20';
    // код товара в формате ЕГАИС-3.0
    public const MARK_CODE_EGAIS30 = 'egais30';



    // HELPERS

    public static function ffdVersionValid(string $ffdVersion): bool
    {
        return \in_array($ffdVersion,[
            static::FFD_VERSION_1_05,
            static::FFD_VERSION_1_2,
        ], true);
    }

    public static function ffdVersionInvalid(string $ffdVersion): bool
    {
        return !static::ffdVersionValid($ffdVersion);
    }

    public static function taxationValid(string $taxation): bool
    {
        return \in_array($taxation, [
            static::TAXATION_OSN,
            static::TAXATION_ENVD,
            static::TAXATION_ESN,
            static::TAXATION_PATENT,
            static::TAXATION_USN_INCOME,
            static::TAXATION_USN_INCOME_OUTCOME,
        ], true);
    }

    public static function taxationInvalid(string $taxation): bool
    {
        return !static::taxationValid($taxation);
    }

    public static function paymentMethodValid(string $paymentMethod): bool
    {
        return \in_array($paymentMethod, [
            static::PAYMENT_METHOD_ADVANCE,
            static::PAYMENT_METHOD_CREDIT,
            static::PAYMENT_METHOD_CREDIT_PAYMENT,
            static::PAYMENT_METHOD_FULL,
            static::PAYMENT_METHOD_FULL_REPAYMENT,
            static::PAYMENT_METHOD_PARTIAL,
            static::PAYMENT_METHOD_PREPAYMENT,
        ], true);
    }

    public static function paymentMethodInvalid(string $paymentMethod): bool
    {
        return !static::paymentMethodValid($paymentMethod);
    }

    public static function paymentObjectValidFfd105(string $paymentObject): bool
    {
        return \in_array($paymentObject, [
            static::PAYMENT_OBJECT_COMMODITY,
            static::PAYMENT_OBJECT_EXCISE,
            static::PAYMENT_OBJECT_JOB,
            static:: PAYMENT_OBJECT_SERVICE,
            static::PAYMENT_OBJECT_GAMBLING_BET,
            static::PAYMENT_OBJECT_GAMBLING_PRIZE,
            static::PAYMENT_OBJECT_LOTTERY,
            static::PAYMENT_OBJECT_LOTTERY_PRIZE,
            static::PAYMENT_OBJECT_INTELLECTUAL_ACTIVITY,
            static::PAYMENT_OBJECT_PAYMENT,
            static::PAYMENT_OBJECT_AGENT_COMMISSION,
            static::PAYMENT_OBJECT_COMPOSITE,
            static::PAYMENT_OBJECT_ANOTHER,
        ], true);
    }

    public static function paymentObjectInvalidFfd105(string $paymentObject): bool
    {
        return !static::paymentObjectValidFfd105($paymentObject);
    }

    public static function taxValidFfd105(string $tax): bool
    {
        return \in_array($tax, [
            static::TAX_NONE,
            static::TAX_VAT0,
            static::TAX_VAT10,
            static::TAX_VAT20,
            static::TAX_VAT110,
            static::TAX_VAT120,
        ], true);
    }

    public static function taxInvalidFfd105(string $tax): bool
    {
        return !static::taxValidFfd105($tax);
    }
}
