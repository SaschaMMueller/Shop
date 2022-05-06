<?php

namespace src\Product;

use src\Product\Business\Model\BreadcrumbTransferBuilder;
use src\DatabaseConnector;
use src\Product\Business\Model\ProductTransferBuilder;
use src\Product\Business\Model\ProductVariantsTransfersBuilder;
use src\Product\Persistence\ProductQueryContainer;
use src\Product\Persistence\ProductReader;
use src\Shared\System\Application;
use src\Url\UrlFacadeInterface;
use Twig\Environment;

class ProductFactory
{
	public function createProductTransferBuilder(): ProductTransferBuilder
	{
		return new ProductTransferBuilder();
	}

	public function createProductQueryContainer(): ProductQueryContainer
	{
		return new ProductQueryContainer($this->createDatabaseConnector());
	}

	public function createProductReader(): ProductReader
	{
		return new ProductReader(
			$this->createProductQueryContainer(),
			$this->createProductTransferBuilder(),
			$this->createProductVariantsTransfersBuilder(),
			$this->createBreadcrumbTransferBuilder(),
			$this->getUrlFacade()
		);
	}

	public function getTwig(): Environment
	{
		return Application::getInstance()->getTwig();
	}

	private function createProductVariantsTransfersBuilder(): ProductVariantsTransfersBuilder
	{
		return new ProductVariantsTransfersBuilder();
	}

	private function createBreadcrumbTransferBuilder(): BreadcrumbTransferBuilder
	{
		return new BreadcrumbTransferBuilder();
	}

	private function getUrlFacade(): UrlFacadeInterface
	{
		return $this->getDependencyProvider()->createUrlFacade();
	}

	private function getDependencyProvider(): ProductDependencyProvider
	{
		return new ProductDependencyProvider();
	}

	private function createDatabaseConnector(): DatabaseConnector
	{
		return new DatabaseConnector();
	}
}