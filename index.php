<?php

declare(strict_types = 1);

use Library\Currencies\Currency;
use Library\Currencies\CurrenciesEnum;
use Library\Operations\BaseCurrencyOperation;
use \Library\Wallets\Wallet;

require __DIR__ . '/vendor/autoload.php';


// počítání v Kč
$czechCurrency = new Currency(CurrenciesEnum::CZK, 1);
$eurCurrency = new Currency(CurrenciesEnum::EUR, 26);

$baseOperationCzk = new BaseCurrencyOperation(CurrenciesEnum::CZK);
$baseOperationCzk->addition($czechCurrency, 100);
$baseOperationCzk->addition($eurCurrency, 1);
var_dump($baseOperationCzk->getBaseCurrency() . ' ' . $baseOperationCzk->getTotal(2));

echo('<br /> -------- <br />');

// počítání v eurech
$czechCurrency = new Currency(CurrenciesEnum::CZK, 0.038);
$eurCurrency = new Currency(CurrenciesEnum::EUR, 1);

$baseOperationEur = new BaseCurrencyOperation(CurrenciesEnum::EUR);
$baseOperationEur->addition($czechCurrency, 116);
$baseOperationEur->addition($eurCurrency, 1);
var_dump($baseOperationEur->getBaseCurrency() . ' ' . $baseOperationEur->getTotal(2));

/*
 * výše je patrné, že pro správné počítání hodnot je třeba mít nějaký základní
 * kurozvní lístek, který já nyní simuluji předáváním správně napočítaných kurzů
 * mezi jednotlivými měnami
 *
 * Při tvorbě objektu BaseCurrencyOperation určuji hlavní měnu peněženky, tato měna
 * má vždy kurz = 1, pokud ji do peněženky posílám
 */

echo('<br /> -------- <br />');
$wallet = new Wallet();
echo '<pre>' , var_dump($wallet->getHigher($baseOperationCzk, $baseOperationEur)) , '</pre>';

