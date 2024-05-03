<?php

namespace App;

enum PaymentMethodEnum: string
{
    case Tunai = 'Tunai';
    case NonTunai = 'Non Tunai';

    public static function toArray() :array {
        return array_column(PaymentMethodEnum::cases(), 'value');
    }
}
