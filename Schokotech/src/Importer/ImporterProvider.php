<?php

namespace src\Importer;

class ImporterProvider
{
	public function getImporters(): array
	{
		return [
			(new ImporterFactory())->createCategoryImporter(),
			(new ImporterFactory())->createCategoryLocalizedAttributesImporter(),
			(new ImporterFactory())->createUrlImporter(),
			(new ImporterFactory())->createUrlToCategoryImporter(),
			(new ImporterFactory())->createPaymentMethodImporter(),
			(new ImporterFactory())->createProductImporter(),
		];
	}
}