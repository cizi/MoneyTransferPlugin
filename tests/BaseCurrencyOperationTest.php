<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use Library\Currencies\Currency;
use Library\Currencies\CurrenciesEnum;
use Library\Operations\BaseCurrencyOperation;

class BaseCurrencyOperationTest extends TestCase
{
    public function testCanBeCreatedFromConstructor(): void
    {
        $this->assertInstanceOf(
            BaseCurrencyOperation::class,
            new BaseCurrencyOperation(CurrenciesEnum::CZK)
        );
    }

    public function testCurrencyEqual(): void
    {
        $baseOperationCzk = new BaseCurrencyOperation(CurrenciesEnum::CZK);
        $this->assertEquals(CurrenciesEnum::CZK, $baseOperationCzk->getBaseCurrency());
    }

    public function testCurrencyTotal(): void
    {
        $baseOperationCzk = new BaseCurrencyOperation(CurrenciesEnum::CZK);
        $this->assertEquals(0, $baseOperationCzk->getTotal());
    }

    public function testAddition(): void
    {
        $czechCurrency = new Currency(CurrenciesEnum::CZK, 1);
        $eurCurrency = new Currency(CurrenciesEnum::EUR, 26);
        $baseOperationCzk = new BaseCurrencyOperation(CurrenciesEnum::CZK);
        $baseOperationCzk->addition($czechCurrency, 100);
        $baseOperationCzk->addition($eurCurrency, 1);

        $this->assertEquals(126, $baseOperationCzk->getTotal());
    }

    public function testSubtraction(): void
    {
        $czechCurrency = new Currency(CurrenciesEnum::CZK, 1);
        $eurCurrency = new Currency(CurrenciesEnum::EUR, 26);
        $baseOperationCzk = new BaseCurrencyOperation(CurrenciesEnum::CZK);

        $baseOperationCzk->addition($czechCurrency, 100);
        $baseOperationCzk->addition($eurCurrency, -1);
        $this->assertEquals(74, $baseOperationCzk->getTotal());
    }

    public function testMultiplication(): void
    {
        $czechCurrency = new Currency(CurrenciesEnum::CZK, 1);
        $baseOperationCzk = new BaseCurrencyOperation(CurrenciesEnum::CZK);

        $baseOperationCzk->addition($czechCurrency, 100);
        $baseOperationCzk->multiplication($czechCurrency, 2);
        $this->assertEquals(200, $baseOperationCzk->getTotal());
    }

    public function testDivision(): void
    {
        $addingEuros = 4;
        $eurCurrency = new Currency(CurrenciesEnum::EUR, 26);
        $baseOperationCzk = new BaseCurrencyOperation(CurrenciesEnum::CZK);

        $baseOperationCzk->addition($eurCurrency, $addingEuros);
        $baseOperationCzk->division($eurCurrency, $addingEuros);

        $this->assertEquals(1, $baseOperationCzk->getTotal());
    }

    public function testCorrectExchange(): void
    {
        $eurCurrency = new Currency(CurrenciesEnum::EUR, 26);
        $baseOperationCzk = new BaseCurrencyOperation(CurrenciesEnum::CZK);

        $baseOperationCzk->addition($eurCurrency, 4);

        $this->assertEquals(104, $baseOperationCzk->getTotal());
    }
}