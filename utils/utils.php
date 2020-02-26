<?php
// utils.php
// Utility functions
// By Abdullah Daud
// chelahmy@gmail.com
// 18 February 2020
//
// Based on Tanzil Quran Text (Uthmani) version 1.0.2
// Source tanzil.net. See tanzil_license.txt.

include_once "tanzil.php";

/**
 * Tanzil Quran Text prepended bismi to every first ayat.
 * This function is to skip bismi to get to the first ayat.
 * The parameter $line is UTF-8 binary string. It will be
 * converted to hex string for comparing with the hard-coded
 * bismi hex strings. If $line starts with bismi then the
 * bismi part will be discarded and the rest will be returned.
 * Otherwise, it will be returned as is.
 * Note: The shorten 'bismi' is used instead of the longer
 * phrase because of the evil connotation when it is prepended
 * with 'skip'.
 */
function skipBismiUTF8($line) {
	// Hex string of UTF-8 bismi string.
	$bismi = "d8a8d990d8b3d992d985d99020d9b1d984d984d991d98ed987d99020d9b1d984d8b1d991d98ed8add992d985d98ed9b0d986d99020d9b1d984d8b1d991d98ed8add990d98ad985d99020";
	// Bismi with a sign of continuation from the last ayat of previous surah (95 & 97).
	$bismi2 = "d8a8d991d990d8b3d992d985d99020d9b1d984d984d991d98ed987d99020d9b1d984d8b1d991d98ed8add992d985d98ed9b0d986d99020d9b1d984d8b1d991d98ed8add990d98ad985d99020";
	$bismi_len = strlen($bismi); 
	$bismi2_len = strlen($bismi2); 
	$hex = bin2hex($line);
	if (strlen($hex) >= $bismi_len && strncmp($hex, $bismi, $bismi_len) == 0) {
		$post = substr($hex, $bismi_len);
		return hex2bin($post);
	}
	else if (strlen($hex) >= $bismi2_len && strncmp($hex, $bismi2, $bismi2_len) == 0) {
		$post = substr($hex, $bismi2_len);
		return hex2bin($post);
	}
	return $line;
}

/**
 * See comments on skipBismiUTF8().
 */
function skipBismiUnicode($words) {
	$bismi = [
		0x0628,0x0650,0x0633,0x0652,0x0645,0x0650,0x0020,0x0671,0x0644,0x0644,
		0x0651,0x064E,0x0647,0x0650,0x0020,0x0671,0x0644,0x0631,0x0651,0x064E,
		0x062D,0x0652,0x0645,0x064E,0x0670,0x0646,0x0650,0x0020,0x0671,0x0644,
		0x0631,0x0651,0x064E,0x062D,0x0650,0x064A,0x0645,0x0650,0x0020];
	$bismi2 = [
		0x0628,0x0651,0x0650,0x0633,0x0652,0x0645,0x0650,0x0020,0x0671,0x0644,0x0644,
		0x0651,0x064E,0x0647,0x0650,0x0020,0x0671,0x0644,0x0631,0x0651,0x064E,
		0x062D,0x0652,0x0645,0x064E,0x0670,0x0646,0x0650,0x0020,0x0671,0x0644,
		0x0631,0x0651,0x064E,0x062D,0x0650,0x064A,0x0645,0x0650,0x0020];
	$bismi_len = count($bismi);
	$bismi2_len = count($bismi2);
	$len = count($words);
	if ($len >= $bismi_len) {
		for ($i = 0; $i < $bismi_len; $i++) {
			if ($words[$i] != $bismi[$i])
				break;
		}
		if ($i == $bismi_len)
			return array_slice($words, $bismi_len);
	}
	if ($len >= $bismi2_len) {
		for ($i = 0; $i < $bismi2_len; $i++) {
			if ($words[$i] != $bismi2[$i])
				break;
		}
		if ($i == $bismi2_len)
			return array_slice($words, $bismi2_len);
	}
	return $words;
}

function hashVerse($words) {
	$vhex = '';
	$len = count($words);
	for ($i = 0; $i < $len; $i++) {
		$vhex .= sprintf('%04X', $words[$i]);
	}
	$hash = hash('sha256', hex2bin(hash('sha256', hex2bin($vhex))));
	return ["data" => $vhex, "hash" => $hash];
}

function generateMerkleRoot() {
	$nodes = [];
	$hashes = [];
	for ($i = 0; $i < 6236; $i++) {
		$verse = getVerseByIndex($i);
		if ($verse === FALSE) return FALSE;
		$w = skipBismiUnicode($verse["words"]);
		$h = hashVerse($w);
		$hashes[] = $h["hash"];
	}
	while (($len = count($hashes)) > 1) {
		$nodes[] = $len;
		$ths = [];
		for ($i = 0; $i < $len; $i += 2) {
			if (($i + 1) < $len)
				$hh = $hashes[$i] . $hashes[$i + 1];
			else
				$hh = $hashes[$i] . $hashes[$i];
			$ths[] = hash('sha256', hex2bin(hash('sha256', hex2bin($hh))));
		}
		$hashes = $ths;
	}
	return [ "root" => $hashes[0], "nodes" => $nodes ];
}

?>
