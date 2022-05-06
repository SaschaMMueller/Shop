<?php

namespace src\Product\Presentation;

use kernel\Presentation\BaseController;
use src\Product\ProductFactory;

class ProductController extends BaseController
{
	public function showAction(int $idProductAbstract): void
	{
		$productTransfer = $this->getFactory()->createProductReader()->findProductAbstractByIdProductAbstract($idProductAbstract);

		echo $this->getFactory()->getTwig()->render('/Product/Presentation/tpl/index.twig', array('product' => $productTransfer));
	}

	private function getFactory(): ProductFactory
	{
		return new ProductFactory();
	}
}