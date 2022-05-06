<?php

namespace src\Importer\Business;

class FileParserSelector
{
	private array $importFileParsers;

	public function __construct(array $importFileParsers)
	{
		$this->importFileParsers = $importFileParsers;
	}

	public function selectParser(string $fileName)
	{
		$selectedParser = null;
		$fileExtension = $this->extractFileExtension($fileName);

		switch ($fileExtension)
		{
			case 'csv':
				var_dump('CSV PARSER SELECTED');
				$selectedParser = $this->importFileParsers['csv'];
				break;

			case 'xls':
				var_dump('XLS PARSER SELECTED');
				$selectedParser = $this->importFileParsers['xls'];
				break;

			case 'xlsx':
				var_dump('XLSX PARSER SELECTED');
				$selectedParser = $this->importFileParsers['xls'];
				break;

			default:
				var_dump('FILE COULD NOT BE PARSED: UNKNOWN EXTENSION / PARSER NOT FOUND');
				$selectedParser = null;
				break;
		}

		return $selectedParser;
	}

	private function extractFileExtension(string $fileName): ?string
	{
		return pathinfo($fileName)['extension'];
	}
}