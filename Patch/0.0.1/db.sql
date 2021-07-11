
ALTER TABLE `bs_orders` CHANGE `amount` `amount` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `price` `price` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `vat` `vat` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `total` `total` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `net` `net` DECIMAL(19,4) NULL DEFAULT NULL;
ALTER TABLE `bs_deliveries` CHANGE `amount` `amount` DECIMAL(19,4) NULL DEFAULT NULL;
ALTER TABLE `bs_quick_orders` CHANGE `amount` `amount` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `price` `price` DECIMAL(19,4) NULL DEFAULT NULL;
ALTER TABLE `bs_delivery_items` CHANGE `size` `size` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `amount` `amount` DECIMAL(19,4) NULL DEFAULT NULL;
ALTER TABLE `bs_stock_prepare` CHANGE `amount` `amount` DECIMAL(19,4) NULL DEFAULT NULL;
ALTER TABLE `bs_stock_items` CHANGE `size` `size` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `amount` `amount` DECIMAL(19,4) NULL DEFAULT NULL;
ALTER TABLE `bs_purchase_spot` CHANGE `amount` `amount` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `rate_spot` `rate_spot` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `rate_pmdc` `rate_pmdc` DECIMAL(19,4) NULL DEFAULT NULL;
ALTER TABLE `bs_purchase_usd` CHANGE `amount` `amount` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `rate_exchange` `rate_exchange` DECIMAL(19,4) NULL DEFAULT NULL;
ALTER TABLE `bs_sales_spot` CHANGE `amount` `amount` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `rate_spot` `rate_spot` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `rate_pmdc` `rate_pmdc` DECIMAL(19,4) NULL DEFAULT NULL;


ALTER TABLE `bs_deliveries` ADD `billing_id` VARCHAR(255) NOT NULL AFTER `comment`, ADD `payment_note` TEXT NOT NULL AFTER `billing_id`, ADD `delivery_time` VARCHAR(255) NOT NULL AFTER `payment_note`, ADD `delivery_method` VARCHAR(255) NOT NULL AFTER `delivery_time`, ADD `emp_safekeeper` INT NOT NULL AFTER `delivery_method`, ADD `emp_requester` INT NOT NULL AFTER `emp_safekeeper`;

ALTER TABLE `bs_deliveries` CHANGE `billing_id` `billing_id` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, CHANGE `delivery_time` `delivery_time` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, CHANGE `delivery_method` `delivery_method` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, CHANGE `payment_note` `payment_note` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL, CHANGE `emp_safekeeper` `emp_safekeeper` INT(11) NULL, CHANGE `emp_requester` `emp_requester` INT(11) NULL;