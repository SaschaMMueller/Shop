<?php

namespace src\Importer\Business\DataPreparators;

use src\Importer\ImporterConstants;
use stdClass;

class ProductDataPreparator
{
	public function prepareProductJsonData(array $jsonArray): array
	{
		$products = [];
		$productDataCollection = [];

		foreach($jsonArray as $jsonData)
		{
			$productDataCollection[array_search($jsonData, $jsonArray)] = json_decode($jsonData);
		}

		foreach($productDataCollection[ImporterConstants::PRODUCT_ATTRIBUTES] as $product)
		{
			$products[] = [
				'abstract' => $this->prepareProductAbstractData($product, $productDataCollection),
				'purchasable' => $this->prepareProductPurchasableData($product, $productDataCollection),
			];
		}

		return $products;
	}

	private function prepareProductAbstractData(stdClass $product, array $productDataCollection): array
	{
		return [
			'attributes' => $this->prepareProductAbstractAttributesData($product),
			'localized_attributes' => $this->prepareProductAbstractLocalizedAttributesData($product, $productDataCollection[ImporterConstants::PRODUCT_LOCALIZED_ATTRIBUTES]),
		];
	}

	private function prepareProductPurchasableData(stdClass $product, array $productDataCollection): array
	{
		$productPurchasableAttributes = [];
		$productPurchasableCollection = json_decode($product->prices);

		foreach($productPurchasableCollection as $productPurchasable)
		{
			$productPurchasableAttributes[] =
				$this->prepareProductPurchasableAttributesData($product, $productPurchasable, $productDataCollection);
		}

		return $productPurchasableAttributes;
	}

	private function prepareProductAbstractAttributesData(stdClass $product): array
	{
		return [
			'sku' => "'" . $product->sku . "'",
			'imagePath' => "'" . $product->image . "'",
			'fkCategory' => $product->category_key,
		];
	}

	private function prepareProductAbstractLocalizedAttributesData(stdClass $product, array $productLocalizedAttributeCollection): array
	{
		foreach($productLocalizedAttributeCollection as $localizedAttribute)
		{
			if($product->sku == $localizedAttribute->sku)
			{
				return [
					'name' => [
						'de' => "'" . $localizedAttribute->name_de . "'",
						'en' => "'" . $localizedAttribute->name_en . "'",
					],
					'description' => [
						'de' => "'" . $localizedAttribute->description_de . "'",
						'en' => "'" . $localizedAttribute->description_en . "'",
					],
					'attributes' => $this->prepareAttributesData($localizedAttribute)
				];
			}
		}

		return [];
	}

	private function prepareAttributesData(stdClass $localizedAttribute): array
	{
		$attributes = call_user_func_array('array_merge' ,json_decode($localizedAttribute->attributes, true)['ingredients']);

		$attributesDE = ['Inhaltsstoffe:'];
		$attributesEN = ['ingredients:'];

		foreach($attributes['de'] as $attribute)
		{
			$attributesDE[] = $attribute;
		}

		foreach($attributes['en'] as $attribute)
		{
			$attributesEN[] = $attribute;
		}

		return [
			'de' => "'" . json_encode($attributesDE) . "'",
			'en' => "'" . json_encode($attributesEN) . "'",
		];
	}

	private function prepareProductPurchasableAttributesData(
		stdClass $product,
		stdClass $productPurchasable,
		array $productDataCollection): array
	{
		$productPurchasableSku = $product->sku . '_' . $productPurchasable->size_id;
		$productSku = 0;
		$productStockCollection = $productDataCollection[ImporterConstants::PRODUCT_STOCK];

		foreach($productStockCollection as $productStock)
		{
			if($productStock->sku == $productPurchasableSku)
			{
				$productSku = $productStock->stock;
			}
		}

		return [
			'sku' => "'" . $productPurchasableSku . "'",
			'size' => $productPurchasable->size,
			'price' => $productPurchasable->price,
			'stock' => $productSku,
		];
	}
}