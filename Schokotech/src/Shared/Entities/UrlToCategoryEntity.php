<?php

namespace src\Shared\Entities;

class UrlToCategoryEntity extends BaseEntity
{
	public const FILE_PATH = '/ImporterFiles/categories.csv';
	public const TABLE_NAME = 'url_to_category';
	public const COLUMN_ID_NAME = 'id_url_to_category';

	private ?int $idUrlToCategory;
	private int $fkUrl;
	private int $fkCategory;

	public function getIdUrlToCategory(): ?int
	{
		return $this->idUrlToCategory;
	}

	public function setIdUrlToCategory(?int $idUrlToCategory): self
	{
		$this->idUrlToCategory = $idUrlToCategory;

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

	public function getFkCategory(): int
	{
		return $this->fkCategory;
	}

	public function setFkCategory(int $fkCategory): self
	{
		$this->fkCategory = $fkCategory;

		return $this;
	}
}