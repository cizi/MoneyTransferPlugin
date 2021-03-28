<?php

declare(strict_types = 1);

namespace Library\Currencies;

class VirtualCurrency implements ICurrency
{
    /*
     * Příklad použití netypické měny, např. BITCOINU, a příklad užití
     * univerzálního Interface
     */
    public const CURRENCY_SHORT = 'BITCOIN';

    public function getCurrencyShort(): string
    {
        return self::CURRENCY_SHORT;
    }

    public function getCurrencyExchangeRate(): float
    {
        return 11111;
    }
}