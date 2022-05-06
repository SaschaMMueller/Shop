<?php

namespace src\Category\Persistence;

use ArrayObject;
use PDO;
use src\Category\Business\Model\CategoryTransferBuilder;
use src\Category\Business\Model\MainCategoryHydrator;
use src\Shared\TransferObjects\CategoryTransfer;

class CategoryReader
{
	private CategoryQueryContainer $categoryQueryContainer;
	private CategoryTransferBuilder $categoryTransferBuilder;
	private MainCategoryHydrator $mainCategoryHydrator;

	public function __construct(CategoryQueryContainer $categoryQueryContainer,
								CategoryTransferBuilder $categoryTransferBuilder,
								MainCategoryHydrator $mainCategoryHydrator)
	{
		$this->categoryQueryContainer = $categoryQueryContainer;
		$this->categoryTransferBuilder = $categoryTransferBuilder;
		$this->mainCategoryHydrator = $mainCategoryHydrator;
	}

	public function findCategories(string $seoUrl): ArrayObject
	{
		$query = $this->categoryQueryContainer->findMainCategoriesQuery();

		$query->execute();
		$mainCategories = $query->fetchAll(PDO::FETCH_OBJ);
		return $this->buildCategories($mainCategories, $seoUrl);
	}

	private function buildCategories(array $mainCategories, string $seoUrl): ArrayObject
	{
		$categoryCollection = new ArrayObject();

		foreach($mainCategories as $mainCategory)
		{
			$mainCategoryId = $mainCategory->id_category;
			$mainCategoryTransfer = $this->findMainCategories($mainCategoryId, $seoUrl);
			$mainCategoryTransfer = $this->mainCategoryHydrator->hydrateWithSubCategories(
				$mainCategoryTransfer,
				$this->findSubCategories($mainCategoryId, $seoUrl));
			$categoryCollection->append($mainCategoryTransfer);
		}

		return $categoryCollection;
	}

	private function findMainCategories(int $categoryId, string $seoUrl): CategoryTransfer
	{
		$query = $this->categoryQueryContainer->getCategoriesLocalizedAttributesQuery();
		$query->execute();
		$categoryLocalizedAttributes = $query->fetchAll(PDO::FETCH_OBJ);

		return $this->categoryTransferBuilder->buildCategoryTransferWithoutSubCategories(
			$categoryId, $categoryLocalizedAttributes, $seoUrl);
	}

	private function findSubCategories(int $idMainCategory, string $seoUrl): ArrayObject
	{
		$query = $this->categoryQueryContainer->findSubCategoriesByIdCategoryQuery($idMainCategory);
		$query->execute();
		$subCategories = $query->fetchAll(PDO::FETCH_OBJ);

		$subCategoryCollection = new ArrayObject();

		foreach($subCategories as $subCategory)
		{
			$subCategoryId = $subCategory->id_category;
			$subCategoryTransfer = $this->findMainCategories($subCategoryId, $seoUrl);
			$subCategoryCollection->append($subCategoryTransfer);
		}

		return $subCategoryCollection;
	}
}