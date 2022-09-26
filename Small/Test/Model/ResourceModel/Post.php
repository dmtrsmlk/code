<?php
declare(strict_types=1);

namespace Small\Test\Model\ResourceModel;

class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context)
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('post', 'post_id');
    }
}
