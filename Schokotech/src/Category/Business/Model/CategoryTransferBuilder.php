<?php

namespace src\Category\Business\Model;

use src\Shared\TransferObjects\CategoryTransfer;
use src\Url\UrlFacadeInterface;

class CategoryTransferBuilder
{
	private UrlFacadeInterface $urlFacade;

	public function __construct(UrlFacadeInterface $urlFacade)
	{
		$this->urlFacade = $urlFacade;
	}

	public function buildCategoryTransferWithoutSubCategories(int $categoryId, array $categoryLocalizedAttributes, string $seoUrl): CategoryTransfer
	{
		return (new CategoryTransfer())
			->setName($this->getCategoryName($categoryId, $categoryLocalizedAttributes))
			->setSeoUrl($this->getCategoryUrl($categoryId))
			->setIsActive($this->checkIfCategoryIsActive($this->getCategoryUrl($categoryId), $seoUrl));
	}

	private function getCategoryName(int $idCategory, array $categoryLocalizedAttributes): ?string
	{
		foreach($categoryLocalizedAttributes as $categoryLocalizedAttribute)
		{
			if($categoryLocalizedAttribute->fk_category == $idCategory)
			{
				return $categoryLocalizedAttribute->name;
			}
		}

		return null;
	}

	private function getCategoryUrl(int $idCategory): string
	{
		$categoryUrl = $this->urlFacade->findUrlByIdCategory($idCategory);
		$categoryUrl = $categoryUrl->getSeoUrl();

		return $categoryUrl;
	}

	private function checkIfCategoryIsActive(string $categoryUrl, string $seoUrl): bool
	{
		if($categoryUrl == $seoUrl)
		{
			return true;
		}
		return false;
	}
}