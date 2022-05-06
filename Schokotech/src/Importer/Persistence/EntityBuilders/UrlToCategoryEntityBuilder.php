<?php

namespace src\Importer\Persistence\EntityBuilders;

use src\Shared\Entities\UrlToCategoryEntity;
use stdClass;

class UrlToCategoryEntityBuilder
{
	public function buildEntity(stdClass $entityData): UrlToCategoryEntity
	{
		return (new UrlToCategoryEntity())
			->setIdUrlToCategory(null)
			->setFkCategory($entityData->fk_category)
			->setFkUrl($entityData->fk_url);
	}
}