<?php


namespace Ghratzoo\CustomCustomerAttribute\Plugin;


use Magento\Customer\Api\Data\CustomerExtensionFactory;
use Magento\Customer\Api\Data\CustomerExtensionInterface;
use Magento\Customer\Api\Data\CustomerInterface;

class CustomerGetByIdPlugin
{

    /**
     * @var CustomerExtensionFactory
     */
    private CustomerExtensionFactory $extensionFactory;

    /**
     * CustomerGetByIdPlugin constructor.
     * @param CustomerExtensionFactory $extension
     */
    public function __construct(
        CustomerExtensionFactory $extension
    ) {
        $this->extensionFactory = $extension;
    }


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
