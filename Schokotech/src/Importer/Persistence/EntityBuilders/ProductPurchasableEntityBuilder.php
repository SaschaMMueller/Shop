<?php

namespace src\Importer\Persistence\EntityBuilders;

use src\Shared\Entities\ProductPurchasableEntity;

class ProductPurchasableEntityBuilder
{
	public function buildEntity(
		array $productPurchasable,
		int $fkProductAbstract): ProductPurchasableEntity
	{
		return (new ProductPurchasableEntity())
			->setIdProductPurchasable(null)
			->setFkProductAbstract($fkProductAbstract)
			->setSku($productPurchasable['sku'])
			->setSize($productPurchasable['size'])
			->setPrice($productPurchasable['price'])
			->setStock($productPurchasable['stock']);
	}
}