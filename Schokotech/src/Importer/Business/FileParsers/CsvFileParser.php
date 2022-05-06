<?php

namespace src\Importer\Business\FileParsers;

class CsvFileParser implements ImportFileParserInterface
{
	public function parse($importFile): string
	{
		$columnNames = fgetcsv($importFile);
		$table = [];
		$row = 0;

		while (($importFileData = fgetcsv($importFile, 1000, ",")) !== FALSE)
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
		}

		return json_encode($table);
	}
}