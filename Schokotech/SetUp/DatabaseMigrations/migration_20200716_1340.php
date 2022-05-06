ALTER TABLE category ADD category_key int(100) null AFTER sorting_order;
UPDATE url SET url_seo ='schokoladen' WHERE url_seo = 'category';
ALTER TABLE url ADD fk_language int(100) null,
ADD constraint url_language_id_language_fk foreign key (fk_language) references language (id_language) ON DELETE SET null;