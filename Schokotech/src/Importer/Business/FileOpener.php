<?php

namespace src\Importer\Business;

use Asan\PHPExcel\Excel;

class FileOpener
{
	public function openFile(string $absolutePath)
	{
		$fileExtension = $this->extractFileExtension($absolutePath);

		switch($fileExtension)
		{
			case 'csv':

				return fopen($absolutePath, 'r');

			case 'xls':
			case 'xlsx':

				return Excel::load($absolutePath);

			default:
				var_dump('FILE COULD NOT BE OPENED: UNKNOWN EXTENSION');
				break;
		}

		return null;
	}

	private function extractFileExtension(string $fileName): ?string
	{
		return pathinfo($fileName)['extension'];
	}
}