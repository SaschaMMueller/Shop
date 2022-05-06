<?php

namespace src\Importer\Business\Importers;

class BaseImporter implements ImporterInterface
{
	protected const IMPORT_FILE = '';
	protected const IMPORT_FILES = [];

	public function shouldImport(): bool
	{
		return true;
	}

	public function import(): void
	{
		return;
	}

	protected function getAbsoluteImportFilePath(): string
	{
		return dirname(dirname(__DIR__)) . static::IMPORT_FILE;
	}

	protected function getAbsoluteImportFilePaths(): array
	{
		$filePaths = static::IMPORT_FILES;
		$absoluteFilePaths = null;

		foreach($filePaths as $filePath)
		{
			$absoluteFilePaths[] = dirname(dirname(__DIR__)) . $filePath;
		}

		return $absoluteFilePaths;
	}
}