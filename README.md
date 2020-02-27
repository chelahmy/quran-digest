# The Quran Digest
A utility to digest digital Quran based on the [Merkle tree](https://en.wikipedia.org/wiki/Merkle_tree) algorithm which is widely used in many document sharing applications. One of the application using Merkle tree algorithm is Bitcoin which applies the algorithm to hash transactions in its blockchain. The Merkle tree algorithm is used to digest large document into a hash which is also known as Merkle root. Every time the same unaltered document is digested the same hash will be produced. In the case of the digital Quran, as long as the text has not been altered the hash will remain the same. Altering even a single letter in the text will strikingly change the hash. In this era of digital fake, it is a good practice to digest the digital Quran every time it is referred to, and compare the hash with the original one. The following is the current digest/hash or the Merkle root of the digital Quran text:
### 1785690e5cf8c23f5a4bb40ca28806f422ef49053f005d61e7dd519f63068b07
It is a fixed-length 256-bit hash as the result of double [SHA-256](https://en.wikipedia.org/wiki/SHA-2) digesting on every verse in the digital Quran as the leaf nodes and every node in the Merkle tree.

## An Extreme Step Further
The hash above may get hacked. Hence, we inscribed the digital Quran digest in the Bitcoin blockchain for eternal preservation. The Bitcoin blockchain is evolving beyond cryptocurrency and is becoming the platform of digital archiving. No hacker has ever managed to alter even a bit of the Bitcoin blockchain since its inception in 2009. The following is the Bitcoin transaction id containing the digital Quran digest:
### [1ed1bc36999eacadcbd79e834c652ea88de7b67f4bf1661e17ce3fcfda4b644e](https://sochain.com/tx/BTC/1ed1bc36999eacadcbd79e834c652ea88de7b67f4bf1661e17ce3fcfda4b644e)
The transaction can be viewed in [sochain.com](https://sochain.com/tx/BTC/1ed1bc36999eacadcbd79e834c652ea88de7b67f4bf1661e17ce3fcfda4b644e) or many other similar services. The hash is attached to the end of a hexadecimal encoded string initial "Secure Digital Quran v1.0.0 https://qauth.org" in the script of the transaction output 1 which begins with [OP_RETURN](https://github.com/chelahmy/php-OP_RETURN).


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
