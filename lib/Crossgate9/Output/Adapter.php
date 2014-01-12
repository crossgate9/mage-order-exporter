<?php

class Crossgate9_Output_Adapter {
    const ADAPTER_CSV = 'Csv';
    const ADAPTER_PHPEXCEL = 'PHPEXCEL';

    public static function factory($_adapter) {
        switch ($_adapter) {
            case self::ADAPTER_CSV:
                return new Crossgate9_Output_Adapter_Csv();
                break;

            case self::ADAPTER_PHPEXCEL:
                return new Crossgate9_Output_Adapter_PhpExcel();
                break;

            default:
                return new Crossgate9_Output_Adapter_CSV();
                break;
        }
    }
}