<?php

namespace src\Product\Business\Model;

use ArrayObject;
use src\Shared\TransferObjects\BreadcrumbTransfer;
use stdClass;

class BreadcrumbTransferBuilder
{
	public function buildBreadcrumbTransfers(int $fkCategory, array $breadcrumbs): ArrayObject
	{
		$breadcrumbsCollection = new ArrayObject();
		$preparedData = [];
		$preparedData = $this->prepareBreadcrumb($fkCategory, $breadcrumbs, $preparedData);

		foreach($preparedData as $data)
		{
			$breadcrumbsCollection->append($this->buildBreadcrumbTransfer($data));
		}

		return $breadcrumbsCollection;
	}

	private function prepareBreadcrumb(?int $fkCategory, array $breadcrumbs, array $preparedData): array
	{
		foreach($breadcrumbs as $breadcrumb)
		{
			if($breadcrumb->id_category == $fkCategory)
			{
				$preparedData = $this->prepareBreadcrumb($breadcrumb->parent, $breadcrumbs, $preparedData);
				array_push($preparedData, $breadcrumb);
			}
		}

		return $preparedData;
	}

	private function buildBreadcrumbTransfer(stdClass $breadcrumb): BreadcrumbTransfer
	{
		return (new BreadcrumbTransfer())
			->setName($breadcrumb->name)
			->setUrl($breadcrumb->url_seo);
	}
}