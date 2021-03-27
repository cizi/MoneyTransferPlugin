<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use Library\Currencies\Currency;
use Library\Currencies\CurrenciesEnum;

class CurrencyTest extends TestCase
{
    public function testCanBeCreatedFromConstructor(): void
    {
        $this->assertInstanceOf(
            Currency::class,
            new Currency(CurrenciesEnum::CZK, 1)
        );
    }

    public function testCurrencyShortName(): void
    {
        $currencyCzk = new Currency(CurrenciesEnum::CZK, 1);
        $this->assertEquals(CurrenciesEnum::CZK, $currencyCzk->getCurrencyShort());
    }

    public function testCurrencyExchangeRate(): void
    {
        $exchangeRate = 1.23;
        $currencyCzk = new Currency(CurrenciesEnum::CZK, $exchangeRate);
        $this->assertEquals($exchangeRate, $currencyCzk->getCurrencyExchangeRate());
    }

    public function testCompareCurrenciesEqual(): void
    {
        $currencyCzk = new Currency(CurrenciesEnum::CZK, 1);
        $currencyEur = new Currency(CurrenciesEnum::CZK, 1);

        $this->assertEquals($currencyCzk, $currencyEur);
    }

    public function testCompareCurrenciesNotEqual(): void
    {
        $currencyCzk = new Currency(CurrenciesEnum::CZK, 1);
        $currencyEur = new Currency(CurrenciesEnum::EUR, 26);

        $this->assertNotEquals($currencyCzk, $currencyEur);
    }
}