<?php

namespace src\Shared\Entities;

class UrlToProductEntity extends BaseEntity
{
	public const COLUMN_ID_NAME = 'id_url_to_product';
	public const TABLE_NAME = 'url_to_product';

	private ?int $idUrlToProduct;
	private int $fkUrl;
	private int $fkProductAbstract;

	public function getIdUrlToProduct(): ?int
	{
		return $this->idUrlToProduct;
	}

	public function setIdUrlToProduct(?int $idUrlToProduct): self
	{
		$this->idUrlToProduct = $idUrlToProduct;

		return $this;
	}

	public function getFkUrl(): int
	{
		return $this->fkUrl;
	}

	public function setFkUrl(int $fkUrl): self
	{
		$this->fkUrl = $fkUrl;

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