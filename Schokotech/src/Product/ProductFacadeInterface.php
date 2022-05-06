<?php

namespace src\Product;

use ArrayObject;

interface ProductFacadeInterface
{
	public function findProductAbstracts(): ArrayObject;
	public function findProductAbstractsByIdCategory(int $idCategory): ArrayObject;
}