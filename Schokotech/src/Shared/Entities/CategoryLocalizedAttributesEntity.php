<?php

namespace src\Shared\Entities;

class CategoryLocalizedAttributesEntity extends BaseEntity
{
	public const TABLE_NAME = 'category_localized_attributes';
	public const COLUMN_ID_NAME = 'id_category_localized_attributes';

    private ?int $idCategoryLocalizedAttributes;
    private int $fkCategory;
    private int $fkLanguage;
    private string $name;
    private string $description;

	public function getIdCategoryLocalizedAttributes(): ?int
	{
		return $this->idCategoryLocalizedAttributes;
	}

	public function setIdCategoryLocalizedAttributes(?int $idCategoryLocalizedAttributes): self
	{
		$this->idCategoryLocalizedAttributes = $idCategoryLocalizedAttributes;

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

	public function getFkLanguage(): int
	{
		return $this->fkLanguage;
	}

	public function setFkLanguage(int $fkLanguage): self
	{
		$this->fkLanguage = $fkLanguage;

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
}