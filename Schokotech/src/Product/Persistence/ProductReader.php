<?php

namespace src\Product\Persistence;

use ArrayObject;
use PDO;
use src\Product\Business\Model\BreadcrumbTransferBuilder;
use src\Product\Business\Model\ProductTransferBuilder;
use src\Product\Business\Model\ProductVariantsTransfersBuilder;
use src\Shared\TransferObjects\ProductTransfer;
use src\Url\UrlFacadeInterface;
use stdClass;

class ProductReader
{
	private ProductQueryContainer $productQueryContainer;
	private ProductTransferBuilder $productTransferBuilder;
	private ProductVariantsTransfersBuilder $productVariantsTransferBuilder;
	private BreadcrumbTransferBuilder $breadcrumbTransferBuilder;
	private UrlFacadeInterface $urlFacade;

	public function __construct(ProductQueryContainer $productQueryContainer,
								ProductTransferBuilder $productTransferBuilder,
								ProductVariantsTransfersBuilder $productVariantsTransferBuilder,
								BreadcrumbTransferBuilder $breadcrumbTransferBuilder,
								UrlFacadeInterface $urlFacade)
	{
		$this->productQueryContainer = $productQueryContainer;
		$this->productTransferBuilder = $productTransferBuilder;
		$this->productVariantsTransferBuilder = $productVariantsTransferBuilder;
		$this->breadcrumbTransferBuilder = $breadcrumbTransferBuilder;
		$this->urlFacade = $urlFacade;
	}

	public function findProductAbstracts(): ArrayObject
	{
		$query = $this->productQueryContainer->findProductAbstractsQuery();
		$query->execute();
		$productAbstracts = $query->fetchAll(PDO::FETCH_OBJ);

		$productTransfers = new ArrayObject();

		foreach($productAbstracts as $productAbstract)
		{
			$productTransfers->append($this->findProductAbstractByIdProductAbstract(
				$productAbstract->id_product_abstract));
		}

		return $productTransfers;
	}

	public function findProductAbstractsByIdCategory(int $idCategory): ArrayObject
	{
		$query = $this->productQueryContainer->findProductAbstractsByIdCategoryQuery($idCategory);
		$query->execute();
		$selectedProductAbstracts = $query->fetchAll(PDO::FETCH_OBJ);

		$selectedProductTransfers = new ArrayObject();

		foreach($selectedProductAbstracts as $selectedProductAbstract)
		{
			$selectedProductTransfers->append($this->findProductAbstractByIdProductAbstract(
				$selectedProductAbstract->id_product_abstract));
		}

		return $selectedProductTransfers;
	}

	public function findProductAbstractByIdProductAbstract(int $idProductAbstract): ProductTransfer
	{
		$generalProductData = $this->findGeneralProductDataByIdProductAbstract($idProductAbstract);
		$productLocalizedAttributes = $this->findProductLocalizedAttributesByFkProductAbstract($idProductAbstract);
		$urlTransfer = $this->urlFacade->findUrlByIdProductAbstract($idProductAbstract);
		$productVariantsTransfers = $this->buildProductVariantsByIdProductAbstract($idProductAbstract);
		$breadcrumbs = $this->buildBreadcrumbsByFkCategory($generalProductData->fk_category);

		return $this->productTransferBuilder->buildProductTransfer($productLocalizedAttributes,
																   $generalProductData,
																   $urlTransfer,
																   $productVariantsTransfers,
																   $breadcrumbs);
	}

	private function findGeneralProductDataByIdProductAbstract(int $idProductAbstract): stdClass
	{
		$query = $this->productQueryContainer->findGeneralProductDataByIdProductAbstractQuery($idProductAbstract);
		$query->execute();

		return $query->fetch(PDO::FETCH_OBJ);
	}

	private function findProductLocalizedAttributesByFkProductAbstract(int $fkProductAbstract): stdClass
	{
		$query = $this->productQueryContainer->findProductLocalizedAttributesByFkProductAbstractQuery($fkProductAbstract);
		$query->execute();

		return $query->fetch(PDO::FETCH_OBJ);
	}

	private function buildProductVariantsByIdProductAbstract(int $idProductAbstract): ArrayObject
	{
		$query = $this->productQueryContainer->findProductsPurchasableByIdProductAbstractQuery($idProductAbstract);
		$query->execute();
		$productsPurchasable = $query->fetchAll(PDO::FETCH_OBJ);

		return $this->productVariantsTransferBuilder->buildProductVariantsTransfers($productsPurchasable);
	}

	private function buildBreadcrumbsByFkCategory(int $fk_category): ArrayObject
	{
		$query = $this->productQueryContainer->findCategoriesByFkCategoryQuery();
		$query->execute();
		$breadcrumbs = $query->fetchAll(PDO::FETCH_OBJ);

		return $this->breadcrumbTransferBuilder->buildBreadcrumbTransfers($fk_category, $breadcrumbs);
	}
}