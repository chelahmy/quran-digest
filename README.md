# The Quran Digest
A utility to digest or hash the Quran digital text based on the [Merkle tree](https://en.wikipedia.org/wiki/Merkle_tree) algorithm popularly used to hash transactions in the Bitcoin blockchain. It produces a 256-bit hash which is also known as Merkle root. As long as the Quran text has not been altered the hash will remain the same. Altering even a single letter in the text will strikingly change the hash. It is a good practice to digest the Quran every time it is referred to, and compare the hash with the original one. The following is the current digest/hash or the Merkle root of the Quran digital text:
### c64cdf21712d30e47d53a1e0b39c232a4ee2171ccf70161c6d91b2639ca667bc
We intent to inscribe the hash into the Bitcoin blockchain so that it will be an everlasting reference. The hash above may get hacked but the one inscribed in the Bitcoin blockchain will be well-preserved. The Bitcoin blockchain is becoming the platform of digital archiving.

## The Quran and the Utility
[The Quran digital text](utils/quran-uthmani.txt) for this utility was copied from [Tanzil.net](http://tanzil.net/). The original text was encoded in UTF-8 Unicode. Every verse was kept in a single line and terminated with CR/LF. The text file and its original name are kept as-is. The [indexer.php](utils/indexer.php) utility reads the Quran digital text file and builds an index file which is used to efficiently access any verse in the text. The [verse.php](utils/verse.php) utility reads a single surah and print it out into a CLI terminal together with both the freshly hash of the verse and the freshly hash Merkle root of the entire Quran. The utility takes only a couple of seconds to produce both hashes.

## The Digest Method
A verse is re-encoded into a 16-bit Unicode uppercase hexadecimal string with no CR/LF. A double [SHA-256](https://en.wikipedia.org/wiki/SHA-2) is applied to the string to produce the verse hash. On the other hand, the Merkle root of the entire Quran is produced from the hashes of all verses. Every Merkle node is produced with double SHA-256. Please refer to the [Merkle tree](https://en.wikipedia.org/wiki/Merkle_tree) algorithm for detail.

## How-to
This utility requires PHP 7 [CLI](https://en.wikipedia.org/wiki/Command-line_interface).

Clone or download this repository:
```
$ git clone https://github.com/chelahmy/quran-digest.git
$ cd quran-digest/utils
```

Build the verse index once, and every time the Quran digital text is corrected:
```
$ php indexer.php
```

Print out a verse into the terminal:
```
$ php verse.php
```
You may use [BiCon](https://github.com/behdad/bicon) to enable bi-directional terminal on Linux. BiCon depends on **libfribidi0** and **libfribidi-dev**. 

## The PHP Library
The PHP scripts for this utility were designed to be re-useable, which can be embedded into any application or web application. The scripts are the documents.
