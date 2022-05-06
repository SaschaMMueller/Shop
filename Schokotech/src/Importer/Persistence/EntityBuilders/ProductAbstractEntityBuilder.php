<?php

namespace src\Importer\Persistence\EntityBuilders;

use src\Shared\Entities\ProductAbstractEntity;

class ProductAbstractEntityBuilder
{
	public function buildEntity(array $productAbstract): ProductAbstractEntity
	{
		return (new ProductAbstractEntity())
			->setIdProductAbstract(null)
			->setSku($productAbstract['attributes']['sku']);
	}
}