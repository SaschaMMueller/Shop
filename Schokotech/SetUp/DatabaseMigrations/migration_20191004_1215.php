CREATE TABLE IF NOT EXISTS category(
    id            int(100) auto_increment primary key,
    parent        int(100) null,
    sorting_order int(100) null,
    is_root bool default false not null
);
CREATE TABLE IF NOT EXISTS product_abstract(
    id        int(100) auto_increment primary key,
    sku       int(100)     null,
    attribute varchar(100) null
);
CREATE TABLE IF NOT EXISTS product_to_category(
    id                  int(100) auto_increment primary key,
    sorting_order       int(100) null,
    fk_category         int(100) null,
    fk_product_abstract int(100) null,
    constraint fk_category_to_product_to_category foreign key (fk_category) references category (id),
    constraint fk_product_abstract_to_product_to_category foreign key (fk_product_abstract) references product_abstract (id)
);
CREATE TABLE IF NOT EXISTS price_type(
    id   int(100) auto_increment primary key,
    name varchar(100) null
);
CREATE TABLE IF NOT EXISTS product_price(
    id    int(100) auto_increment primary key,
    value int(100) null,
    fk_price_type int(100) null,
    constraint fk_price_type_to_product_price foreign key (fk_price_type) references price_type (id)
);
CREATE TABLE IF NOT EXISTS product_purchasable(
    id   int(100) auto_increment primary key,
    sku  int(100) null,
    size int(100) null,
    fk_product_abstract int(100) null,
    fk_product_price int(100) null,
    constraint fk_product_abstract_to_product_purchasable foreign key (fk_product_abstract) references product_abstract (id),
    constraint fk_product_price_to_product_purchasable foreign key (fk_product_price) references product_price (id)
);
CREATE TABLE IF NOT EXISTS language(
    id          int(100) auto_increment primary key,
    name        varchar(100) null
);
CREATE TABLE IF NOT EXISTS category_localized_attribute(
    id          int(100) auto_increment primary key,
    name        varchar(100) null,
    description varchar(100) null,
    fk_category int(100) null,
    fk_language int(100) null,
    constraint fk_category_to_localized_attribute foreign key (fk_category) references category (id),
    constraint fk_language_to_category_localized_attribute foreign key (fk_language) references language (id)
);
CREATE TABLE IF NOT EXISTS product_localized_attribute(
    id          int(100) auto_increment primary key,
    name        varchar(100) null,
    description varchar(100) null,
    fk_product_abstract int(100) null,
    fk_language int(100) null,
    constraint fk_product_abstract_to_localized_attribute foreign key (fk_product_abstract) references product_abstract (id),
    constraint fk_language_to_product_localized_attribute foreign key (fk_language) references language (id)
)