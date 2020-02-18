<?php
// unicode.php
// Unicode Names List
// By Abdullah Daud
// chelahmy@gmail.com
// 19 February 2020

function getArabicUnicodeNames() {
	$sfp = fopen("NamesList.txt", "r");
	if ($sfp === FALSE) return FALSE;
	$names = [];
	while (($line = fgets($sfp)) !== false) {
		$s = substr($line, 0, 2);
		if ($s === "00" || $s === "06") {
			$code = substr($line, 0, 4);
			$name = trim(substr($line, 4));
			$names[$code] = $name;
		}
	}
	
	fclose($sfp);
	return $names;
}

?>
