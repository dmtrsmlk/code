<?php

namespace Small\CurrencyRates\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use Small\CurrencyRates\Api\CurrencyRateRepositoryInterface;
use Small\CurrencyRates\Api\Data\CurrencyRateInterface;
use Small\Rates\Model\ResourceModel\CurrencyRate;

class CurrencyRateRepository implements CurrencyRateRepositoryInterface
{
    /**
     * @var RecourceCurrencyRate
     */
    protected $resource;
    /**
     * @var CollectionFactory
     */
    protected $currencyRateCollectionFactory;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var CurrentRateFactory
     */
    protected $currencyRateFactory;
    /**
     * @var DataObjectHelper
     */
    protected $searchResultsFactory;
    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;
    /**
     * @var CurrencyRateSearchResultsInterfaceFactory
     */
    protected $searchResultFactory;

    /**
     * @param CurrencyRateRepositoryInterface $currencyRateSearchResultFactory
     * @param RecourceCurrencyRate $resource
     * @param CurrentRateFactory $currencyRateFactory
     * @param CollectionFactory $collectionFactory
     * @param CurrencyRateSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        CurrencyRateRepositoryInterface $currencyRateSearchResultFactory,
        RecourceCurrencyRate $resource,
        CurrentRateFactory $currencyRateFactory,
        CollectionFactory $collectionFactory,
        CurrencyRateSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor
    )
    {
        $this->searchResultFactory = $searchResultsFactory;
        $this->resource = $resource;
        $this->currencyRateFactory = $currencyRateFactory;
        $this->currencyRateCollectionFactory = $collectionFactory;
        $this->searchResultsFactory = $dataObjectHelper;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param CurrencyRateInterface $currencyRate
     * @return CurrencyRateInterface
     * @throws CouldNotSaveException
     */
    public function save(CurrencyRateInterface $currencyRate)
    {
        try{
            $this->resource->save($currencyRate);
        } catch (\Exeption $exception){
            throw new CouldNotSaveException(__(
               'Couldn`t save the currencyRate %1',
               $exception->getMessage()
            ));
        }
        return $currencyRate;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    )
    {
        $collection = $this->currencyRateCollectionFactory->create();

        $this->addFiltersToCollection($criteria, $collection);
        $collection->load();
        return $this->buildSearchResult($criteria, $collection);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return void
     */
    public function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup){
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter)
            {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return mixed
     */
    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $searchResults = $this->searchResultsFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(CurrencyRateInterface $currencyRate)
    {
        try{
            $currencyRateModel = $this->currencyRateFactory->create();
            $this->resource->load($currencyRateModel, $currencyRate->getEntityId());
            $this->resource->delete($currencyRateModel);
        } catch (\Exception $exception){
            throw new CouldNotDeleteException(__(
               'Couldn`t delete the currencyRate: %1',
               $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($entityId)
    {
        return $this->delete($this->get($entityId));
    }

    /**
     * @inheritDoc
     */
    public function get($currencyCode)
    {
        $currencyRateItem = $this->currencyRateFactory->create();
        $this->resource->load($currencyRateItem, $currencyCode, 'currency_to');
        if(!$currencyRateItem->getId()){
            throw new NoSuchEntityException(__(
               'Currency Code does`nt exist.',
               $currencyCode
            ));
        }
        return $currencyRateItem->getDataModel();
    }
}
