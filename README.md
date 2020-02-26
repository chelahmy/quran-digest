# The Quran Digest
A utility to digest digital Quran based on the [Merkle tree](https://en.wikipedia.org/wiki/Merkle_tree) algorithm popularly used to hash transactions in the Bitcoin blockchain. It produces a 256-bit hash which is also known as Merkle root. As long as the digital Quran text has not been altered the hash will remain the same. Altering even a single letter in the text will strikingly change the hash. It is a good practice to digest the digital Quran every time it is referred to, and compare the hash with the original one. The following is the current digest/hash or the Merkle root of the digital Quran text:
### 1785690e5cf8c23f5a4bb40ca28806f422ef49053f005d61e7dd519f63068b07
We intent to inscribe the hash into the Bitcoin blockchain so that it will be an everlasting reference. The hash above may get hacked but the one inscribed in the Bitcoin blockchain will be well-preserved. The Bitcoin blockchain is becoming the platform of digital archiving.

## The Quran and the Utility
[The digital Quran text](utils/quran-uthmani.txt) for this utility was copied from [Tanzil.net](http://tanzil.net/). The original text was encoded in UTF-8 Unicode. Every verse was kept in a single line and terminated with CR/LF. The text file and its original name are kept as-is. The [indexer.php](utils/indexer.php) utility reads the digital Quran text file and builds an index file which is used to efficiently access any verse in the text. The [verse.php](utils/verse.php) utility reads a single verse and print it out into a CLI terminal together with both the fresh hash of the verse and the fresh hash Merkle root of the source digital Quran. The utility takes only a couple of seconds to produce both hashes.

## The Digest Method
A verse is re-encoded into a 16-bit Unicode string with no CR/LF. A double [SHA-256](https://en.wikipedia.org/wiki/SHA-2) is applied to the string to produce the verse hash. On the other hand, the Merkle root of the entire Quran is produced from the hashes of all verses. Every Merkle node is produced with double SHA-256. Please refer to the [Merkle tree](https://en.wikipedia.org/wiki/Merkle_tree) algorithm for detail.

## How-to
This utility requires PHP 7 [CLI](https://en.wikipedia.org/wiki/Command-line_interface).

Clone or download this repository:
```
$ git clone https://github.com/chelahmy/quran-digest.git
$ cd quran-digest/utils
```

Build the verse index once, and every time the digital Quran text is corrected:
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
