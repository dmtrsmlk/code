<?php
declare(strict_types=1);

namespace Small\Test\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class LogData implements ObserverInterface
{
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        //TODO: Observer getProduct()
        $item =$observer->getProduct()->getName();
        $this->logger->info("Somebody added $item to cart");
    }
}
