<?php


namespace Ghratzoo\CustomCustomerAttribute\Service;


use Ghratzoo\CustomCustomerAttribute\Api\Data\ProfessionInterface;
use Ghratzoo\CustomCustomerAttribute\Api\Data\ProfessionSearchResultInterface;
use Ghratzoo\CustomCustomerAttribute\Api\ProfessionRepositoryInterface;

use Ghratzoo\CustomCustomerAttribute\Model\Profession;
use Ghratzoo\CustomCustomerAttribute\Model\ProfessionFactory;
use Ghratzoo\CustomCustomerAttribute\Model\ResourceModel\Profession as ProfessionResource;
use Ghratzoo\CustomCustomerAttribute\Model\ResourceModel\Profession\CollectionFactory;
use Magento\Framework\Api\Search\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;

class ProfessionRepository implements ProfessionRepositoryInterface
{

    /**
     * @var ProfessionResource
     */
    private ProfessionResource $professionResource;

    /**
     * @var ProfessionFactory
     */
    private ProfessionFactory $profession;

    /**
     * @var CollectionProcessorInterface
     */
    private CollectionProcessorInterface $collectionProcessor;

    /**
     * @var SearchResultsInterfaceFactory
     */
    private SearchResultsInterfaceFactory $searchResult;

    /**
     * @var CollectionFactory
     */
    private CollectionFactory $collectionFactory;

    /**
     * ProfessionRepository constructor.
     * @param ProfessionResource $professionResource
     * @param ProfessionFactory $profession
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchResultsInterfaceFactory $searchResult
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        ProfessionResource $professionResource,
        ProfessionFactory $profession,
        CollectionProcessorInterface $collectionProcessor,
        SearchResultsInterfaceFactory $searchResult,
        CollectionFactory $collectionFactory
    ) {
        $this->professionResource = $professionResource;
        $this->profession = $profession;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResult = $searchResult;
        $this->collectionFactory = $collectionFactory;
    }


    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return ProfessionSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): ProfessionSearchResultInterface
    {
        $searchResult = $this->searchResult->create();
        $searchResult->setSearchCriteria($searchCriteria);

        $this->collectionProcessor->process($searchCriteria, $searchResult);

        return $searchResult;
    }

    /**
     * @param int $profession_id
     * @return ProfessionInterface
     */
    public function get(int $profession_id): ProfessionInterface
    {
        $object = $this->profession->create();
        $this->professionResource->load($object, $profession_id);
        return $object;
    }

    /**
     * @param int $customer_id
     * @return ProfessionInterface
     */
    public function getForCustomer(int $customer_id): ProfessionInterface
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('customer_id', $customer_id);

        /** @var Profession $firstItem */
        $firstItem = $collection->getFirstItem();

        return $firstItem;
    }
}
