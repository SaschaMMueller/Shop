<?php

namespace src\Importer\Business\Importers\Product;

use src\Importer\Persistence\EntityBuilders\ProductPurchasableEntityBuilder;

class ProductPurchasableImporter
{
	private ProductPurchasableEntityBuilder $productPurchasableEntityBuilder;

	public function __construct(ProductPurchasableEntityBuilder $productPurchasableEntityBuilder)
	{
		$this->productPurchasableEntityBuilder = $productPurchasableEntityBuilder;
	}

	public function import(array $productPurchasableCollection, int $fkProductAbstract): void
	{
		foreach($productPurchasableCollection as $productPurchasable)
		{
			$entity = $this->productPurchasableEntityBuilder->buildEntity($productPurchasable, $fkProductAbstract);
			$entity->save();
		}
	}
}