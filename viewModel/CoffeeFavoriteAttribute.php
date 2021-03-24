<?php


namespace Ghratzoo\CustomCustomerAttribute\viewModel;


use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class CoffeeFavoriteAttribute implements ArgumentInterface
{

    /**
     * @var CustomerRepositoryInterface
     */
    private CustomerRepositoryInterface $customerRepository;

    /**
     * @var Session
     */
    private Session $session;

    /**
     * CoffeeFavoriteAttribute constructor.
     * @param CustomerRepositoryInterface $customerRepository
     * @param Session $session
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        Session $session
    ) {
        $this->customerRepository = $customerRepository;
        $this->session = $session;
    }

    /**
     * @return string
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getCoffeeAttribute(): string
    {
        $default = "";
        if ($this->session->isLoggedIn()) {
            $customerSession = $this->session->getCustomer();
            $customer = $this->customerRepository->getById($customerSession->getId());
            $attribute = $customer->getCustomAttribute('coffee_favorite');
            if ($attribute) {
                $default = $attribute->getValue();
            }
        }
        return $default;
    }
}
