[![Build Status](https://travis-ci.org/projx-io/token.svg)](https://travis-ci.org/projx-io/token)

# Tokenizer

http://github.com:projx-io/token.git

## Install

**composer**: `composer install projx/token`

## Usage

```php
  // key used to encrypt the token
  $key = openssl_random_pseudo_bytes(32);           

  $encoderBuilder = (new EncoderBuilder())
      ->validateEncode(new IsArrayValidation())
      ->pack()                                      
      ->compress()                                  
      ->encryptedRandomVector($key)                 
      ->base64()
      ->validateDecode(new IsStringValidation());


  // Encoding (read chain from top to bottom):
  // 1. verify value is an array 
  // 2. convert array into binary string 
  // 3. gzip deflate
  // 4. encrypt with key and random vector (which is prepended to value to be read when decoding)
  // 5. encode binary into string via base64 

  // Decoding (read chain from bottom to top):
  // 6. verify that value is a string
  // 5. decode string into binary via base64 
  // 4. decrypt binary with key and parsed vector
  // 3. gzip inflate
  // 2. parse binary string into array 
  $encoderBuilder->packer()
      ->uint32BE('app_id')
      ->uint32BE('app_id')
      ->uint32BE('app_id')
      ->uint32BE('app_id')
      ->uint32BE('user_id');

  $encoder = $encoderBuilder->build();
  
  $token = $encoder->encodeToken([5, 16]);

  $decoded = $encoder->decodeToken($token);

  
```
