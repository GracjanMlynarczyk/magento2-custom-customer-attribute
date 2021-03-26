<?php

namespace Ghratzoo\CustomCustomerAttribute\Plugin;

use Ghratzoo\CustomCustomerAttribute\Api\ProfessionRepositoryInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\EntityManager\EntityManager;
use Magento\Customer\Api\Data\CustomerExtensionFactory;

class CustomerAddProfessionAttribute
{

    /**
     * @var ProfessionRepositoryInterface
     */
    private ProfessionRepositoryInterface $professionRepository;

    /**
     * @var EntityManager
     */
    private EntityManager $entityManager;

    /**
     * @var CustomerExtensionFactory
     */
    private CustomerExtensionFactory $customerExtension;

    /**
     * CustomerAddProfessionAttribute constructor.
     * @param ProfessionRepositoryInterface $professionRepository
     * @param EntityManager $entityManager
     * @param CustomerExtensionFactory $customerExtension
     */
    public function __construct(
        ProfessionRepositoryInterface $professionRepository,
        EntityManager $entityManager,
        CustomerExtensionFactory $customerExtension
    ) {
        $this->customerExtension = $customerExtension;
        $this->entityManager = $entityManager;
        $this->professionRepository = $professionRepository;
    }


    /**
     * @param CustomerRepositoryInterface $subject
     * @param CustomerInterface $entity
     * @return CustomerInterface
     */
    public function afterGetById(
        CustomerRepositoryInterface $subject,
        CustomerInterface $entity
    ): CustomerInterface {
        $extensionAttributes = $entity->getExtensionAttributes();
        if ($extensionAttributes == null) {
            $extensionAttributes = $this->customerExtension->create();
        }

        $professionAttribute = $this->getProfessionAttribute($entity->getId());
        //$professionAttribute = 'profession';

        $extensionAttributes->setProfession($professionAttribute);
        $entity->setExtensionAttributes($extensionAttributes);

        return $entity;
    }

    /**
     * @param int $customer_id
     * @return string
     */
    private function getProfessionAttribute(int $customer_id): string
    {
        return $this->professionRepository->getForCustomer($customer_id)->getLabel() ?? '';
    }
}
