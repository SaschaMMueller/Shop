<?php

namespace src\Shared\Entities;

class ProductLocalizedAttributesEntity extends BaseEntity
{
	public const COLUMN_ID_NAME = 'id_product_localized_attributes';
	public const TABLE_NAME = 'product_localized_attributes';

	private ?int $idProductLocalizedAttributes;
	private string $name;
	private string $description;
	private string $attributes;
	private int $fkProductAbstract;
	private int $fkLanguage;

	public function getIdProductLocalizedAttributes(): ?int
	{
		return $this->idProductLocalizedAttributes;
	}

	public function setIdProductLocalizedAttributes(?int $idProductLocalizedAttributes): self
	{
		$this->idProductLocalizedAttributes = $idProductLocalizedAttributes;

		return $this;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name): self
	{
		$this->name = $name;

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

	public function getAttributes(): string
	{
		return $this->attributes;
	}

	public function setAttributes(string $attributes): self
	{
		$this->attributes = $attributes;

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

	public function getFkLanguage(): int
	{
		return $this->fkLanguage;
	}

	public function setFkLanguage(int $fkLanguage): self
	{
		$this->fkLanguage = $fkLanguage;

		return $this;
	}
}