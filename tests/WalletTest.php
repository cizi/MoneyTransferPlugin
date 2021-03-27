<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use Library\Currencies\Currency;
use Library\Wallets\Wallet;
use Library\Currencies\CurrenciesEnum;
use Library\Operations\BaseCurrencyOperation;

class WalletTest extends TestCase
{
    public function testCanBeCreatedFromConstructor(): void
    {
        $this->assertInstanceOf(
            Wallet::class,
            new Wallet()
        );
    }

    public function testGetHigher(): void
    {
        // Wallet 1
        $czechCurrencyWallet1 = new Currency(CurrenciesEnum::CZK, 1);
        $eurCurrencyWallet1 = new Currency(CurrenciesEnum::EUR, 26);

        $baseOperationCzkWallet = new BaseCurrencyOperation(CurrenciesEnum::CZK);
        $baseOperationCzkWallet->addition($czechCurrencyWallet1, 100);  // adding 100 Kc
        $baseOperationCzkWallet->addition($eurCurrencyWallet1, 1);      // adding €1

        // Wallet 2
        $czechCurrencyWallet2 = new Currency(CurrenciesEnum::CZK, .03846);
        $eurCurrencyWallet2 = new Currency(CurrenciesEnum::EUR, 1);

        $baseOperationEurWallet = new BaseCurrencyOperation(CurrenciesEnum::EUR);
        $baseOperationEurWallet->addition($eurCurrencyWallet2, 4);  // adding €4
        $baseOperationEurWallet->addition($czechCurrencyWallet2, 26);   // adding 26Kc => €1

        $wallet = new Wallet();
        $higherWallet = $wallet->getHigher($baseOperationCzkWallet, $baseOperationEurWallet);

        $this->assertEquals($baseOperationEurWallet, $higherWallet);
    }
}