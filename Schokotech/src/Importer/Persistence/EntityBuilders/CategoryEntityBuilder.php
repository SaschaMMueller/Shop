<?php

namespace src\Importer\Persistence\EntityBuilders;

use src\Shared\Entities\CategoryEntity;
use stdClass;

class CategoryEntityBuilder
{
	public function buildEntity(stdClass $entityData): CategoryEntity
	{
		return (new CategoryEntity)
			->setIdCategory(null)
			->setParent((int)$entityData->parent_category_key )
			->setSortingOrder($entityData->sorting_order)
			->setCategoryKey($entityData->category_key)
			->setIsRoot( $entityData->is_root);
	}
}