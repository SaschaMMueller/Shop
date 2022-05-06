<?php

namespace src\Checkout\Presentation;

class CheckoutControllerProvider
{
	public function getActionToSeoUrlMappings(): array
	{
		return [
			'customer-step-save' => 'Checkout/customerStepSave',
			'address-step-save' => 'Checkout/addressStepSave'
		];
	}
}