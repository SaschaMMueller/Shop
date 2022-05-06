<?php

namespace src\Category\Business\Model;

use ArrayObject;
use src\Shared\TransferObjects\CategoryTransfer;

class MainCategoryHydrator
{
	public function hydrateWithSubCategories(CategoryTransfer $mainCategoryTransfer, ArrayObject $subCategories): CategoryTransfer
	{
		if($this->checkIfSubCategoryIsActive($subCategories) == true)
		{
			$mainCategoryTransfer->setIsActive(true);
		}

		return $mainCategoryTransfer->setSubCategories($subCategories);
	}

	private function checkIfSubCategoryIsActive(ArrayObject $subCategoryTransfers): bool
	{
		foreach($subCategoryTransfers as $subCategoryTransfer)
		{
			if($subCategoryTransfer->getIsActive() == true)
			{
				return true;
			}
		}

		return false;
	}
}