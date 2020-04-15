<?php

$sql_requests = [];

$sql_requests[] = 'CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'multistore_check
(
    `customer_id` INT(10) NOT NULL PRIMARY KEY,
    `store_id` INT(10) NOT NULL
)
ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8';


$sql_requests[] = 'CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'multistore_employes_list
(
    `store_id` VARCHAR(255)
    `employee_id` INT(10) NOT NULL PRIMARY KEY,
)
ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8';

$sql_requests[] = 'CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'multistore_orders
(
    `address_id` INT(10) NOT NULL
    `order_id` INT(10) NOT NULL PRIMARY KEY,
	`customer_id` INT(10) NOT NULL,
    `store_id` INT(10) NOT NULL,
)
ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8';

$sql_requests[] = 'CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'multistore_contact_store
(
	`information` TEXT
    `store_id` INT(10) NOT NULL PRIMARY KEY,
)
ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8';