<?php

namespace Small\Rates\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Tests\NamingConvention\true\mixed;
use Magento\Tests\NamingConvention\true\string;
use Small\CurrencyRates\Api\Data\CurrencyRateInterface;
use Small\CurrencyRates\Api\Data\CurrencyRateInterfaceFactory;

class CurrencyRate extends AbstractModel implements CurrencyRateInterface
{
    /**
     * @var CurrencyRateInterfaceFactory
     */
    protected $currencyRateFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @param Context $context
     * @param \Magento\Framework\Registry $registry
     * @param CurrencyRateInterfaceFactory $currencyRateFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param ResourceModel\CurrencyRate|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context                                       $context,
        \Magento\Framework\Registry                   $registry,
        CurrencRateInterfaceFactory                   $currencyRateFactory,
        DataObjectHelper                              $dataObjectHelper,
        ResourceModel\CurrencyRate                    $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array                                         $data =[])
    {
        $this->dataObjectHelper =$dataObjectHelper;
        $this->currencyRateFactory = $currencyRateFactory;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * @return mixed
     */
    public function getDataModel()
    {
        $currencyRateData = $this->getData();

        $currencyRateDataObject->$this->currencyRateFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $currencyRateDataObject,
            $currencyRateData,
            CurrencyRateInterface::class
        );
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Small\CurrencyRates\Model\ResourceModel\CurrencyRate::class);
    }

    /**
     * @return array|mixed|null
     */
    public function getCurrencyFrom()
    {
        return $this->getData(self::CURRENCY_FROM);
    }

    /**
     * @param string $currency
     * @return mixed|CurrencyRate
     */
    public function setCurrencyFrom(string $currency)
    {
        return $this->setData(self::CURRENCY_FROM, $currency);
    }

    /**
     * @return array|mixed|null
     */
    public function getCurrencyTo()
    {
        return $this->getData(self::CURRENCY_TO);
    }

    /**
     * @param string $currency
     * @return mixed|CurrencyRate
     */
    public function setCurrencyTo(string $currency)
    {
        return  $this->setData(self::CURRENCY_TO, $currency);
    }

    /**
     * @return array|mixed|null
     */
    public function getCostPriceCurrencyRate()
    {
        return $this->getData(self::COST_PRICE_RATE);
    }

    /**
     * @param string $currency
     * @return mixed|CurrencyRate
     */
    public function setCostPriceCurrencyRate(string $currency)
    {
        return $this->setData(self::COST_PRICE_RATE, $currency);
    }

    /**
     * @return array|mixed|null
     */
    public function getPriceMatrixCurrencyRate()
    {
        return $this->getData(self::PRICE_MATRIX_RATE);
    }

    /**
     * @param string $currency
     * @return mixed|CurrencyRate
     */
    public function setPriceMatrixCurrencyRate(string $currency)
    {
        return $this->setData(self::PRICE_MATRIX_RATE, $currency);
    }
}
