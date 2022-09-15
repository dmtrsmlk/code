<?php

namespace Small\CurrencyRates\Api\Data;

use Magento\Tests\NamingConvention\true\string;

interface CurrencyRateInterface
{
    const ENTITY_ID = 'id';
    const CURRENCY_FROM = 'currency_from';
    const CURRENCY_TO = 'currency_to';
    const COST_PRICE_RATE = 'cost_price_currency_rate';
    const PRICE_MATRIX_RATE = 'price_matrix_currency_rate';

    /**
     * @return mixed
     */
    public function getEntityId();

    /**
     * @param $rateId
     * @return mixed
     */
    public function setEntityId($rateId);

    /**
     * @return mixed
     */
    public function getCurrencyFrom();

    /**
     * @param string $currency
     * @return mixed
     */
    public function setCurrencyFrom(string $currency);

    /**
     * @return mixed
     */
    public function getCurrencyTo();

    /**
     * @param string $currency
     * @return mixed
     */
    public function setCurrencyTo(string $currency);

    /**
     * @return mixed
     */
    public function getCostPriceCurrencyRate();

    /**
     * @param string $currency
     * @return mixed
     */
    public function setCostPriceCurrencyRate(string $currency);

    /**
     * @return mixed
     */
    public function getPriceMatrixCurrencyRate();

    /**
     * @param string $currency
     * @return mixed
     */
    public function setPriceMatrixCurrencyRate(string $currency);


}
