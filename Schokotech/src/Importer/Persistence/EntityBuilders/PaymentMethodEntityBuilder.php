<?php

namespace src\Importer\Persistence\EntityBuilders;

use src\Shared\Entities\PaymentMethodEntity;

class PaymentMethodEntityBuilder
{
	public function buildEntity(array $paymentMethod): PaymentMethodEntity
	{
		return (new PaymentMethodEntity())
			->setIdPaymentMethod(null)
			->setFee($paymentMethod['fee']);
	}
}