<?php

namespace src\Category\Presentation;

use kernel\Presentation\BaseController;
use src\Category\CategoryFactory;
use src\Shared\TransferObjects\RequestTransfer;

class CategoryController extends BaseController
{
	public function listAction(RequestTransfer $request): void
	{
		$this->printMainPage($request);
	}

	public function showAction(int $idCategory, RequestTransfer $request): void
	{
		$this->printCategoryPage($idCategory, $request);
	}

	private function printMainPage(RequestTransfer $request): void
	{
		$productAbstracts = $this->getFactory()->getProductFacade()->findProductAbstracts();
		$mainCategories = $this->getFactory()->createCategoryReader()->findCategories($request->getSeoUrl());

		echo $this->getFactory()->getTwig()->render(
			'Category/Presentation/tpl/index.twig',
			array('categories' => $mainCategories, 'products' => $productAbstracts));
	}

	private function printCategoryPage(int $categoryId, RequestTransfer $request): void
	{
		$mainCategories = $this->getFactory()->createCategoryReader()->findCategories($request->getSeoUrl());
		$selectedProductAbstracts = $this->getFactory()->getProductFacade()->findProductAbstractsByIdCategory($categoryId);

		echo $this->getFactory()->getTwig()->render(
			'Category/Presentation/tpl/index.twig',
			array('categories' => $mainCategories, 'products' => $selectedProductAbstracts));
	}

	private function getFactory(): CategoryFactory
	{
		return new CategoryFactory();
	}
}