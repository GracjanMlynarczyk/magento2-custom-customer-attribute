<?php


namespace Ghratzoo\CustomCustomerAttribute\Api\Data;

/**
 * Interface ProfessionSearchResultInterface
 * @package Ghratzoo\CustomCustomerAttribute\Api\Data
 * @api
 */
interface ProfessionSearchResultInterface
{

    /**
     * @return ProfessionInterface[]
     */
    public function getItems();

    /**
     * @param ProfessionInterface[] $items
     * @return ProfessionSearchResultInterface
     */
    public function setItems(array $items): ProfessionSearchResultInterface;

}
