<?php
namespace Small\CurrencyRates\Api;

/**
 *
 */
interface CurrencyRateRepositoryInterface
{
    /**
     * @param Data\CurrencyRateInterface $currencyRate
     * @return mixed
     */
    public function save(
        \Small\CurrencyRates\Api\Data\CurrencyRateInterface $currencyRate);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * @param Data\CurrencyRateInterface $currencyRate
     * @return mixed
     */
    public function delete(
        \Small\CurrencyRates\Api\Data\CurrencyRateInterface $currencyRate
    );

    /**
     * @param $currencyRateId
     * @return mixed
     */
    public function deleteById($currencyRateId);

    /**
     * @param $currencyCode
     * @return mixed
     */
    public function get($currencyCode);
}
