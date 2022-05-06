<?php

namespace src\Product;

use ArrayObject;

class ProductFacade implements ProductFacadeInterface
{
	public function findProductAbstracts(): ArrayObject
	{
		return $this->getFactory()->createProductReader()->findProductAbstracts();
	}

	public function findProductAbstractsByIdCategory(int $idCategory): ArrayObject
	{
		return $this->getFactory()->createProductReader()->findProductAbstractsByIdCategory($idCategory);
	}

	private function getFactory(): ProductFactory
	{
		return new ProductFactory;
	}
}
