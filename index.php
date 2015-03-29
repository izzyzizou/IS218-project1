<?php

echo "Testing Project";

class mainfunction
{
	public static $csvFile;
	public static $fileHeadings;
	
	public static function readCSV($csvFile, $fileHeadings)
	{
		ini_set('auto_detect_line_endings', TRUE);
		if(($handle = fopen($csvFile, "r")) !== FALSE)
		{
			while(($row = fgetcsv($handle, 1000, ",")) !== FALSE)
			{
				if($fileHeadings == TRUE)
				{
					$heading = $row;
					$fileHeadings = FALSE;
				}
				else 
				{
					$record = array_combine($fileHeading, $row);
					$records[] = $record;
				}
			}
			fclose($handle);
		}
		return $records;
	}
	
	public function printTable($records, $map)
	{
		if(empty($_GET))
		{
			$i = -1;
			foreach ($records as $record)
			{
				$i++;
				echo (html_link_table::link("http://web.njit.edu/~ia85/project1/index.php?records=" . $i , $record['INSTNM']));
				echo '</p>';
			}
		}
		
		$record = $records[$_GET['record']];
		$record = array_combine($map, $record);
		echo(html_link_table::table($record));
	}
}


?>