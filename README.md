[![Build Status](https://travis-ci.org/projx-io/token.svg)](https://travis-ci.org/projx-io/token)

# Tokenizer

http://github.com:projx-io/token.git

## Install

**composer**: `composer install projx/token`

## Usage

```php
  // The key used to encrypt the token. This ideally would not be random, and would be saved somewhere.
  $key = openssl_random_pseudo_bytes(32);           

  $encoderBuilder = (new EncoderBuilder())
      ->validateEncode(new IsArrayValidation())     // 1. add encode validation encoder
      ->pack()                                      // 2. add pack encoder
      ->compress()                                  // 3. add gzip encoder
      ->encryptedRandomVector($key)                 // 4. add encryption encoder
      ->base64()                                    // 5. add base64 encoder
      ->validateDecode(new IsStringValidation());   // 6. add decode validation encoder

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
      ->uint32BE('created')   // 1. encoding: expect 32bit int; decoding: name the int 'created'
      ->uint32BE('app_id')    // 2. encoding: expect 32bit int; decoding: name the int 'app_id'
      ->uint32BE('user_id');  // 3. encoding: expect 32bit int; decoding: name the int 'user_id'

  $encoder = $encoderBuilder->build();
  
  $token = $encoder->encodeToken([strtotime('now'), 5, 16]);
  echo json_encode($token) . "\n";
  // "9zxpVdE3QnDfAvTVcktpdz7R5A18rHP\/3ZXX9BaI"

  $decoded = $encoder->decodeToken($token);
  echo json_encode($decoded) . "\n";
  // {"created":1455760831,"app_id":5,"user_id":16}
  
```
