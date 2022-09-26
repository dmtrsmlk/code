<?php
declare(strict_types=1);

namespace Small\CurrencyRates\Helper;


use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\LocalizedException;
use Small\CurrencyRates\Api\CurrencyRateRepositoryInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const BASE_CURRENCY = 'USD';
    const CURRENCY_FROM = 'currency_from';
    const CURRENCY_TO = 'currency_to';

    /**
     * @var CurrencyRateFactory
     */
    private $currencyRateFactory;
    /**
     * @var CurrencyRateRepositoryInterface
     */
    private $currencyRateRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;
    /**
     * @var FilterBuilder
     */
    private $filterBuilder;
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterBuilder $filterBuilder
     * @param CurrencyRateRepositoryInterface $repository
     * @param CurrencyRateFactory $currencyRateFactory
     * @param Logger $logger
     * @param Context $context
     */
    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        CurrencyRateRepositoryInterface $repository,
        CurrencyRateFactory $currencyRateFactory,
        Logger $logger,
        Context $context
    )
    {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->currencyRateFactory = $currencyRateFactory;
        $this->currencyRateRepository = $repository;
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * @param string $currency
     * @param string $baseCurrency
     * @return mixed|null
     */
    public function getFirstPriceRate(string $currency, string $baseCurrency = self::BASE_CURRENCY)
    {
        $result = null;
        $filters[] = $this->filterBuilder->setField(self::CURRENCY_TO)
            ->setConditionType('eq')
            ->setValue($currency)
            ->create();
        $this->searchCriteriaBuilder->addFilters($filters);

        $searchCriteria = $this->searchCriteriaBuilder->create();
        try {
            $result = $this->currencyRateRepository->getList($searchCriteria);
        } catch (LocalizedException $e) {
            $this->logger->debug((string)$e);
        }

        $items = $result->getItems();

        foreach ($items as $item){
            $result = $item->getPriceMatrixCurrencyRate();
        }
        return $result;
    }

    /**
     * @param string $currency
     * @param string $baseCurrency
     * @return mixed|null
     */
    public function getSecondPriceRate(string $currency, string $baseCurrency = self::BASE_CURRENCY)
    {
        $result = null;
        $filters[] = $this->filterBuilder->setField(self::CURRENCY_TO)
            ->setConditionType('eq')
            ->setValue($currency)
            ->create();
        $this->searchCriteriaBuilder->addFilters($filters);

        $searchCriteria = $this->searchCriteriaBuilder->create();
        try{
            $result = $this->currencyRateRepository->getList($searchCriteria);
        } catch (LocalizedException $e){
            $this->logger->debug((string)$e);
        }
        $items = $result->getItems();

        foreach ($items as $item) {
            $result = $item->getCostPriceCurrencyRate();
        }
        return $result;
    }
}
