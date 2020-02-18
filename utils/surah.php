<?php
// surah.php
// Quranic surah list
// By Abdullah Daud
// chelahmy@gmail.com
// 17 February 2020

$SurahList = [
	["Al-Fatihah", 7],
	["Al-Baqarah", 286],
	["Ali Imran", 200],
	["An-Nisaa'", 176],
	["Al-Ma'idah", 120],
	["Al-An'am", 165],
	["Al-A'raaf", 206],
	["Al-Anfaal", 75],
	["At-Taubah", 129],
	["Yunus", 109],
	["Hud", 123],
	["Yusuf", 111],
	["Ar-Ra'd", 43],
	["Ibrahim", 52],
	["Al-Hijr", 99],
	["An-Nahl", 128],
	["Al-Israa'", 111],
	["Al-Kahfi", 110],
	["Maryam", 98],
	["Taahaa", 135],
	["Al-Anbiyaa'", 112],
	["Al-Hajj", 78],
	["Al-Mu'minun", 118],
	["An-Nuur", 64],
	["Al-Furqaan", 77],
	["Asy-Syu'araa", 227],
	["An-Naml", 93],
	["Al-Qasas", 88],
	["Al-'Ankabut", 69],
	["Ar-Rum", 60],
	["Luqman", 34],
	["As-Sajdah", 30],
	["Al-Ahzab", 73],
	["Saba'", 54],
	["Faatir", 45],
	["Yaasin", 83],
	["As-Saaffat", 182],
	["Saad", 88],
	["Az-Zumar", 75],
	["Al-Mu'min/Ghaafir", 85],
	["Fussilat", 54],
	["Asy-Syuraa",53],
	["Az-Zukhruf", 89],
	["Ad-Dukhaan", 59],
	["Al-Jatsiyah", 37],
	["Al-Ahqaaf", 35],
	["Muhammad", 38],
	["Al-Fath", 29],
	["Al-Hujurat", 18],
	["Qaf", 45],
	["Adz-Dzariyaat", 60],
	["At-Tur", 49],
	["An-Najm", 62],
	["Al-Qamar", 55],
	["Ar-Rahman", 78],
	["Al-Waqi'ah", 96],
	["Al-Hadid", 29],
	["Al-Mujadilah", 22],
	["Al-Hasyr", 24],
	["Al-Mumtahanah", 13],
	["As-Saff", 14],
	["Al-Jumu'ah", 11],
	["Al-Munafiqun", 11],
	["At-Taghabun", 18],
	["At-Talaq", 12],
	["At-Tahrim", 12],
	["Al-Mulk", 30],
	["Al-Qalam", 52],
	["Al-Haaqqah", 52],
	["Al-Ma'arij", 44],
	["Nuh", 28],
	["Al-Jin", 28],
	["Al-Muzzammil", 20],
	["Al-Muddathir", 56],
	["Al-Qiyamah", 40],
	["Al-Insan", 31],
	["Al-Mursalat", 50],
	["An-Naba", 40],
	["An-Naziat", 46],
	["Abasa", 42],
	["At-Takwir", 29],
	["Al-Infitar", 19],
	["Al-Mutaffifin", 36],
	["Al-Inshiqaq", 25],
	["Al-Buruj", 22],
	["At-Tariq", 17],
	["Al-A'laa", 19],
	["Al-Ghashiya", 26],
	["Al-Fajr", 30],
	["Al-Balad", 20],
	["Asy-Syams", 15],
	["Al-Lail", 21],
	["Ad-Dhuha", 11],
	["Al-Insyirah", 8],
	["At-Tin", 8],
	["Al-Alaq", 19],
	["Al-Qadr", 5],
	["Al-Bayyinah", 8],
	["Az-Zalzalah", 8],
	["Al-Adiyat", 11],
	["Al-Qaria", 11],
	["At-Takathur", 8],
	["Al-Asr", 3],
	["Al-Humaza", 9],
	["Al-Fil", 5],
	["Quraysh", 4],
	["Al-Ma'un", 7],
	["Al-Kawthar", 3],
	["Al-Kafirun", 6],
	["An-Nasr", 3],
	["Al-Masadd", 5],
	["Al-Ikhlas", 4],
	["Al-Falaq", 5],
	["An-Nas", 6]	
];

function getSurah($surah_idx) {
	global $SurahList;
	if ($surah_idx < 0 || $surah_idx >= 114) return FALSE;
	$idx = $SurahList[$surah_idx];
	$name = $idx[0];
	$verses = $idx[1];
	$offset = 0;
	for ($i = 0; $i < $surah_idx; ++$i) {
		$idx = $SurahList[$i];
		$offset += $idx[1];
	}
	return ["offset" => $offset, "name" => $name, "verses" => $verses];
}


?>