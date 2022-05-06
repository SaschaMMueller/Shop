<?php

namespace src\Cart\Presentation;

use kernel\Presentation\BaseController;
use src\Cart\CartFactory;
use src\Shared\TransferObjects\RequestTransfer;

class CartController extends BaseController
{
	public function listAction(): void
	{
		$cartTransfer = $this->getFactory()->getSessionService()->findOrCreateCartTransferInSession();

		echo $this->getFactory()->getTwig()->render('/Cart/Presentation/tpl/index.twig',
													array('cartItemTransfers' => $cartTransfer->getCartItemTransfers(),
														'totalPrice' => $cartTransfer->getTotalPrice()));
	}

	public function addToCartAction(RequestTransfer $request): void
	{
		$this->getFactory()->createCartHandler()->addToCart($request);

		header('Location: ' . $request->getLastUsedUrl());
	}

	public function removeItemFromCartAction(RequestTransfer $request): void
	{
		$this->getFactory()->createCartHandler()->removeItemFromCart($request->getPostVariables()['sku']);

		header('Location: ' . $request->getLastUsedUrl());
	}

	public function updateCartAction(RequestTransfer $request): void
	{
		$this->getFactory()->createCartHandler()->updateCart($request->getPostVariables());

		header('Location: ' . $request->getLastUsedUrl());
	}

	private function getFactory(): CartFactory
	{
		return new CartFactory();
	}
}