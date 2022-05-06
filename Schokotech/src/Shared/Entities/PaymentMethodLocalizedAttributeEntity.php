<?php

namespace src\Shared\Entities;

class PaymentMethodLocalizedAttributeEntity extends BaseEntity
{
	public const COLUMN_ID_NAME = 'id_payment_method_localized_attribute';
	public const TABLE_NAME = 'payment_method_localized_attribute';

	private ?int $id_payment_method_localized_attribute;
	private int $fk_payment_method;
	private string $name;
	private string $description;
	private int $fk_language;

	public function getIdPaymentMethodLocalizedAttribute(): ?int
	{
		return $this->id_payment_method_localized_attribute;
	}

	public function setIdPaymentMethodLocalizedAttribute(?int $idPaymentMethodLocalizedAttribute): self
	{
		$this->id_payment_method_localized_attribute = $idPaymentMethodLocalizedAttribute;

		return $this;
	}

	public function getFkPaymentMethod(): int
	{
		return $this->fk_payment_method;
	}

	public function setFkPaymentMethod(int $fkPaymentMethod): self
	{
		$this->fk_payment_method = $fkPaymentMethod;

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

	public function getFkLanguage(): int
	{
		return $this->fk_language;
	}

	public function setFkLanguage(int $fkLanguage): self
	{
		$this->fk_language = $fkLanguage;

		return $this;
	}
}