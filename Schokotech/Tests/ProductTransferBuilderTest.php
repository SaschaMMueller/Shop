<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use src\Product\ProductFactory;
use src\Shared\Entities\ProductAbstractEntity;
use src\Shared\TransferObjects\ProductTransfer;

class ProductTransferBuilderTest extends TestCase
{
	const FK_WHOLE_MILK_CHOCOLATE = 7;
	const ID_TEST_PRODUCT_ABSTRACT = 1;

	public function testBuildProductTransferCreatesProductTransferFilledWithCorrectData(): void
	{
		$expectedResult = $this->createTestProduct();
		$result = (new ProductFactory())->createProductReader()->findProductAbstractByIdProductAbstract(self::ID_TEST_PRODUCT_ABSTRACT);

		$this->assertTrue(isset($result));
		$this->assertEquals($expectedResult->getUrl(), $result->getUrl());
	}

	private function createTestProduct(): ProductTransfer
	{
		return (new ProductTransfer())
			->setUrl("haselnuss");
	}

	private function creatTestProductAbstractEntity(): ProductAbstractEntity
	{
		return (new ProductAbstractEntity())
			->setIdProductAbstract(self::ID_TEST_PRODUCT_ABSTRACT);
	}
}