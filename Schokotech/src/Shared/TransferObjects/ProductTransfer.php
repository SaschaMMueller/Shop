<?php

namespace src\Shared\TransferObjects;

use ArrayObject;

class ProductTransfer
{
	private string $name;
	private string $description;
	private string $imagePath;
	private string $url;
	private int $fkCategory;
	private ArrayObject $productVariantsTransfers;
	private ArrayObject $breadcrumbs;

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name): self
	{
		$this->name = $name;

		return $this;
	}

	public function getImagePath(): string
	{
		return $this->imagePath;
	}

	public function setImagePath(string $imagePath): self
	{
		$this->imagePath = $imagePath;

		return $this;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

	public function setDescription(string $description): self
	{
		$this->description = $description;

		return $this;
	}

	public function getFkCategory(): int
	{
		return $this->fkCategory;
	}

	public function setFkCategory(int $productCategory): self
	{
		$this->fkCategory = $productCategory;

		return $this;
	}

	public function getUrl(): string
	{
		return $this->url;
	}

	public function setUrl(string $url): self
	{
		$this->url = $url;

		return $this;
	}

	public function getProductVariantsTransfers(): ArrayObject
	{
		return $this->productVariantsTransfers;
	}

	public function setProductVariantsTransfers(ArrayObject $productVariantsTransfers): self
	{
		$this->productVariantsTransfers = $productVariantsTransfers;

		return $this;
	}

	public function getBreadcrumbs(): ArrayObject
	{
		return $this->breadcrumbs;
	}

	public function setBreadcrumbs(ArrayObject $breadcrumbs): self
	{
		$this->breadcrumbs = $breadcrumbs;

		return $this;
	}
}