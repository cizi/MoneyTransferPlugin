<?php

declare(strict_types=1);

namespace Library\Wallets;

use Library\Currencies\CurrenciesEnum;
use Library\Operations\BaseCurrencyOperation;

class Wallet
{
    // pokud budu chtít porovnávat více měn, budu potřeovat někde mít tabulku kolik dostanu za jakou měnu atp.
    // pro naše použití počítám jen s měnou CZK a EUR a převodní tabulka je HARD CODED
    private static array $exchangeTable = [
        CurrenciesEnum::EUR => 26,
        CurrenciesEnum::CZK => 1,
    ];

    public function getHigher(BaseCurrencyOperation $wallet1, BaseCurrencyOperation $wallet2): BaseCurrencyOperation
    {
        if ($wallet1->getBaseCurrency() === $wallet2->getBaseCurrency()) {
            if ($wallet1->getTotal() > $wallet2->getTotal()) {
                return $wallet1;
            } else {
                return $wallet2;
            }
        }
        return $this->getHigherDifferentCurrencies($wallet1, $wallet2);
    }

    private function getHigherDifferentCurrencies(
        BaseCurrencyOperation $wallet1,
        BaseCurrencyOperation $wallet2
    ): BaseCurrencyOperation {
        $this->validateCurrencyExchangeList($wallet1->getBaseCurrency());
        $this->validateCurrencyExchangeList($wallet2->getBaseCurrency());

        $amount1 = $wallet1->getTotal() * self::$exchangeTable[$wallet1->getBaseCurrency()];
        $amount2 = $wallet2->getTotal() * self::$exchangeTable[$wallet2->getBaseCurrency()];
        if ($amount1 > $amount2) {
            return $wallet1;
        } else {
            return $wallet2;
        }
    }

    private function validateCurrencyExchangeList(string $currencyShort): void
    {
        if (!isset(self::$exchangeTable[$currencyShort])) {
            throw new \Exception("Currency {$currencyShort} missing in exchange list");
        }
    }
}