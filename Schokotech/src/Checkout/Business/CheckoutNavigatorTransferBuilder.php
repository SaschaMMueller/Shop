<?php

namespace src\Checkout\Business;

use src\Shared\TransferObjects\CheckoutNavigatorTransfer;

class CheckoutNavigatorTransferBuilder
{
	public function buildCheckoutNavigatorTransfer(): array
	{
		$directory = __DIR__ . '/Steps/';
		$stepFileNames = array_diff(scandir($directory), array('..', '.'));
		$checkoutStepCollection = [];

		foreach($stepFileNames as $file)
		{
			$fileName = substr($file, 0, -4);
			$classname = 'src\Checkout\Business\Steps\\' . $fileName;

			$checkoutStepCollection[$classname::STEP_NUMBER] = (new CheckoutNavigatorTransfer())
				->setStepName(strtoupper(substr($file, 0, -8)))
				->setStepSeoUrl(strtolower(substr_replace($fileName, '-', strpos($file, 'Step'), 0)))
				->setStepNumber($classname::STEP_NUMBER);
		}

		ksort($checkoutStepCollection);

		return $checkoutStepCollection;
	}
}