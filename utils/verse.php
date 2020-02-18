<?php
// verse.php
// Quranic verse extractor
// By Abdullah Daud
// chelahmy@gmail.com
// 17 February 2020
//
// Based on Tanzil Quran Text (Uthmani) version 1.0.2
// Source tanzil.net. See tanzil_license.txt.

include_once "surah.php";
include_once "tanzil.php";
include_once "utils.php";

// Get user input.
echo "Verse number [1-6236] or [surah number:verse]? ";
$input = trim(fgets(STDIN));
if (strlen($input) <= 0) die();
if (strpos($input, ':') !== FALSE) {
	$parts = explode(':', $input);
	if ($parts === FALSE || count($parts) < 2) die();
	$surah_idx = $parts[0] - 1;
	$verse_idx = $parts[1] - 1;
	$surah = getSurah($surah_idx);
	if ($surah === FALSE) die();
	echo $surah["name"] . " - " . $surah["verses"] . " verses\n";
	if ($verse_idx < 0 || $verse_idx >= $surah["verses"]) die();
	$index = $surah["offset"] + $verse_idx;
}
else if ($input < 1 || $input > 6236) die();
else
	$index = $input - 1;

// Get verse
$verse = getVerseByIndex($index);
if ($verse === FALSE) { die("Error in getting the verse from source.\n"); }

// Write to the target file
$target = "verse.txt";
$tfp = fopen($target, "w");
if ($tfp === FALSE) { die("Can't open target file.\n"); }
if (fwrite($tfp, $verse["utf8"]) === FALSE) { fclose($tfp); die("Can't write to target file.\n"); }
fclose($tfp);

// Print out
//echo bin2hex($verse["utf8"]) . "\n"; // used to capture hex string of bismi
//echo $verse["utf8"] . "\n"; // the original verse from the source
$v = skipBismiUTF8($verse["utf8"]);
echo "$v\n";
$w = skipBismiUnicode($verse["words"]);
listWords($w);
$h = hashVerse($w);
echo "Verse $input data:\n" . $h["data"] . "\n";
echo "Verse $input double SHA-256 hash:\n" . $h["hash"] . "\n";
$mr = generateMerkleRoot();
echo "Merkle root:\n" . $mr["root"] . "\n";
echo "Merkle tree nodes:\n" . implode(", ", $mr["nodes"]) . "\n";
echo "\nThe original verse $input has been copied into $target file.\n";
?>
