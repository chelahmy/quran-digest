<?php
// inskripblok.php
// The Digital Quran inskripBlok
// By Abdullah Daud
// chelahmy@gmail.com
// 26 February 2020
//

$quranhash = "1785690e5cf8c23f5a4bb40ca28806f422ef49053f005d61e7dd519f63068b07";
$initial = "Secure Digital Quran v1.0.0 https://qauth.org - ";
$hexinit = bin2hex($initial);
$inskripblok = $hexinit . $quranhash;

echo intval(strlen($quranhash) / 2) . " " . $quranhash . PHP_EOL;
echo strlen($initial) . " " . $initial . PHP_EOL;
echo intval(strlen($hexinit) / 2) . " " . $hexinit . PHP_EOL;
echo intval(strlen($inskripblok) / 2) . " " . $inskripblok . PHP_EOL;
echo hex2bin($inskripblok) . PHP_EOL;
