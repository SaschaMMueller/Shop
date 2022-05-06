<?php

namespace src\Importer\Business\DataPreparators;

use stdClass;

class ProductUrlDataPreparator
{
	public function prepareUrlData(array $productAbstract, int $fkProductAbstract, stdClass $language): stdClass
	{
		$preparedUrl = new stdClass();

		$urlSeo = str_replace(' ', '-', strtolower($productAbstract['localized_attributes']['name'][$language->name]));
		$urlSystem = 'Product/show/' . $fkProductAbstract;

		$preparedUrl->url_seo = $urlSeo;
		$preparedUrl->url_system = $this->prepareUrlString($urlSystem);
		$preparedUrl->fk_language = $language->id_language;

		return $preparedUrl;
	}

	public function prepareUrlToProductData(int $fkUrl, int $fkProductAbstract): stdClass
	{
		$preparedUrl = new stdClass();

		$preparedUrl->fk_url = $fkUrl;
		$preparedUrl->fk_product_abstract = $fkProductAbstract;

		return $preparedUrl;
	}

	private function prepareUrlString(string $url): string
	{
		return "'" . $url . "'";
	}
}