INSERT INTO url VALUE (20, "contact", "CmsPage/contact");

CREATE TABLE IF NOT EXISTS cms_page(
id_cms_page             int(100) auto_increment primary key,
name                    varchar(100) null,
street                  varchar(100) null,
house_number            varchar(100) null,
postal_code             varchar(100) null,
city                    varchar(100) null,
telephone_number        varchar(255) null,
email                   varchar(100) null
);

INSERT INTO cms_page VALUE (1, "Turbine Kreuzberg GmbH", "Ohlauer Straße", "43", "10999", "Berlin",
"+49 30 28 47 26 40 0", "berlin@turbinekreuzberg.com");

INSERT INTO cms_page VALUE (2, "Turbine Kreuzberg GmbH", "Königstraße", "39", "70173", "Stuttgart",
"+49 711 18 42 69 10", "stuttgart@turbinekreuzberg.com");

INSERT INTO cms_page VALUE (3, "Turbine Kreuzberg GmbH", "Magazingasse", "11", "04109", "Leipzig",
"+49 30 28 47 26 40 0", "leipzig@turbinekreuzberg.com");

INSERT INTO cms_page VALUE (4, "Turbine Kreuzberg GmbH", "Rua Mouzinho de Albuquerque", "1A", "8000-397", "Faro",
"+351 289 820 098", "faro@turbinekreuzberg.com");
