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
add_action(\D4rk0snet\CoralCustomer\Enum\CoralCustomerActions::NEW_CUSTOMER->value, [\D4rk0snet\CoralCustomer\Action\NewCustomer::class,'doAction'], 10, 1);
add_filter(\D4rk0snet\CoralCustomer\Enum\CoralCustomerFilters::GET_CUSTOMER->value, [\D4rk0snet\CoralCustomer\Filter\GetCustomer::class,'doAction'], 10, 2);
add_filter(\Hyperion\Doctrine\Plugin::ADD_ENTITIES_FILTER, function (array $entityPaths) {
    $entityPaths[] = __DIR__."/src/Entity";

    return $entityPaths;
});