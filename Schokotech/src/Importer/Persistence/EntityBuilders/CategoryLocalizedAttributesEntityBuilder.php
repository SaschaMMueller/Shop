<?php

namespace src\Importer\Persistence\EntityBuilders;

use src\Shared\Entities\CategoryLocalizedAttributesEntity;
use stdClass;

class CategoryLocalizedAttributesEntityBuilder
{
	public function buildEntity(stdClass $entityData): CategoryLocalizedAttributesEntity
	{
		return (new CategoryLocalizedAttributesEntity)
			->setIdCategoryLocalizedAttributes(null)
			->setName($entityData->name)
			->setFkCategory($entityData->fk_category)
			->setDescription($entityData->description)
			->setFkLanguage($entityData->fk_language);
	}
}