<?php

namespace Tests;

use PDO;
use PHPUnit\Framework\TestCase;
use src\DatabaseConnector;
use src\Shared\Entities\CategoryEntity;
use stdClass;

class BaseEntityTest extends TestCase
{
	private const CATEGORY_PARENT = 1;
	private const CATEGORY_SORTING_ORDER = 666;
	private const CATEGORY_KEY = 2;
	private const CATEGORY_IS_NOT_ROOT = false;

	private const UPDATED_CATEGORY_PARENT = 3;
	private const UPDATED_CATEGORY_KEY = 4;
	private const UPDATED_CATEGORY_SORTING_ORDER = 999;

	private ?PDO $connection;

	public function setUp(): void
	{
		$this->connection = (new DatabaseConnector())->createConnectionToServer();
	}

	public function tearDown(): void
	{
		$this->deleteTestData();
		$this->deleteUpdatedTestData();
	}

	public function testSaveMethodInsertsNewItemIfNoIdExists(): void
	{
		$category = $this->findCategoryByTestData();
		self::assertNull($category);

		$this->createCategoryWithTestData();

		$category = $this->findCategoryByTestData();
		self::assertNotNull($category);
	}

	public function testSaveMethodUpdatesExistingItemIfIdExists(): void
	{
		$this->createCategoryWithTestData();
		$category = $this->findCategoryByTestData();
		self::assertNotNull($category);

		$this->updateCategoryWithTestData($category);
		$updatedCategory = $this->findCategoryByTestData();
		self::assertNull($updatedCategory);

		$updatedCategory = $this->findCategoryByUpdatedTestData();
		self::assertNotNull($updatedCategory);
	}

	private function deleteTestData(): void
	{
		$pdo = $this->connection->prepare("DELETE FROM category 
			WHERE parent=:parent 
			AND category_key=:category_key
			AND sorting_order=:sortingOrder 
			AND is_root=:isRoot");

		$pdo->execute([
						  ':parent'       => self::CATEGORY_PARENT,
						  ':category_key' => self::CATEGORY_KEY,
						  ':sortingOrder' => self::CATEGORY_SORTING_ORDER,
						  ':isRoot'       => self::CATEGORY_IS_NOT_ROOT,
		]);
	}

	private function deleteUpdatedTestData(): void
	{
		$pdo = $this->connection->prepare("DELETE FROM category 
			WHERE parent=:parent 
			AND category_key=:category_key
			AND sorting_order=:sortingOrder 
			AND is_root=:isRoot");

		$pdo->execute([
						  ':parent'       => self::UPDATED_CATEGORY_PARENT,
						  ':category_key' => self::UPDATED_CATEGORY_KEY,
						  ':sortingOrder' => self::UPDATED_CATEGORY_SORTING_ORDER,
						  ':isRoot'       => self::CATEGORY_IS_NOT_ROOT,
					  ]);
	}

	private function findCategoryByTestData(): ?stdClass
	{
		$pdo = $this->connection->prepare("SELECT * FROM category 
			WHERE parent=:parent 
			AND category_key=:category_key
			AND sorting_order=:sortingOrder 
			AND is_root=:isRoot");

		$pdo->execute([
			':parent'       => self::CATEGORY_PARENT,
			':category_key' => self::CATEGORY_KEY,
			':sortingOrder' => self::CATEGORY_SORTING_ORDER,
			':isRoot'       => self::CATEGORY_IS_NOT_ROOT
		]);

		$category = $pdo->fetch(PDO::FETCH_OBJ);

		if(!$category)
		{
			return null;
		}

		return $category;
	}

	private function findCategoryByUpdatedTestData(): ?stdClass
	{
		$pdo = $this->connection->prepare("SELECT * FROM category 
			WHERE parent=:parent 
				AND category_key=:category_key
				AND sorting_order=:sortingOrder 
				AND is_root=:isRoot");

		$pdo->execute([
						  ':parent'       => self::UPDATED_CATEGORY_PARENT,
						  ':category_key' => self::UPDATED_CATEGORY_KEY,
						  ':sortingOrder' => self::UPDATED_CATEGORY_SORTING_ORDER,
						  ':isRoot'       => self::CATEGORY_IS_NOT_ROOT
					  ]);

		$category = $pdo->fetch(PDO::FETCH_OBJ);

		if(!$category)
		{
			return null;
		}

		return $category;
	}

	private function createCategoryWithTestData(): void
	{
		(new CategoryEntity())
			->setIdCategory(NULL)
			->setParent(self::CATEGORY_PARENT)
			->setCategoryKey(self::CATEGORY_KEY)
			->setSortingOrder(self::CATEGORY_SORTING_ORDER)
			->setIsRoot(self::CATEGORY_IS_NOT_ROOT)
			->save();
	}

	private function updateCategoryWithTestData(stdClass $category): void
	{
		(new CategoryEntity())
			->setIdCategory((int)$category->id_category)
			->setParent(self::UPDATED_CATEGORY_PARENT)
			->setCategoryKey(self::UPDATED_CATEGORY_KEY)
			->setSortingOrder(self::UPDATED_CATEGORY_SORTING_ORDER)
			->setIsRoot(self::CATEGORY_IS_NOT_ROOT)
			->save();
	}
}