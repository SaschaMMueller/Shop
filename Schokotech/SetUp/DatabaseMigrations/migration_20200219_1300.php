CREATE TABLE IF NOT EXISTS product_purchasable(
    id_product_purchasable      int(100) auto_increment primary key,
    sku                         varchar(100) null,
    size                        int(100) null,
    stock                       int(100) null,
    fk_product_abstract         int(100) null,
    constraint fk_product_abstract_to_product_purchasable foreign key (fk_product_abstract) references
    product_abstract(id_product_abstract)
);
ALTER TABLE product_abstract DROP COLUMN attribute;