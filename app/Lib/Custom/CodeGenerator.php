<?php

/**
 * Access code generation logic
 */
class CodeGenerator {
    
    private function __construct() {
        //prevent instantiation
        //force to use statically only
    }

    /**
     * Generates a random access code
     * https://gist.github.com/raveren/5555297
     * @param String $type 'alnum','alpha','hexdec','numeric','nozero','distinct'
     * @param int $length length of generated code
     * @return String random code
     */
    static function accessCode($type = 'alnum', $length = 6) {
        switch ($type) {
            case 'alnum':
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'alpha':
                $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'hexdec':
                $pool = '0123456789abcdef';
                break;
            case 'numeric':
                $pool = '0123456789';
                break;
            case 'nozero':
                $pool = '123456789';
                break;
            case 'distinct':
                $pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
                break;
            default:
                $pool = (string) $type;
                break;
        }


        $crypto_rand_secure = function ( $min, $max ) {
            $range = $max - $min;
            if ($range < 0)
                return $min; // not so random...
            $log = log($range, 2);
            $bytes = (int) ( $log / 8 ) + 1; // length in bytes
            $bits = (int) $log + 1; // length in bits
            $filter = (int) ( 1 << $bits ) - 1; // set all lower bits to 1
            do {
                $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
                $rnd = $rnd & $filter; // discard irrelevant bits
            } while ($rnd >= $range);
            return $min + $rnd;
        };

        $token = "";
        $max = strlen($pool);
        for ($i = 0; $i < $length; $i++) {
            $token .= $pool[$crypto_rand_secure(0, $max)];
        }
        return $token;
    }

}
