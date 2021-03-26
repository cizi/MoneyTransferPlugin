<?php

declare(strict_types = 1);


namespace Library\Currencies;


class BaseCurrency
{
    protected string $currencyShort;

    protected float $exchangeRate;

    public function round(float $amount, int $precision = 2): float
    {
        return round($amount, $precision);
    }

    public function getCurrencyShort(): string
    {
        return $this->currencyShort;
    }

    public function getCurrencyExchangeRate(): float
    {
        return $this->exchangeRate;
    }
}