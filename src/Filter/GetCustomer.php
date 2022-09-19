<?php

namespace D4rk0snet\CoralCustomer\Filter;

use D4rk0snet\CoralCustomer\Entity\CompanyCustomerEntity;
use D4rk0snet\CoralCustomer\Entity\CustomerEntity;
use D4rk0snet\CoralCustomer\Enum\CustomerType;
use Exception;
use Hyperion\Doctrine\Service\DoctrineService;
use InvalidArgumentException;

class GetCustomer
{
    /**
     * @throws Exception
     */
    public static function doAction(
        $customer,
        string $email,
        CustomerType $type
    ) : CustomerEntity | CompanyCustomerEntity | null
    {
        $em = DoctrineService::getEntityManager();
        if($type === CustomerType::COMPANY) {
            return $em->getRepository(CompanyCustomerEntity::class)->findOneBy(['email' => $email]);
        }

        if($type === CustomerType::INDIVIDUAL) {
            return $em->getRepository(CustomerEntity::class)->findOneBy(['email' => $email]);
        }

        throw new InvalidArgumentException("Unknow customer type : ".$type->value);
    }
}