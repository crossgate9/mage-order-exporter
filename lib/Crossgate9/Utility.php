<?php

class Crossgate9_Utility {
    public static function alp2num($_str) {
        $_str = strtoupper($_str);
        $_len = strlen($_str);
        $_res = 0;
        for($i = 0; $i < $_len; $i++) {
            $_res = $_res * 26 + ord($_str[$i]) - 64;
        }
        return $_res;
    }
}