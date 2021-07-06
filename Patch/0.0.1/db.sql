
ALTER TABLE `bs_orders` CHANGE `amount` `amount` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `price` `price` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `vat` `vat` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `total` `total` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `net` `net` DECIMAL(19,4) NULL DEFAULT NULL;
ALTER TABLE `bs_deliveries` CHANGE `amount` `amount` DECIMAL(19,4) NULL DEFAULT NULL;
ALTER TABLE `bs_quick_orders` CHANGE `amount` `amount` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `price` `price` DECIMAL(19,4) NULL DEFAULT NULL;
ALTER TABLE `bs_delivery_items` CHANGE `size` `size` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `amount` `amount` DECIMAL(19,4) NULL DEFAULT NULL;
ALTER TABLE `bs_stock_prepare` CHANGE `amount` `amount` DECIMAL(19,4) NULL DEFAULT NULL;
ALTER TABLE `bs_stock_items` CHANGE `size` `size` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `amount` `amount` DECIMAL(19,4) NULL DEFAULT NULL;
ALTER TABLE `bs_purchase_spot` CHANGE `amount` `amount` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `rate_spot` `rate_spot` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `rate_pmdc` `rate_pmdc` DECIMAL(19,4) NULL DEFAULT NULL;
ALTER TABLE `bs_purchase_usd` CHANGE `amount` `amount` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `rate_exchange` `rate_exchange` DECIMAL(19,4) NULL DEFAULT NULL;
ALTER TABLE `bs_sales_spot` CHANGE `amount` `amount` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `rate_spot` `rate_spot` DECIMAL(19,4) NULL DEFAULT NULL, CHANGE `rate_pmdc` `rate_pmdc` DECIMAL(19,4) NULL DEFAULT NULL;



