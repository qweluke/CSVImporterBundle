<?php
/**
 * Created by PhpStorm.
 * User: Łukasz Malicki
 * Date: 2017-05-01
 * Time: 11:22 PM
 */

namespace Qweluke\CSVImporterBundle\Service;

use Qweluke\CSVImporterBundle\Exception\InvalidFileException;

class FileValidator
{

    /**
     * @param mixed
     */
    private $requiredFields;

    /**
     * @param mixed
     */
    private $fieldsCount;

    public function __construct($requiredFields, $fieldsCount)
    {
        $this->requiredFields = $requiredFields;
        $this->fieldsCount = $fieldsCount;
    }


    /**
     * Checks if given array (parsed from CVS file) is valid
     *
     * @param array $csvData
     * @return bool
     * @throws InvalidFileException
     */
    public function validate(array $csvData)
    {

        /** throws an error if in invalid (missing required fields) */
        if (is_array($this->requiredFields) and !$this->in_array_all($this->requiredFields, array_keys($csvData))) {
            throw new InvalidFileException('Invalid file. Missing required fields.');
        }

        /** check if file have specified columns number */
        $colsNum = count($csvData);
        if (is_array($this->fieldsCount) and ($colsNum < $this->fieldsCount['min'] or $colsNum > $this->fieldsCount['max'])) {
            throw new InvalidFileException('File should have ' . $this->fieldsCount['min'] . '-' . $this->fieldsCount['max'] . ' columns. ' . $colsNum . ' given.');
        }

        /** if no cols number specified, check if file has at least 1 column */
        if(!is_array($this->fieldsCount) and $colsNum == 0) {
            throw new InvalidFileException('File should have at least 1 column');
        }

        $requredFieldsLower = array_map('strtolower', $this->requiredFields);;

        foreach ($csvData as $key => $column) {
            if( in_array(strtolower($key), $requredFieldsLower) && empty($column)) {
                throw new InvalidFileException('Invalid file. Required filed cannot be empty!');
            }

        }

        return true;
    }

//    TODO: handle mepty value
    private function in_array_all($needles, $haystack)
    {
        return !array_diff($needles, $haystack);
    }
}