<?php
/**
 * Created by PhpStorm.
 * User: Łukasz Malicki
 * Date: 2017-05-01
 * Time: 11:22 PM
 */

namespace Qweluke\CSVImporterBundle\Service;

use Qweluke\CSVImporterBundle\Exception\InvalidFileException;
use Symfony\Component\Stopwatch\Stopwatch;

class FileImporter
{

    /**
     * @var FileValidator
     */
    private $validator;


    public function __construct(FileValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Method binds values from imported CSV file with Mapped Entity fields
     *
     * @param array $importData
     * @param array $bindingSchema
     * @return array
     */
    public function prepareData(array $importData, array $bindingSchema)
    {
        $stopwatch = new Stopwatch();
        $stopwatch->start('parseData');

        /**
         * Contains information about user selected and mapped fields
         * @var $binded
         */
        $binded = [];

        foreach ($bindingSchema as $column) {

            /** check if column should be imported */
            if (!$column['checkbox'] || is_null($column['mappedChoice'])) {
                continue;
            }

            $binded[strtolower($column['column'])] = $column['mappedChoice'];
        }

        $bindedKeys = array_flip(array_keys($binded));


        $unImported = [];
        $toImport = [];
        foreach ($importData as $row) {

            try {
                $this->validator->validate($row);
            } catch (InvalidFileException $ex) {
                $unImported[] = $row;
                continue;
            }

            $row = array_change_key_case($row, CASE_LOWER);

            /** combine mapped fields with imported file */
            $toImport[] = array_intersect_key($row, $bindedKeys);
        }

        $event = $stopwatch->stop('parseData');

        return [
            'toImport' => $toImport,
            'failed' => $unImported,
            'duration' => $event->getDuration()
        ];
    }

    public function import(array $parsedData)
    {
        $stopwatch = new Stopwatch();
        $stopwatch->start('inserting');

        $event = $stopwatch->stop('inserting');

        return [
            'duration' => $event->getDuration()
        ];
    }
}