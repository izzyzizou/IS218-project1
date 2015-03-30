<?php
echo "<p>  testing </p>";
class filehandling 
{
	public static $file_csv;
	public static $column_headings;
	
	public static function readfile_csv($file_csv, $column_headings)
	{
	  ini_set('auto_detect_line_endings',TRUE);
		if (($handle = fopen($file_csv	, "r")) !== FALSE) 
		{
    		while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) 
			{
     			if($column_headings == TRUE) 
				{
       				$column_heading = $row;
       				$column_headings = FALSE; 
     			} 
				else 
				{
       				$record = array_combine($column_heading, $row);
       				$records[] = $record;
				}
    		}
    		fclose($handle);
	  }
	  return $records; 
	}
	public function print_table_links($records, $map) 
	{
	if (empty($_GET))
	{
			$i = -1;
			foreach($records as $record)
		{
				$i++;
			echo (html_link_table::link("http://web.njit.edu/~nav3/IS218/pc1/index.php?record=" . $i , $record['INSTNM']));
			echo '</p>';
		}
	}
	  $record = $records[$_GET['record']];
	  $record = array_combine($map, $record);
	  echo (html_link_table::table($record));
	}
}	
	  class html_link_table 
	  {
		public static function link($href, $a) 
		{
			$html = '<a href="' . $href . '">' . $a . '</a>';	
		return $html;
		}
		public static function table($record) 
		{
			$html = "<table>";
			foreach($record as $key => $value) 
			{
				$html .= "<tr>";
				$html .= "<th align='left'> $key </th> <td> $value </td>";
				$html .= "</tr>";
			}		
		$html .= "</table>";
		
		return $html;
		}
	  }
	$newfile = filehandling::readfile_csv("hd2013.csv",TRUE);
	$newfile2 = filehandling::readfile_csv("data.csv",TRUE);
	$new_map = map_new_file::create_map($newfile2);
	
	filehandling::print_table_links($newfile,$new_map);
	class map_new_file
	{
		public static function create_map($file_handler) 
		{
			foreach($file_handler as $array23) 
		{
			$key = $array23['varname'];
			$value = $array23['varTitle'];
			$map[$key] = $value;		
		}
		return $map;	
		}
	}
?>