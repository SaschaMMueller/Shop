<?php

namespace src\Cart\Business;

use ArrayObject;
use src\Cart\Persistence\CartReader;
use src\Service\Notification\NotificationServiceInterface;
use src\Service\Session\SessionServiceInterface;
use src\Shared\TransferObjects\CartTransfer;
use src\Shared\TransferObjects\RequestTransfer;

class CartHandler
{
	private const MAX_ITEMS_ALLOWED_TO_ORDER = 5;

	private SessionServiceInterface $sessionService;
	private CartReader $cartReader;
	private NotificationServiceInterface $notificationService;

	public function __construct(SessionServiceInterface $sessionService,
								CartReader $cartReader,
								NotificationServiceInterface $notificationService)
	{
		$this->sessionService = $sessionService;
		$this->cartReader = $cartReader;
		$this->notificationService = $notificationService;
	}

	public function addToCart(RequestTransfer $requestTransfer): void
	{
		$cartTransfer = $this->sessionService->findOrCreateCartTransferInSession();
		$cartTransfer = $this->addCartItem($cartTransfer,
										   $requestTransfer->getPostVariables()['sku'],
										   $requestTransfer->getPostVariables()['amount-pdp']);
		$cartTransfer = $this->updateCartItemTotalCount($cartTransfer);
		$cartTransfer = $this->updateTotalPrice($cartTransfer);

		$this->sessionService->updateCartInSession($cartTransfer);
	}

	public function removeItemFromCart(string $sku): void
	{
		$cartTransfer = $this->sessionService->findOrCreateCartTransferInSession();
		$cartTransfer = $this->removeCartItem($cartTransfer, $sku);
		$cartTransfer = $this->updateCartItemTotalCount($cartTransfer);
		$cartTransfer = $this->updateTotalPrice($cartTransfer);

		$this->sessionService->updateCartInSession($cartTransfer);
	}

	public function updateCart(array $postVariables): void
	{
		$cartTransfer = $this->sessionService->findOrCreateCartTransferInSession();
		$cartTransfer = $this->updateCartItems($cartTransfer, $postVariables);
		$cartTransfer = $this->updateCartItemTotalCount($cartTransfer);
		$cartTransfer = $this->updateTotalPrice($cartTransfer);

		$this->sessionService->updateCartInSession($cartTransfer);
	}

	private function removeCartItem(CartTransfer $cartTransfer, string $sku): CartTransfer
	{
		$cartItemTransfers = $cartTransfer->getCartItemTransfers();

		if(!empty($cartItemTransfers[$sku]))
		{
			$cartItemTransfers->offsetUnset($sku);
		}

		return $cartTransfer->setCartItemTransfers($cartItemTransfers);
	}

	private function addCartItem(CartTransfer $cartTransfer, string $sku, int $amount): CartTransfer
	{
		$cartItemTransfers = $cartTransfer->getCartItemTransfers();

		if(!empty($cartItemTransfers[$sku]))
		{
			return $cartTransfer->setCartItemTransfers($this->updateExistingCartItem($cartItemTransfers, $sku, $amount));
		}

		$cartItemTransfer = $this->cartReader->findCartItemDataBySku($sku, $amount);
		$cartItemTransfers->offsetSet($sku, $cartItemTransfer);

		return $cartTransfer->setCartItemTransfers($cartItemTransfers);
	}

	private function updateCartItems(CartTransfer $cartTransfer, array $postVariables): CartTransfer
	{
		$cartItemTransfers = $cartTransfer->getCartItemTransfers();
		$amounts = $postVariables['amount'];

		foreach($cartItemTransfers as $cartItemTransfer)
		{
			$cartItemTransfer->setAmount($amounts[$cartItemTransfer->getSku()]);
			$cartItemTransfer->setTotalPrice($cartItemTransfer->getAmount()*
											 $cartItemTransfer->getPrice());
		}

		return $cartTransfer;
	}

	private function updateExistingCartItem(ArrayObject $cartItemTransfers, string $sku, int $amount): ArrayObject
	{
		if($cartItemTransfers[$sku]->getAmount() + $amount > self::MAX_ITEMS_ALLOWED_TO_ORDER)
		{
			$cartItemTransfers[$sku]->setAmount(self::MAX_ITEMS_ALLOWED_TO_ORDER);
			$this->notificationService->saveMessage("Maximale Anzahl pro Artikel erlaubt: 5");
		}
		else
		{
			$cartItemTransfers[$sku]->setAmount($cartItemTransfers[$sku]->getAmount()+$amount);
		}

		$cartItemTransfers[$sku]->setTotalPrice($cartItemTransfers[$sku]->getAmount()*
												$cartItemTransfers[$sku]->getPrice());

		return $cartItemTransfers;
	}

	private function updateCartItemTotalCount(CartTransfer $cartTransfer): CartTransfer
	{
		$cartItemTransfers = $cartTransfer->getCartItemTransfers();
		$cartTransfer->setTotalItemCount($this->calculateTotalItemCount($cartItemTransfers));

		return $cartTransfer;
	}

	private function calculateTotalItemCount(ArrayObject $cartItemTransfers): int
	{
		$totalItemCount = 0;

		foreach($cartItemTransfers as $cartItemTransfer)
		{
			$totalItemCount += $cartItemTransfer->getAmount();
		}

		return $totalItemCount;
	}

	private function updateTotalPrice(CartTransfer $cartTransfer): CartTransfer
	{
		$cartItemTransfers = $cartTransfer->getCartItemTransfers();
		$cartTransfer->setTotalPrice($this->calculateTotalPrice($cartItemTransfers));

		return $cartTransfer;
	}

	private function calculateTotalPrice(ArrayObject $cartItemTransfers): float
	{
		$totalPrice = 0;

		foreach($cartItemTransfers as $cartItemTransfer)
		{
			$cartItemPrice = $cartItemTransfer->getPrice() * $cartItemTransfer->getAmount();
			$totalPrice += $cartItemPrice;
		}

		return $totalPrice;
	}
}