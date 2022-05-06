<?php

namespace src\Product\Business\Model;

use ArrayObject;
use src\Shared\TransferObjects\ProductVariantsTransfer;
use stdClass;

class ProductVariantsTransfersBuilder
{
	public function buildProductVariantsTransfers(array $productsPurchasable): ArrayObject
	{
		$productsVariantsTransfers = new ArrayObject();

		foreach($productsPurchasable as $productPurchasable)
		{
			$productsVariantsTransfers->append($this->buildProductVariantsTransfer($productPurchasable));
		}

		return $productsVariantsTransfers;
	}

	private function buildProductVariantsTransfer(stdClass $productPurchasable): ProductVariantsTransfer
	{
		return (new ProductVariantsTransfer())
			->setSku($productPurchasable->sku)
			->setSizeName($productPurchasable->size)
			->setPrice($productPurchasable->price);
	}
}