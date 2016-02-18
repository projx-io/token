<?php

namespace ProjxIO\Token;

use ProjxIO\Token\GZip\GZipInflateEncoder;
use ProjxIO\Token\OpenSSL\FixedVectorOpenSSLEncoder;
use ProjxIO\Token\OpenSSL\RandomVectorOpenSSLEncoder;
use ProjxIO\Token\Pack\PackEncoder;
use ProjxIO\Token\Pack\PackEncoderBuilder;
use ProjxIO\Token\Validation\Validation;
use ProjxIO\Token\Validation\Validator;

class EncoderBuilder
{
    /**
     * @var Encoder[]
     */
    private $encoders = [];

    /**
     * @var PackEncoderBuilder
     */
    private $packer;

    /**
     */
    public function __construct()
    {
        $this->encoders = [];
        $this->packer = new PackEncoderBuilder();
    }

    /**
     * @param $key
     * @param Encoder $value
     * @return $this
     */
    public function put($key, Encoder $value)
    {
        $this->encoders[$key] = $value;

        return $this;
    }

    /**
     * @param Encoder $value
     * @return $this
     */
    public function add(Encoder $value)
    {
        $this->encoders[] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function encryptedRandomVector($key, $method = 'aes-256-cbc')
    {
        return $this->put('openssl', new RandomVectorOpenSSLEncoder($key, $method));
    }

    /**
     * @return $this
     */
    public function encryptedFixedVector($key, $vector, $method = 'aes-256-cbc')
    {
        return $this->put('openssl', new FixedVectorOpenSSLEncoder($key, $vector, $method));
    }

    /**
     * @return $this
     */
    public function json()
    {
        return $this->add(new JsonEncoder());
    }

    /**
     * @return $this
     */
    public function base64()
    {
        return $this->add(new Base64Encoder());
    }

    /**
     * @return $this
     */
    public function serialize()
    {
        return $this->add(new SerializeEncoder());
    }

    /**
     * @return $this
     */
    public function compress()
    {
        return $this->add(new GZipInflateEncoder());
    }

    /**
     * @return EncoderBuilder
     */
    public function pack()
    {
        return $this->put('pack', $this->packer->build());
    }

    /**
     * @return PackEncoderBuilder
     */
    public function packer()
    {
        return $this->packer;
    }

    /**
     * @param EncodeBehavior $encode
     * @return $this
     */
    public function onEncode(EncodeBehavior $encode)
    {
        return $this->add(new OnEncode($encode));
    }

    /**
     * @param DecodeBehavior $decode
     * @return $this
     */
    public function onDecode(DecodeBehavior $decode)
    {
        return $this->add(new OnDecode($decode));
    }

    /**
     * @param Validation $validation
     * @return $this
     */
    public function validate(Validation $validation)
    {
        return $this->add(new Validator($validation));
    }

    /**
     * @param Validation $validation
     * @return $this
     */
    public function validateEncode(Validation $validation)
    {
        return $this->onEncode(new Validator($validation));
    }

    /**
     * @param Validation $validation
     * @return $this
     */
    public function validateDecode(Validation $validation)
    {
        return $this->onDecode(new Validator($validation));
    }

    /**
     * @return Encoder
     */
    public function build()
    {
        if (array_key_exists('pack', $this->encoders)) {
            $this->put('pack', $this->packer->build());
        }

        return new CompositeEncoder($this->encoders);
    }
}
