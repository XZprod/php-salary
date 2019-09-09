<?php

namespace App;

/**
 * Class Currency
 * @package App
 */
class Currency
{
    const DEFAULT_TRANSFORM_CURRENCY = 'USD';

    protected $transformCurrency;
    protected $rate;
    protected $currencyId;
    public function __construct($currencyCode = null)
    {
        $this->transformCurrency = $currencyCode ?? self::DEFAULT_TRANSFORM_CURRENCY;
    }

    public function transform($amount)
    {
        $currencyRate = $this->getCurrencyRate();
        if ($currencyRate == 0) {
            throw new \DivisionByZeroError('Деление на ноль');
        }
        return round($amount / $currencyRate, 2);
    }

    protected function getCurrencyRate()
    {
        if (!$this->rate) {
            $rate = $this->getRateFromCache();

            if (!$rate) {
                $this->updateCurrencyRate();
                $rate = $this->getRateFromCache();
            }
        }
        $this->rate = $rate;
        return $this->rate;
    }

    protected function getRateFromCache()
    {
        $date = date('Y-m-d');
        $currencyId = $this->getCurrencyId();

        $query = "SELECT value FROM currency_date WHERE currency = $currencyId AND date = '$date'";
        $rate = $this->fetch($query);
        $rate = $rate[0]['value'];
        return $rate;
    }

    protected function getCurrencyId()
    {
        if (!$this->currencyId)
        {
            $currency = $this->transformCurrency;
            $query = "SELECT id FROM currency WHERE short = '$currency';";
            $currency = $this->fetch($query);
            $currency = (int) $currency[0]['id'];
            return $currency;
        }
        return $this->currencyId;
    }

    protected function updateCurrencyRate()
    {
        $date = date('Y-m-d');
        $currencyData = file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js');
        $currencyData = json_decode($currencyData);
        $currency = $this->getCurrencyId();
        $rate = $currencyData->Valute->{$this->transformCurrency}->Value;
        $query = "INSERT INTO currency_date(currency, value, date) VALUES ('$currency', $rate, '$date')";
        $this->exec($query);
    }

    protected function fetch($query)
    {
        return $this->getDb()->fetch($query);
    }

    protected function exec($query)
    {
        return $this->getDb()->exec($query);
    }

    protected function getDb()
    {
        $serviceLocator = ServiceLocator::getInstance();
        $db = $serviceLocator->getService('db');
        return $db;
    }
}