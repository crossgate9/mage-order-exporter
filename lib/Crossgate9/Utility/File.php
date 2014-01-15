<?php

class Crossgate9_Utility_File {
    public static function generateFilename($_prefix='', $_pad_length=8, $_suffix='') {
        return $_prefix . Crossgate9_Utility::randomString($_pad_length) . $_suffix;
    }
}