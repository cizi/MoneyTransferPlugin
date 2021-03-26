<?php

declare(strict_types = 1);

namespace Library\Currencies;

interface ICurrency
{
    public function getCurrencyShort();

    public function getCurrencyExchangeRate();
}