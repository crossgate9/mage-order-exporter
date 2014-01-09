<?php

class Crossgate9_Output_Adapter_Csv extends Crossgate9_Output_Adapter_Abstract {

    public function setCellValue($_cell, $_value) {
        // get column
        preg_match('/^[A-Z]*/', $_cell, $_col);
        $_col = Crossgate9_Utility::alp2num($_col[0]);
        // get row
        preg_match('/[0-9]*$/', $_cell, $_row);
        $_row = (int) $_row[0];
        
        if (isset($this->_data[$_row]) === false) {
            $this->_data[$_row] = array();
        }
        $this->_data[$_row][$_col] = $_value;
    }

    public function save() {
        if (file_exists($this->filename) === true) {
            throw new Exception('File Already Exists');
        }

        $_fout = null;
        if (! $_fout = fopen($this->filename, 'w')) {
            throw new Exception('Error when creating files');
        }

        list($_row, $_column) = $this->getDimension();

        foreach ($this->_data as $_entry) {
            fputcsv($_fout, $_entry);
        }

        fclose($_fout);
    }
}