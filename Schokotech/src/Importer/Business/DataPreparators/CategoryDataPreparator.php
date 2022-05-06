<?php

namespace src\Importer\Business\DataPreparators;

use stdClass;

class CategoryDataPreparator
{
	public function prepareData(string $jsonArray): array
	{
		$entityCollection = [];
		$entitiesData = json_decode($jsonArray);

		foreach($entitiesData as $entityData)
		{
			$preparedEntityData = new stdClass();
			$preparedEntityData->parent_category_key = (int)$entityData->parent_category_key;
			$preparedEntityData->sorting_order = 0;
			$preparedEntityData->category_key = $entityData->category_key;
			$preparedEntityData->is_root = $entityData->is_root;
			$entityCollection[] = $preparedEntityData;
		}

		return $entityCollection;
	}
}