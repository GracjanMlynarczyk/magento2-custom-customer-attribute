<?php


namespace Ghratzoo\CustomCustomerAttribute\Setup\Patch\Data;


use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Model\Config;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CustomerAttributePatcher implements DataPatchInterface
{

    /**
     * @var ModuleDataSetupInterface
     */
    private ModuleDataSetupInterface $setup;

    /**
     * @var Config
     */
    private Config $config;

    /**
     * @var CustomerSetupFactory
     */
    private CustomerSetupFactory $customerSetupFactory;

    /**
     * CustomerAttributePatcher constructor.
     * @param ModuleDataSetupInterface $setup
     * @param Config $config
     * @param CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $setup,
        Config $config,
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->config = $config;
        $this->setup = $setup;
        $this->customerSetupFactory = $customerSetupFactory;
    }


    /**
     * @return string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return string[]
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @return $this
     */
    public function apply()
    {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->setup]);
        $customerEntity = $customerSetup->getEavConfig()->getEntityType(Customer::ENTITY);
        $attributeSetId = $customerSetup->getDefaultAttributeSetId($customerEntity->getEntityTypeId());
        $attributeGroup = $customerSetup->getDefaultAttributeGroupId($customerEntity->getEntityTypeId(), $attributeSetId);
        $customerSetup->addAttribute(Customer::ENTITY, 'coffee_favorite', [
            'type' => 'varchar',
            'input' => 'text',
            'label' => 'Favorite Coffee',
            'required' => false,
            'visible' => true,
            'user_defined' => true,
            'system' => false,
            'is_visible_in_grid' => true,
            'is_used_in_grid' => true,
            'is_filterable_in_grid' => true,
            'is_searchable_in_grid' => true,
            'position' => 300
        ]);
        $newAttribute = $this->config->getAttribute(Customer::ENTITY, 'coffee_favorite');
        $newAttribute->addData([
            'used_in_forms' => ['adminhtml_checkout','adminhtml_customer','customer_account_edit','customer_account_create'],
            'attribute_set_id' => $attributeSetId,
            'attribute_group_id' => $attributeGroup
        ]);
        $newAttribute->save();
    }
}
