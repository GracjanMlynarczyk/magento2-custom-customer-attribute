<?php


namespace Ghratzoo\CustomCustomerAttribute\Model;


use Ghratzoo\CustomCustomerAttribute\Api\Data\ProfessionInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Profession
 * @package Ghratzoo\CustomCustomerAttribute\Model
 */
class Profession extends AbstractModel implements ProfessionInterface
{

    const PROFESSION_ID = 'profession_id';
    const LABEL = 'label';
    const CUSTOMER_ID = 'customer_id';


    public function _construct()
    {
        $this->_init(ResourceModel\Profession::class);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->getData(self::PROFESSION_ID);
    }

    /**
     * @param mixed $value
     */
    public function setId($value): void
    {
        $this->setData(self::PROFESSION_ID, $value);
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->getData(self::LABEL);
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->setData(self::LABEL, $label);
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return (int) $this->getData(self::CUSTOMER_ID);
    }

    /**
     * @param int $customer_id
     */
    public function setCustomerId(int $customer_id): void
    {
        $this->setData(self::CUSTOMER_ID, $customer_id);
    }

}
