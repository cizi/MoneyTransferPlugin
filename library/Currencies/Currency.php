<?php

declare(strict_types = 1);

namespace Library\Currencies;

class Currency extends BaseCurrency implements ICurrency
{

    public function __construct(string $currencyShort, float $exchangeRate)
    {
        $this->currencyShort = $currencyShort;
        $this->exchangeRate = $exchangeRate;
    }


}