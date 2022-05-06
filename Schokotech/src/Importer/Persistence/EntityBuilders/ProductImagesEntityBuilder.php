<?php

namespace src\Importer\Persistence\EntityBuilders;

use src\Shared\Entities\ProductImagesEntity;

class ProductImagesEntityBuilder
{
	public function buildEntity(array $productAbstract, int $fkProductAbstract): ProductImagesEntity
	{
		return (new ProductImagesEntity())
			->setIdProductImages(null)
			->setFkProductAbstract($fkProductAbstract)
			->setImagePath($productAbstract['attributes']['imagePath']);
	}
}