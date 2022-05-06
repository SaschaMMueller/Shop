<?php

namespace src\Product\Business\Model;

use ArrayObject;
use src\Shared\TransferObjects\ProductTransfer;
use src\Shared\TransferObjects\UrlTransfer;
use stdClass;

class ProductTransferBuilder
{
	public function buildProductTransfer(stdClass $productLocalizedAttributes,
										 stdClass $generalProductData,
										 UrlTransfer $url,
										 ArrayObject $productVariantsTransfers,
										 ArrayObject $breadcrumbs): ProductTransfer
	{
		return (new ProductTransfer())
			->setName($productLocalizedAttributes->name)
			->setDescription($productLocalizedAttributes->description)
			->setImagePath($generalProductData->image_path)
			->setFkCategory($generalProductData->fk_category)
			->setUrl($url->getSeoUrl())
			->setProductVariantsTransfers($productVariantsTransfers)
			->setBreadcrumbs($breadcrumbs);
	}
}