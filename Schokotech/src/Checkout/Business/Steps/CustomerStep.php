<?php

namespace src\Checkout\Business\Steps;

use src\Checkout\Business\CheckoutNavigatorTransferBuilder;
use src\Checkout\Business\CustomerHydrator;
use src\Service\Session\SessionServiceInterface;
use src\Shared\TransferObjects\RequestTransfer;
use Twig\Environment;

class CustomerStep
{
	public const STEP_NUMBER = 1;
	private SessionServiceInterface $sessionService;
	private Environment $twig;
	private CustomerHydrator $customerHydrator;
	private CheckoutNavigatorTransferBuilder $checkoutNavigatorTransferBuilder;

	public function __construct(
		SessionServiceInterface $sessionService,
		Environment $twig,
		CustomerHydrator $customerHydrator,
		CheckoutNavigatorTransferBuilder $checkoutNavigatorTransferBuilder
	)
	{
		$this->sessionService = $sessionService;
		$this->twig = $twig;
		$this->customerHydrator = $customerHydrator;
		$this->checkoutNavigatorTransferBuilder = $checkoutNavigatorTransferBuilder;
	}

	public function renderCustomerStep(RequestTransfer $request): void
	{
		$this->sessionService->setReachedCheckoutStepInSession(self::STEP_NUMBER);

		$customerTransfer = $this->sessionService->findOrCreateCustomerTransferInSession();
		$checkoutNavigator = $this->checkoutNavigatorTransferBuilder->buildCheckoutNavigatorTransfer();
		$reachedCheckoutStep = $this->sessionService->findOrCreateReachedCheckoutStepInSession();

		echo $this->twig->render('Checkout/Presentation/tpl/customer-step.twig',
			 array(
				 'customerStep'        => $customerTransfer,
				 'currentSeoUrl'       => $request->getSeoUrl(),
				 'checkoutSteps'       => $checkoutNavigator,
				 'reachedCheckoutStep' => $reachedCheckoutStep
			 ));
	}

	public function customerStepSave(RequestTransfer $requestTransfer): void
	{
		$customerTransfer = $this->sessionService->findOrCreateCustomerTransferInSession();
		$customerTransfer = $this->customerHydrator->hydrateWithCustomerStepData($customerTransfer, $requestTransfer);
		$this->sessionService->setCustomerTransferInSession($customerTransfer);

		header('Location: ' . 'http://localhost/Shop/Schokotech/' . $requestTransfer->getLanguagePrefix() . '/address-step');
	}
}