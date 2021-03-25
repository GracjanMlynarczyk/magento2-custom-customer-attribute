<?php


namespace Ghratzoo\CustomCustomerAttribute\Plugin;


use Magento\Customer\Api\Data\CustomerExtension;
use Magento\Customer\Api\Data\CustomerExtensionFactory;
use Magento\Customer\Api\Data\CustomerExtensionInterface;
use Magento\Customer\Api\Data\CustomerInterface;

/**
 * Class CustomerGetExtensionAttributePlugin
 * @package Ghratzoo\CustomCustomerAttribute\Plugin
 */
class CustomerGetExtensionAttributePlugin
{

    /**
     * @var CustomerExtensionFactory|null
     */
    private ?CustomerExtensionFactory $extensionFactory;

    /**
     * CustomerGetExtensionAttributePlugin constructor.
     * @param CustomerExtensionFactory|null $extension
     */
    public function __construct(
        ?CustomerExtensionFactory $extension = null
    ) {
        $this->extensionFactory = $extension;
    }


    /**
     * @param CustomerInterface $customer
     * @param CustomerExtensionInterface $customerExtension
     * @return CustomerExtension|CustomerExtensionInterface
     */
    public function afterGetExtensionAttributes(
        CustomerInterface $customer,
        CustomerExtensionInterface $customerExtension
    ) {
        if ($customerExtension == null) {
            $customerExtension = $this->extensionFactory->create();
        }
        $default = '';
        $attribute = $customer->getCustomAttribute('coffee_favorite');
        if ($attribute) {
            $default = $attribute->getValue();
        }
        $customerExtension->setCoffeeFavorite($default);

        return $customerExtension;
    }

}
