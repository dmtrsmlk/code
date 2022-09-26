<?php
declare(strict_types=1);

namespace Small\Sample\Model;

class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'custom_post';

    protected $_cacheTag = 'custom_post';

    protected $_eventPrefix = 'custom_post';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('\Small\Sample\Model\ResourceModel\Post');
    }

    /**
     * @return string[]
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG.'_'.$this->getId()];
    }

    /**
     * @return array
     */
    public function getDefaultValues(): array
    {
        $values = [];

        return $values;
    }
}
