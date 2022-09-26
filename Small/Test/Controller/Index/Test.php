<?php
declare(strict_types=1);

namespace Small\Test\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Test implements HttpGetActionInterface
{
    private $pageFactory;
    public function __construct(
        PageFactory $pageFactory
    )
    {
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        return $this->pageFactory->create();
    }
}
