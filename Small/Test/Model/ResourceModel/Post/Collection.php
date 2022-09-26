<?php
declare(strict_types=1);

namespace Small\Test\Model\ResourceModel\Post;

use Small\Test\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'post_id';
    protected $_eventPrefix = 'post_collection';
    protected $_eventObject = 'post_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Small\Test\Model\Post', Post::class);
    }
}
