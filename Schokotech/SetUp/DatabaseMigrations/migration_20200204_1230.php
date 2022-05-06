CREATE TABLE IF NOT EXISTS url_to_category(
id_url_to_category   int(100) auto_increment primary key,
fk_url int(100) null,
fk_category int(100) null,
constraint fk_url_to_url_to_category foreign key (fk_url) references url (id_url),
constraint fk_category_to_url_to_category foreign key (fk_category) references category (id_category)
);
