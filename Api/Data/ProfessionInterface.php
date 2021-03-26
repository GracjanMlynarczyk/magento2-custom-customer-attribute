<?php


namespace Ghratzoo\CustomCustomerAttribute\Api\Data;

/**
 * Interface ProfessionInterface
 * @package Ghratzoo\CustomCustomerAttribute\Api\Data
 * @api
 */
interface ProfessionInterface
{

    /**
     * @param $value
     */
    public function setId($value): void;

    /**
     * @param string $label
     */
    public function setLabel(string $label): void;

    /**
     * @param int $customer_id
     */
    public function setCustomerId(int $customer_id): void;

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string|null
     */
    public function getLabel(): ?string;

    /**
     * @return int
     */
    public function getCustomerId(): int;

}
