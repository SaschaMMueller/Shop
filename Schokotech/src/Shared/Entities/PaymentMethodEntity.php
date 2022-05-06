<?php

namespace src\Shared\Entities;

class PaymentMethodEntity extends BaseEntity
{
	public const COLUMN_ID_NAME = 'id_payment_method';
	public const TABLE_NAME = 'payment_method';

	private ?int $id_payment_method;
	private float $fee;

	public function getIdPaymentMethod(): ?int
	{
		return $this->id_payment_method;
	}

	public function setIdPaymentMethod(?int $idPaymentMethod): self
	{
		$this->id_payment_method = $idPaymentMethod;

		return $this;
	}

	public function getFee(): float
	{
		return $this->fee;
	}

	public function setFee(float $fee): self
	{
		$this->fee = $fee;

		return $this;
	}
}