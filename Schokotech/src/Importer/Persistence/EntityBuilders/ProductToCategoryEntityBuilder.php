<?php

namespace src\Importer\Persistence\EntityBuilders;

use src\Shared\Entities\ProductToCategoryEntity;
use stdClass;

class ProductToCategoryEntityBuilder
{
	public function buildEntity(stdClass $productToCategory): ProductToCategoryEntity
	{
		return (new ProductToCategoryEntity())
			->setIdProductToCategory(null)
			->setFkProductAbstract($productToCategory->fk_product_abstract)
			->setFkCategory($productToCategory->fk_category)
			->setSortingOrder(0);
	}
}