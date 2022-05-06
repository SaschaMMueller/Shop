<?php

namespace src\Application\Twig\Functions;

use src\Service\Session\SessionServiceInterface;

class CartItemTotalsFunction
{
	private SessionServiceInterface $sessionService;

	public function __construct(SessionServiceInterface $sessionService)
	{
		$this->sessionService = $sessionService;
	}

	public function getCartItemTotalCount(): int
	{
		return $this->sessionService->findOrCreateCartTransferInSession()->getTotalItemCount();
	}
}