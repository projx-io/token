<?php

namespace ProjxIO\Token\Pack;

class PackEncoderBuilder
{
    /**
     * @var array
     */
    private $values;

    /**
     * @var int
     */
    private $size = 0;

    /**
     * @return PackEncoder
     */
    public function build()
    {
        return new PackEncoder($this->values);
    }

    /**
     * @return int
     */
    public function size()
    {
        return $this->size;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->values);
    }

    /**
     * @param string $name
     * @param string $type
     * @return $this
     */
    public function put($name, $type)
    {
        $this->values[$name] = $type;
        return $this;
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function int16($name, $cardinality = 1)
    {
        $this->size += 2 * $cardinality;
        return $this->put($name, 's' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function uint16($name, $cardinality = 1)
    {
        $this->size += 2 * $cardinality;
        return $this->put($name, 'S' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function uint16BE($name, $cardinality = 1)
    {
        $this->size += 2 * $cardinality;
        return $this->put($name, 'n' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function uint16LE($name, $cardinality = 1)
    {
        $this->size += 2 * $cardinality;
        return $this->put($name, 'v' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function int32($name, $cardinality = 1)
    {
        $this->size += 4 * $cardinality;
        return $this->put($name, 'l' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function uint32($name, $cardinality = 1)
    {
        $this->size += 4 * $cardinality;
        return $this->put($name, 'L' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function uint32BE($name, $cardinality = 1)
    {
        $this->size += 4 * $cardinality;
        return $this->put($name, 'N' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function uint32LE($name, $cardinality = 1)
    {
        $this->size += 4 * $cardinality;
        return $this->put($name, 'V' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function int64($name, $cardinality = 1)
    {
        $this->size += 8 * $cardinality;
        return $this->put($name, 'q' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function uint64($name, $cardinality = 1)
    {
        $this->size += 8 * $cardinality;
        return $this->put($name, 'Q' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function uint64BE($name, $cardinality = 1)
    {
        $this->size += 8 * $cardinality;
        return $this->put($name, 'J' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function uint64LE($name, $cardinality = 1)
    {
        $this->size += 8 * $cardinality;
        return $this->put($name, 'P' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function stringNullPadded($name, $cardinality = 1)
    {
        return $this->put($name, 'a' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function stringSpacePadded($name, $cardinality = 1)
    {
        return $this->put($name, 'A' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function hexLowFirst($name, $cardinality = 1)
    {
        $this->size += 1 * $cardinality;
        return $this->put($name, 'h' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function hexHighFirst($name, $cardinality = 1)
    {
        $this->size += 1 * $cardinality;
        return $this->put($name, 'H' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function char($name, $cardinality = 1)
    {
        $this->size += 1 * $cardinality;
        return $this->put($name, 'c' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function uchar($name, $cardinality = 1)
    {
        $this->size += 1 * $cardinality;
        return $this->put($name, 'C' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function int($name, $cardinality = 1)
    {
        $this->size += 4 * $cardinality;
        return $this->put($name, 'i' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function uint($name, $cardinality = 1)
    {
        $this->size += 4 * $cardinality;
        return $this->put($name, 'I' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function float($name, $cardinality = 1)
    {
        $this->size += 4 * $cardinality;
        return $this->put($name, 'f' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function double($name, $cardinality = 1)
    {
        $this->size += 8 * $cardinality;
        return $this->put($name, 'd' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function null($name, $cardinality = 1)
    {
        $this->size += 1 * $cardinality;
        return $this->put($name, 'x' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function backupByte($name, $cardinality = 1)
    {
        $this->size += 1 * $cardinality;
        return $this->put($name, 'X' . (string)$cardinality);
    }

    /**
     * @param string $name
     * @param int $cardinality
     * @return PackEncoderBuilder
     */
    public function nullFil($name, $cardinality = 1)
    {
        $this->size += 1 * $cardinality;
        return $this->put($name, '@' . (string)$cardinality);
    }
}
