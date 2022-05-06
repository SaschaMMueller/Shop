<?php

namespace src\Url;

use src\Shared\TransferObjects\RequestTransfer;
use src\Shared\TransferObjects\UrlTransfer;

class UrlFacade implements UrlFacadeInterface
{
	public function resolveUrlForApplicationStart(RequestTransfer $request): void
	{
		$this->getFactory()->createUrlResolver()->resolveUrlForApplicationStart($request);
	}

	public function findUrlByIdProductAbstract(int $idProductAbstract): ?UrlTransfer
	{
		return $this->getFactory()->createUrlReader()->findUrlByIdProductAbstract($idProductAbstract);
	}

	public function findUrlByIdCategory(int $idCategory): ?UrlTransfer
	{
		return $this->getFactory()->createUrlReader()->findUrlByIdCategory($idCategory);
	}

	private function getFactory(): UrlFactory
	{
		return new UrlFactory();
	}
}