<?php
// indexer.php
// Quranic Text Indexer
// By Abdullah Daud
// chelahmy@gmail.com
// 15 February 2020
//
// Based on Tanzil Quran Text (Uthmani) version 1.0.2
// Source tanzil.net. See tanzil_license.txt.

include_once "tanzil.php";

echo "Building the index...\n";
$line = rebuildIndex();
echo "Index built $line\n";

?>
