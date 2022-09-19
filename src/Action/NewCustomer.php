<?php

namespace D4rk0snet\CoralCustomer\Action;

use D4rk0snet\CoralCustomer\Entity\CompanyCustomerEntity;
use D4rk0snet\CoralCustomer\Entity\CustomerEntity;
use D4rk0snet\CoralCustomer\Enum\CustomerType;
use D4rk0snet\CoralCustomer\Model\CustomerModel;
use Exception;
use Hyperion\Doctrine\Service\DoctrineService;

/**
 * Gère l'évènement Create customer
 * Si le client existe déjà en base de donnée, ne fait rien.
 * Dans le cas contraire : création du client.
 * La clef unique est l'email.
 */
class NewCustomer
{
    /**
     * @throws Exception
     */
    public static function doAction(CustomerModel $customerModel): void
    {
        $em = DoctrineService::getEntityManager();
        if($customerModel->getCustomerType() === CustomerType::INDIVIDUAL) {
            $customer = $em
                ->getRepository(CustomerEntity::class)
                ->findOneBy(['email' => $customerModel->getEmail()]);
            if ($customer === null) {
                $customer = new CustomerEntity(
                    address: $customerModel->getAddress(),
                    city: $customerModel->getCity(),
                    country: $customerModel->getCountry(),
                    email: $customerModel->getEmail(),
                    postalCode: $customerModel->getPostalCode(),
                    firstname: $customerModel->getFirstname(),
                    lastname: $customerModel->getLastname()
                );

                $em->persist($customer);
                $em->flush();
            }
        }
        elseif ($customerModel->getCustomerType() === CustomerType::COMPANY) {
            $customer = $em
                ->getRepository(CompanyCustomerEntity::class)
                ->findOneBy(['email' => $customerModel->getEmail()]);
            if ($customer === null) {
                $customer = new CompanyCustomerEntity(
                    companyName: $customerModel->getCompanyName(),
                    address: $customerModel->getAddress(),
                    postalCode: $customerModel->getPostalCode(),
                    city: $customerModel->getCity(),
                    country: $customerModel->getCountry(),
                    email: $customerModel->getEmail(),
                    firstname: $customerModel->getFirstname(),
                    lastname: $customerModel->getLastname()
                );

                $em->persist($customer);
                $em->flush();
            }
        }
    }
}