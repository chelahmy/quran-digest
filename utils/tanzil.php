<?php
// tanzil.php
// Tanzil Quran Text
// By Abdullah Daud
// chelahmy@gmail.com
// 18 February 2020
//
// Based on Tanzil Quran Text (Uthmani) version 1.0.2
// Source tanzil.net. See tanzil_license.txt.

include_once "utf8.php";
include_once "unicode.php";

$TanzilSource = "quran-uthmani.txt";
$TanzilIndex = "quran-uthmani.idx";

function rebuildIndex() {
	global $TanzilSource;
	global $TanzilIndex;
	$sfp = fopen($TanzilSource, "r");
	if ($sfp === FALSE) return FALSE;
	$ifp = fopen($TanzilIndex, "w");
	if ($ifp === FALSE) { fclose($sfp);	return FALSE; }
	$line = 0;
	while (!feof($sfp) && readLineUTF8($sfp) !== FALSE) {
		++$line;
		$pos = ftell($sfp);
		if ($pos === FALSE) break;
		$idx = pack('L', $pos);
		if (fwrite($ifp, $idx, 4) != 4) { fclose($ifp); fclose($sfp); return FALSE; }
	}
	return $line;
}

function getVerseByIndex($index) {
	global $TanzilSource;
	global $TanzilIndex;
	$sfp = fopen($TanzilSource, "r");
	if ($sfp === FALSE) return FALSE;
	$ifp = fopen($TanzilIndex, "r");
	if ($ifp === FALSE) { fclose($sfp);	return FALSE; }
	$pos = 0;
	if ($index > 0) {
		if (fseek($ifp, ($index - 1) * 4) == -1) { fclose($ifp); fclose($sfp); return FALSE; }
		$idata = fread($ifp, 4);
		if ($idata === FALSE) { fclose($ifp); fclose($sfp); return FALSE; }
		$pos = unpack('L', $idata);
		if (is_array($pos))
			$pos = $pos[1];
	}
	if (fseek($sfp, $pos) == -1) { fclose($ifp); fclose($sfp); return FALSE; }
	$line = readLineUTF8($sfp);
	fclose($ifp);
	fclose($sfp);
	return $line;
}

function listWords($words) {
	$aun = getArabicUnicodeNames();
	$idx = 0;
	foreach ($words as $w) {
		++$idx;
		$h = sprintf('%04X', $w);
		if ($aun !== FALSE && isset($aun[$h]))
			echo $idx . ": U-$h " . $aun[$h]  . "\n";
		else
			echo $idx . ": U-$h\n";
		echo html_entity_decode("&#x$h;", ENT_COMPAT, 'UTF-8') . "\n";
	}
}

?>

