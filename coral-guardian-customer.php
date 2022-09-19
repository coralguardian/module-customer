<?php
/**
 * Plugin Name: Adopte un corail / recif = Customer =
 * Plugin URI:
 * Description: Gestion des clients
 * Version: 0.1
 * Requires PHP: 8.1
 * Author: Benoit DELBOE & Grégory COLLIN
 * Author URI:
 * Licence: GPLv2
 */

use D4rk0snet\CoralCustomer\Action\NewCustomer;
use D4rk0snet\CoralCustomer\Enum\CoralCustomerActions;
use D4rk0snet\CoralCustomer\Enum\CoralCustomerFilters;
use D4rk0snet\CoralCustomer\Filter\GetCustomer;
use Hyperion\Doctrine\Plugin;

add_action(CoralCustomerActions::NEW_CUSTOMER->value, [NewCustomer::class,'doAction'], 10, 1);
add_filter(CoralCustomerFilters::GET_CUSTOMER->value, [GetCustomer::class,'doAction'], 10, 2);
add_filter(Plugin::ADD_ENTITIES_FILTER, function (array $entityPaths) {
    $entityPaths[] = __DIR__."/src/Entity";

    return $entityPaths;
});