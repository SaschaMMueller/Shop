<?php

namespace Tests;

use ArrayObject;
use PHPUnit\Framework\TestCase;
use src\Category\CategoryFactory;
use src\Category\Persistence\CategoryReader;
use src\Shared\TransferObjects\CategoryTransfer;
use src\Shared\TransferObjects\RequestTransfer;

class MainCategoryHydratonTest extends TestCase
{
	private CategoryFactory $categoryFactory;

	protected function setUp(): void
	{
		$this->categoryFactory = new CategoryFactory();
	}

	public function testHydrateWithSubCategoriesWillAddSubCategoriesToTheCategoryTransfers(): void
	{
		$_SERVER['REQUEST_URI'] = "blub";
		$_SERVER['HTTP_REFERER'] = "blub";
		$request = (new RequestTransfer())->init();
		$results = $this->categoryFactory->createCategoryReader()->findCategories($request->getSeoUrl());

		$stub = $this->createMock(CategoryReader::class);
		$stub->method('buildMainCategories')
			 ->willReturn($this->mockHydrator());

		$expectedResults = $stub->buildMainCategories($request->getSeoUrl());

		$arrayCounter = 0;

		foreach($results as $result)
		{
			$this->assertCount($expectedResults[$arrayCounter]->getSubCategories()->count(), $result->getSubCategories());
			$arrayCounter++;
		}
	}

	public function mockHydrator(): ArrayObject
	{
		$subCategories = new ArrayObject();
		$subCategories->append(new CategoryTransfer());
		$subCategories->append(new CategoryTransfer());
		$emptySubCategory = new ArrayObject();

		$mockMainCategories = new ArrayObject();
		$mockMainCategories->append((new CategoryTransfer())
										->setSubCategories($subCategories));
		$mockMainCategories->append((new CategoryTransfer())
						   				->setSubCategories($emptySubCategory));
		$mockMainCategories->append((new CategoryTransfer())
										->setSubCategories($subCategories));

		return $mockMainCategories;
	}
}