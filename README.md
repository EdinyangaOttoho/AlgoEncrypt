# AlgoEncrypt
An encryption tool that leverages base64 decode in encryption and decryption of data

## Usage
Simply include the src.php file in your script and then harness the various functions therein. AlgoEncrypt involves support for OOP and Procedural paradigms. To use OOP, simply create an instance of the class Algo, which has three methods. encrypt(), decrypt() and verify(). In the procedural paradigm, you use algo_hash() function and the algo_verfify function only.

The first step is including the script in your project thus;
```php
  include("./AlgoEncrypt/src.php");
```

### OOP Paradigm
  To use the OOP functions, you have to create an instance of the class thus;
```php
  $algo = new Algo();
```
Then, you use the methods of the class in encryption, verification and decryption.

#### Encrypt
  To encrypt, use;
```php
  $algo->encrypt($string);
```
Where $string is a string-typed variable.

#### Decrypt
  To encrypt, use;
```php
  $algo->decrypt($string);
```
Where $string is a string-typed hashed value (generated from AlgoEncrypt).

#### Verify
  To verify a string to match with a hash, use;
```php
  $algo->verify($hash, $string);
```
Where $string is a string-typed variable and $hash is the hashed value to match/compare with for likeness. It returns true if matched properly, else returns false;


### Procedural Paradigm
There are two functions usable in the procedural technique (for those who hate OOP 😉😉), which are algo_hash() and algo_verify(). It still depends on the Algo() class by the way.

#### algo_hash
  This is used to hash a string, thus;
```php
  algo_hash($string);
```
Where $string is a string-typed variable.

#### algo_verify
  This is similar to the verify() method (function) in the Algo class, thus;
'''php
  algo_verify($hash, $string);
'''
Where $string is a string-typed variable and $hash is the hashed value to match/compare with for likeness. It returns true if matched properly, else returns false;

##Installation
Installation is very simple. Just clone this repository, and then include it in whichever script you want to use as shown above. Thanks

##Contributors
Well, JsonQL was built wholly by me. You could buy me a cup of coffee. Contact me also via +2348117093601. I am a founding member and CEO of Fussion DEV (fussiondev@gmail.com)
