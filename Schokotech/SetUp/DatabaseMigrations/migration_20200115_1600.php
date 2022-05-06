CREATE TABLE IF NOT EXISTS url_to_product(
id_url_to_product   int(100) auto_increment primary key,
fk_url int(100) null,
fk_product_abstract int(100) null,
constraint fk_url_to_url_to_product foreign key (fk_url) references url (id_url),
constraint fk_product_abstract_to_url_to_product foreign key (fk_product_abstract) references product_abstract (id_product_abstract)
);