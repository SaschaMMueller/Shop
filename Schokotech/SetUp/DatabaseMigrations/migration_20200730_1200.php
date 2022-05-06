CREATE TABLE IF NOT EXISTS payment_method(
id_payment_method            int(100) auto_increment primary key,
fee        float
);
CREATE TABLE IF NOT EXISTS payment_method_localized_attribute(
id_payment_method_localized_attribute          int(100) auto_increment primary key,
fk_payment_method int(100) null,
name        varchar(1000) null,
description varchar(1000) null,
fk_language int(100) null,
constraint fk_payment_to_payment_localized_attribute foreign key (fk_payment_method) references payment_method (id_payment_method),
constraint fk_language_to_payment_localized_attribute foreign key (fk_language) references language (id_language)
);