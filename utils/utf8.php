<?php
// utf8.php
// UTF-8 File Reader
// By Abdullah Daud
// chelahmy@gmail.com
// 17 February 2020

/**
 * Reading a line of word array wrapped in UTF-8 encoding
 * from a file stream. The line must end with CR/LF.
 * Note: In PHP, bitwise operations are applicable on decimal
 * numbers, but not on binary numbers. Hence, the binary data
 * from a UTF-8 encoded file has to be converted to decimal byte
 * for bitwise operations during UTF-8 decoding.
 */
function readLineUTF8($sfp) {
	$line = '';
	$words = [];
	while (!feof($sfp)) {
		$data = fread($sfp, 1);
		if ($data === FALSE) break;
		$line .= $data;
		$byte = hexdec(bin2hex($data)); // bin->hex->dec
		if (($byte & 0x80) == 0x00) { // 1-byte UTF-8
			$code = $byte & 0x7F;
			if ($code == 0x0D) {	// CR. Expecting to be followed with LF
				$data = fread($sfp, 1);
				if ($data === FALSE) break;
				$line .= $data;
				$byte = hexdec(bin2hex($data)); // bin->hex->dec
				if (($byte & 0x80) == 0x00) { // 1-byte UTF-8
					$code = $byte & 0x7F;
					if ($code != 0x0A) return FALSE; // Missing LF
					break;
				}
			}
			else
				$words[] = $code;
		}
		else if (($byte & 0xE0) == 0xC0) { // 2-byte UTF-8
			$code = $byte & 0x1F;
			$data = fread($sfp, 1);
			if ($data === FALSE) break;
			$line .= $data;
			$byte = hexdec(bin2hex($data)); // bin->hex->dec
			if (($byte & 0xC0) == 0x80) {
				$code <<= 6;
				$code |= $byte & 0x3F;
				$words[] = $code;
			}
			else return FALSE;
		}
		else if (($byte & 0xF0) == 0xE0) { // 3-byte UTF-8
			$code = $byte & 0x0F;
			$data = fread($sfp, 1);
			if ($data === FALSE) break;
			$line .= $data;
			$byte = hexdec(bin2hex($data)); // bin->hex->dec
			if (($byte & 0xC0) == 0x80) {
				$code <<= 6;
				$code |= $byte & 0x3F;
				$data = fread($sfp, 1);
				if ($data === FALSE) break;
				$line .= $data;
				$byte = hexdec(bin2hex($data)); // bin->hex->dec
				if (($byte & 0xC0) == 0x80) {
					$code <<= 6;
					$code |= $byte & 0x3F;
					$words[] = $code;		
				}
				else return FALSE;
			}
			else return FALSE;
		}
		else if (($byte & 0xF8) == 0xF0) { // 4-byte UTF-8
			$code = $byte & 0x07;
			$data = fread($sfp, 1);
			if ($data === FALSE) break;
			$line .= $data;
			$byte = hexdec(bin2hex($data)); // bin->hex->dec
			if (($byte & 0xC0) == 0x80) {
				$code <<= 6;
				$code |= $byte & 0x3F;
				$data = fread($sfp, 1);
				if ($data === FALSE) break;
				$line .= $data;
				$byte = hexdec(bin2hex($data)); // bin->hex->dec
				if (($byte & 0xC0) == 0x80) {
					$code <<= 6;
					$code |= $byte & 0x3F;
					$data = fread($sfp, 1);
					if ($data === FALSE) break;
					$line .= $data;
					$byte = hexdec(bin2hex($data)); // bin->hex->dec
					if (($byte & 0xC0) == 0x80) {
						$code <<= 6;
						$code |= $byte & 0x3F;
						$words[] = $code;
					}
					else return FALSE;
				}
				else return FALSE;
			}
			else return FALSE;
		}
		else return FALSE;
	}
	return [ "utf8" => $line, "words" => $words ];
}

?>
