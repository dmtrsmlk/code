<?php

namespace Small\Rates\Model\ResourceModel;

class CurrencyRate extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        // TODO: Implement _construct() method.
        $this->_init('currency_rate', 'id');
    }
}
