<?php

namespace Small\CurrencyRates\Model\ResourceModel\CurrencyRate;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $idFieldName = 'id';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Small\Rates\Model\ResourceModel\CurrencyRate::class,
            \Small\Rates\Model\ResourceModel\CurrencyRate::class
        );
    }
}
