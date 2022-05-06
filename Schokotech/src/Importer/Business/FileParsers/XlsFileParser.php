<?php

namespace src\Importer\Business\FileParsers;

class XlsFileParser implements ImportFileParserInterface
{
	public function parse($importFile): string
	{
		$columnNames = $importFile->current();
		$importFile->next();
		$table = [];
		$row = 0;

		while (($importFileData = $importFile->current()) !== NULL)
		{
			$temp = [];
			$counter = 0;

			foreach($columnNames as $name)
			{
				$temp[$name] = $importFileData[$counter];
				$counter++;
			}

			$table[$row] = $temp;
			$row++;

			$importFile->next();
		}

		return json_encode($table);
	}
}