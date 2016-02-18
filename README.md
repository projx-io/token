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
      ->validateEncode(new IsArrayValidation())     // 1.
      ->pack()                                      // 2.     
      ->compress()                                  // 3.
      ->encryptedRandomVector($key)                 // 4.
      ->base64()                                    // 5.
      ->validateDecode(new IsStringValidation());   // 6.

  // The chain performs the following:
  // 
  // Encoding (read chain from top to bottom):
  // 1. verify value is an array 
  // 2. convert array into binary string 
  // 3. gzip deflate
  // 4. encrypt with key and random vector (which is prepended to value to be read when decoding)
  // 5. encode binary into string via base64 
  // 
  // Decoding (read chain from bottom to top):
  // 6. verify that value is a string
  // 5. decode string into binary via base64 
  // 4. decrypt binary with key and parsed vector
  // 3. gzip inflate
  // 2. parse binary string into array 
  
  // The following builds the packer, which is an encoder that uses pack() to convert an array into a binary string.
  // With the following
  $encoderBuilder->packer()
      ->uint32BE('created')
      ->uint32BE('app_id')
      ->uint32BE('user_id');

  $encoder = $encoderBuilder->build();
  
  $token = $encoder->encodeToken([strtotime('now'), 5, 16]);
  echo json_encode($token) . "\n";
  // "9zxpVdE3QnDfAvTVcktpdz7R5A18rHP\/3ZXX9BaI"

  $decoded = $encoder->decodeToken($token);
  echo json_encode($decoded) . "\n";
  // {"created":1455760831,"app_id":5,"user_id":16}
  
```
