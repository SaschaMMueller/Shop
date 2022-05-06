ALTER TABLE category_localized_attributes DROP FOREIGN KEY fk_language_to_category_localized_attribute;
ALTER TABLE product_localized_attributes DROP FOREIGN KEY fk_language_to_product_localized_attribute;
ALTER TABLE product_price DROP FOREIGN KEY fk_price_type_to_product_price;

DROP TABLE price_type;
DROP TABLE product_purchasable;
DROP TABLE product_price;