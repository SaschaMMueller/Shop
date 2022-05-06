<?php

namespace src\Category;

use src\Category\Business\Model\CategoryTransferBuilder;
use src\Category\Business\Model\MainCategoryHydrator;
use src\Category\Persistence\CategoryQueryContainer;
use src\Category\Persistence\CategoryReader;
use src\Product\ProductFacadeInterface;
use src\Shared\System\Application;
use src\Url\UrlFacadeInterface;
use src\DatabaseConnector;
use Twig\Environment;

class CategoryFactory
{
	public function createCategoryReader(): CategoryReader
	{
		return new CategoryReader(
			$this->createCategoryQueryContainer(),
			$this->createCategoryTransferBuilder(),
			$this->createMainCategoryHydrator()
		);
	}

	public function getProductFacade(): ProductFacadeInterface
	{
		return $this->getDependencyProvider()->createProductFacade();
	}

	public function getTwig(): Environment
	{
		return Application::getInstance()->getTwig();
	}

	private function createCategoryTransferBuilder(): CategoryTransferBuilder
	{
		return new CategoryTransferBuilder($this->getUrlFacade());
	}

	private function createMainCategoryHydrator(): MainCategoryHydrator
	{
		return new MainCategoryHydrator();
	}

	private function createCategoryQueryContainer(): CategoryQueryContainer
	{
		return new CategoryQueryContainer($this->createDatabaseConnector());
	}

	private function getUrlFacade(): UrlFacadeInterface
	{
		return $this->getDependencyProvider()->createUrlFacade();
	}

	private function getDependencyProvider(): CategoryDependencyProvider
	{
		return new CategoryDependencyProvider();
	}

	private function createDatabaseConnector(): DatabaseConnector
	{
		return new DatabaseConnector();
	}
}