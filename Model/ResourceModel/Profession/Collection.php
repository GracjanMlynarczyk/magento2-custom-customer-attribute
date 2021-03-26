<?php


namespace Ghratzoo\CustomCustomerAttribute\Model\ResourceModel\Profession;


use Ghratzoo\CustomCustomerAttribute\Api\Data\ProfessionSearchResultInterface;
use Ghratzoo\CustomCustomerAttribute\Model\Profession;
use Ghratzoo\CustomCustomerAttribute\Model\ResourceModel\Profession as ProfessionResource;
use Magento\Framework\Api\Search\SearchCriteriaInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection implements ProfessionSearchResultInterface
{

    /**
     * @var SearchCriteriaInterface
     */
    private ?SearchCriteriaInterface $searchCriteria;


    protected function _construct()
    {
        $this->_init(Profession::class, ProfessionResource::class);
    }


    /**
     * @return SearchCriteriaInterface|null
     */
    public function getSearchCriteria()
    {
        return $this->searchCriteria;
    }

    /**
     * @param SearchCriteriaInterface|null $searchCriteria
     * @return $this
     */
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null)
    {
        $this->searchCriteria = $searchCriteria;
        return $this;
    }


    /**
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * @param $totalCount
     * @return $this
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    public function setItems(array $items): ProfessionSearchResultInterface
    {
        if (!$items) {
            return $this;
        }

        foreach ($items as $item) {
            $this->addItem($item);
        }
        return $this;
    }
}
