<?php


namespace Ghratzoo\CustomCustomerAttribute\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Profession
 * @package Ghratzoo\CustomCustomerAttribute\Model\ResourceModel
 */
class Profession extends AbstractDb
{

    /**
     *
     */
    protected function _construct()
    {
        $this->_init('customer_profession_attribute', 'profession_id');
    }
}
