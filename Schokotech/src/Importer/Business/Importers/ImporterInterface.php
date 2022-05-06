<?php

namespace src\Importer\Business\Importers;

interface ImporterInterface
{
	public function shouldImport(): bool;
	public function import(): void;
}