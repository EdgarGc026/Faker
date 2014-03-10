<?php

namespace Faker\Provider;

/**
 * @see http://en.wikipedia.org/wiki/EAN-13
 */
class Barcode extends \Faker\Provider\Base
{
    private function ean($length=13)
    {
        $code = array();
        for($i = 0; $i < $length - 1; $i++) {
            $code[] = static::randomDigit();
        }

        $sequence = $length == 8 ? array(3, 1) : array(1, 3);

        $sums = 0;
        foreach($code as $n => $digit) {
            $sums += $digit * $sequence[$n % 2];
        }

        $checksum = (10 - $sums % 10) % 10;
        return implode('', $code) . $checksum;
    }

    public function ean13()
    {
        return $this->ean(13);
    }

    public function ean8()
    {
        return $this->ean(8);
    }
}
