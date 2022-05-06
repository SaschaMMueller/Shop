<?php

namespace src\Importer\Business\DataPreparators;

use stdClass;

class CategoryUrlDataPreparator
{
	public function prepareData(string $jsonArray, string $languageKey, array $localizedCategories): array
	{
		$entityCollection = [];
		$entitiesData = json_decode($jsonArray);

		foreach($entitiesData as $entityData)
		{
			$languageName = "null";
			if($languageKey == 1)
			{
				$languageName = $entityData->name_de;
			}
			elseif($languageKey == 2)
			{
				$languageName = $entityData->name_en;
			}

			$preparedEntityData = new stdClass();
			$preparedEntityData->url_seo =  "'" . str_replace(' ', '-', strtolower($languageName)) . "'";

			$preparedEntityData->url_system = $entityData->is_root === '1' ?
				"'Category/list'" :
				"'" . 'Category/show/' . $this->getCategoryKey($languageName, $localizedCategories) . "'";

			$preparedEntityData->fk_language = $languageKey;
			$entityCollection[] = $preparedEntityData;
		}

		return $entityCollection;
	}

	private function getCategoryKey(string $categoryName, array $localizedCategories): ?int
	{
		foreach($localizedCategories as $category)
		{
			if($category['name'] === $categoryName)
			{
				$categoryKey = $category['fk_category'];
			}
		}

		return $categoryKey;
	}
}
