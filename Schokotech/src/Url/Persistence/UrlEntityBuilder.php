<?php

namespace src\Url\Persistence;

use src\Shared\Entities\UrlEntity;
use src\Shared\Entities\UrlToCategoryEntity;
use src\Shared\Entities\UrlToProductEntity;
use stdClass;

class UrlEntityBuilder
{
	public function buildUrlEntity(stdClass $url): UrlEntity
	{
		return (new UrlEntity())
			->setIdUrl($url->id_url)
			->setUrlSeo($url->url_seo)
			->setUrlSystem($url->url_system);
	}

	public function buildUrlToProductEntity(stdClass $urlToProduct): UrlToProductEntity
	{
		return (new UrlToProductEntity())
			->setIdUrlToProduct($urlToProduct->id_url_to_product)
			->setFkUrl($urlToProduct->fk_url)
			->setFkProductAbstract($urlToProduct->fk_product_abstract);
	}

	public function buildUrlToCategoryEntity(stdClass $urlToCategory): UrlToCategoryEntity
	{
		return (new UrlToCategoryEntity())
			->setIdUrlToCategory($urlToCategory->id_url_to_category)
			->setFkUrl($urlToCategory->fk_url)
			->setFkCategory($urlToCategory->fk_category);
	}
}