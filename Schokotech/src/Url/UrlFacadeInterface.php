<?php

namespace src\Url;

use src\Shared\TransferObjects\RequestTransfer;
use src\Shared\TransferObjects\UrlTransfer;

interface UrlFacadeInterface
{
	public function resolveUrlForApplicationStart(RequestTransfer $request): void;
	public function findUrlByIdProductAbstract(int $idProductAbstract): ?UrlTransfer;
	public function findUrlByIdCategory(int $idCategory): ?UrlTransfer;
}