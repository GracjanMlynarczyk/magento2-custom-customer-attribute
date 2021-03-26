<?php


namespace Ghratzoo\CustomCustomerAttribute\Api;


use Ghratzoo\CustomCustomerAttribute\Api\Data\ProfessionInterface;
use Ghratzoo\CustomCustomerAttribute\Api\Data\ProfessionSearchResultInterface;
use Magento\Framework\Api\Search\SearchCriteriaInterface;

/**
 * Interface ProfessionRepositoryInterface
 * @package Ghratzoo\CustomCustomerAttribute\Api
 * @api
 */
interface ProfessionRepositoryInterface
{
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return ProfessionSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): ProfessionSearchResultInterface;

    /**
     * @param int $profession_id
     * @return ProfessionInterface
     */
    public function get(int $profession_id): ProfessionInterface;

    /**
     * @param int $customer_id
     * @return ProfessionInterface
     */
    public function getForCustomer(int $customer_id): ProfessionInterface;
}
