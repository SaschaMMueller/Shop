<?php

namespace src\Importer\Persistence\EntityBuilders;

use src\Shared\Entities\UrlToProductEntity;
use stdClass;

class UrlToProductEntityBuilder
{
	public function buildEntity(stdClass $urlToCategory): UrlToProductEntity
	{
		return (new UrlToProductEntity())
			->setIdUrlToProduct(null)
			->setFkProductAbstract($urlToCategory->fk_product_abstract)
			->setFkUrl($urlToCategory->fk_url);
	}
}