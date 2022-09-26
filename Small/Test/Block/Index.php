<?php
declare(strict_types=1);

namespace Small\Test\Block;

use Magento\Framework\View\Element\Template;

class Index extends \Magento\Framework\View\Element\Template
{
    public function __construct(\Magento\Framework\View\Element\Template\Context $context)
    {
        parent::__construct($context);
    }

    public function sayHello(): \Magento\Framework\Phrase
    {
        return __('Hello World!');
    }
}
