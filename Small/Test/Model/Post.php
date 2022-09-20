<?php

namespace Small\Sample\Model;

class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'custom_post';

    protected $_cacheTag = 'custom_post';

    protected $_eventPrefix = 'custom_post';

    protected function _construct()
    {
        $this->_init('\Small\Sample\Model\ResourceModel\Post');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG.'_'.$this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
