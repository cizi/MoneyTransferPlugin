<?php

declare(strict_types = 1);

namespace Library\Operations;

use Library\Currencies\ICurrency;

class BaseCurrencyOperation
{
    private float $total;

    private string $baseCurrency;

    public function __construct(string $baseCurrencyShort)
    {
        $this->total = 0;
        $this->baseCurrency = $baseCurrencyShort;
    }

    public function addition(ICurrency $currency, float $amount): void
    {
        $this->checkInputCurrency($currency);
        if ($this->baseCurrency === $currency->getCurrencyShort()) {
            $this->total += $amount;
        } else {
            $this->total += $currency->getCurrencyExchangeRate() * $amount;
        }
    }

    public function subtraction(ICurrency $currency, float $amount): void
    {
        $this->checkInputCurrency($currency);
        if ($this->baseCurrency === $currency->getCurrencyShort()) {
            $this->total -= $amount;
        } else {
            $this->total -= $currency->getCurrencyExchangeRate() * $amount;
        }
    }

    public function multiplication(ICurrency $currency, float $multiplicator): void
    {
        $this->checkInputCurrency($currency);
        if ($this->baseCurrency === $currency->getCurrencyShort()) {
            $this->total *= $multiplicator;
        } else {
            $this->total *= $currency->getCurrencyExchangeRate() * $multiplicator;
        }
    }

    public function division(ICurrency $currency, float $divider): void
    {
        $this->checkInputCurrency($currency);
        if ($this->baseCurrency === $currency->getCurrencyShort()) {
            $this->total /= $divider;
        } else {
            $this->total /= $currency->getCurrencyExchangeRate() * $divider;
        }
    }

    public function getTotal(int $precision = 3): float
    {
        return round($this->total, $precision);
    }

    public function getBaseCurrency(): string
    {
        return $this->baseCurrency;
    }

    public function setBaseCurrency(string $baseCurrency): void
    {
        $this->baseCurrency = $baseCurrency;
    }

    private function checkInputCurrency(ICurrency $currency) : void
    {
        if ($currency->getCurrencyExchangeRate() === 0) {
            throw new \Exception("Missing currency exchange rate");
        }
        if (empty(trim($currency->getCurrencyShort()))) {
            throw new \Exception("Missing currency short name");
        }
    }
}