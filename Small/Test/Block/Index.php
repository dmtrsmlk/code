<?php
declare(strict_types=1);

namespace Small\Test\Block;

use Magento\Framework\Phrase;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Index extends Template
{
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    public function sayHello(): Phrase
    {
        return __('Hello World!');
    }
}
