<?php

namespace D4rk0snet\CoralCustomer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="customer_company")
 */
class CompanyCustomerEntity extends CustomerEntity
{
    /**
     * @ORM\Column(type="string")
     */
    private string $companyName;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private string $siret;

    public function __construct(
        string $companyName,
        string $address,
        string $postalCode,
        string $city,
        string $country,
        string $email,
        string $firstname,
        string $lastname,
        ?string $siret
    )
    {
        parent::__construct(
            address: $address,
            city: $city,
            country: $country,
            email: $email,
            postalCode: $postalCode,
            firstname: $firstname,
            lastname: $lastname
        );
        $this->companyName = $companyName;
        $this->siret =$siret;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): CompanyCustomerEntity
    {
        $this->companyName = $companyName;
        return $this;
    }

    public function getMainContactName(): string
    {
        return $this->getFirstname() . " " . $this->getLastname();
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }
}
