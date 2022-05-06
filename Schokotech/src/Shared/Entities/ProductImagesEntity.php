<?php

namespace src\Shared\Entities;

class ProductImagesEntity extends BaseEntity
{
	public const COLUMN_ID_NAME = 'id_product_images';
	public const TABLE_NAME = 'product_images';

	private ?int $idProductImages;
	private string $imagePath;
	private int $fkProductAbstract;

	public function getIdProductImages(): ?int
	{
		return $this->idProductImages;
	}

	public function setIdProductImages(?int $idProductImages): self
	{
		$this->idProductImages = $idProductImages;

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

	public function getFkProductAbstract(): int
	{
		return $this->fkProductAbstract;
	}

	public function setFkProductAbstract(int $fkProductAbstract): self
	{
		$this->fkProductAbstract = $fkProductAbstract;

		return $this;
	}
}