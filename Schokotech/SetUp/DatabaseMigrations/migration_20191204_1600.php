CREATE TABLE IF NOT EXISTS product_images (
id_product_images 	    int(10) auto_increment primary key,
image_path              varchar(255) null,
fk_product_abstract     int(100) null,
constraint fk_product_abstract_to_product_images foreign key (fk_product_abstract) references product_abstract (product_abstract_id)
);