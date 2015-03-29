<?php
echo "<html><body><table>\n\n";
$csv = fopen("hd2013.csv", "r");
	while(($line = fgetcsv($csv)) !== FALSE);
	{
	$count = 0;
	echo "<tr>";
	foreach($line as $cell)
	{
		if($count<3)
		{
			echo "<td>" . htmlspecialchars($cell) . "</td>";
			$count++;
		}
	}
	echo "<tr>\n";
}
fclose($csv);
echo "\n</table></body></html>";
?>
