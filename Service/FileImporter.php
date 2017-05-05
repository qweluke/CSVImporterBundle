<?php
/**
 * Created by PhpStorm.
 * User: Łukasz Malicki
 * Date: 2017-05-01
 * Time: 11:22 PM
 */

namespace Qweluke\CSVImporterBundle\Service;

use Doctrine\ORM\EntityManager;
use Qweluke\CSVImporterBundle\Exception\InvalidFileException;
use Symfony\Component\Stopwatch\Stopwatch;

class FileImporter
{

    const batchSize = 100;

    /**
     * @var FileValidator
     */
    private $validator;

    /**
     * @var EntityManager
     */
    private $em;

    /** user mapped import class */
    private $importEntity;


    /**
     * FileImporter constructor.
     * @param FileValidator $validator
     * @param EntityManager $manager
     * @param $entity
     */
    public function __construct(FileValidator $validator, EntityManager $manager, $entity)
    {
        $this->validator = $validator;
        $this->em = $manager;
        $this->importEntity = $entity;
    }

    /**
     * Method binds values from imported CSV file with Mapped Entity fields
     *
     * @param array $importData
     * @param array $bindingSchema
     * @return array
     */
    public function prepareData(array $importData, array $bindingSchema, array $entityColumns)
    {
        $stopwatch = new Stopwatch();
        $stopwatch->start('parseData');


        /**
         * get mysql column names. They can be different than entity fields ( _ separated)
         */
        $fieldNames = $this->em->getClassMetadata($this->importEntity)->getColumnNames();


        /** create assoc array to bind entityField <-> mysql column name */
        $ormTableColNames = [];
        foreach ($fieldNames as $field) {

            /** ex. givenName => given_name */
            $dataKey = lcfirst(str_replace('_', '', ucwords($field, '_')));
            $ormTableColNames[$dataKey] = $field;
        }

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

            $binded[$column['column']] = $column['mappedChoice'];
        }


        $importKeys = array_keys($importData[0]);


        $unImported = [];
        $toImport = [];
        foreach ($importData as $row) {

            /** validate each CSV row */
            try {
                $this->validator->validate($row);
            } catch (InvalidFileException $ex) {
                $unImported[] = $row;
                continue;
            }

            $importRow = [];

            /** map csv column with mysql column name */
            foreach ($binded as $colName => $colIndex) {

                /** CSV column key */
                $key = $importKeys[$colIndex];

                /** mysql column name */
                $colname = $ormTableColNames[$colName];

                /** create assoc array mysqlColName => csvColumnValue */
                $importRow[$colname] = htmlspecialchars($row[$key], ENT_QUOTES | ENT_SUBSTITUTE, 'utf-8');
            }

            $toImport[] = $importRow;
        }


        $event = $stopwatch->stop('parseData');

        return [
            'toImport' => $toImport,
            'failed' => $unImported,
            'duration' => $event->getDuration()
        ];
    }


    /**
     * Function for importing prepared data to the database
     *
     * @param array $parsedData
     * @return array
     */
    public function import(array $parsedData)
    {
        $stopwatch = new Stopwatch();
        $stopwatch->start('inserting');

        $tableName = $this->em->getClassMetadata($this->importEntity)->getTableName();


        $this->em->getConnection()->transactional(function ($connection) use ($parsedData, $tableName) {
            foreach ($parsedData['toImport'] as $row) {
                $connection->insert($tableName, $row);
            }
        });

        $event = $stopwatch->stop('inserting');

        return [
            'imported' => count($parsedData['toImport']),
            'failed' => $parsedData['failed'],
            'duration' => $event->getDuration()
        ];
    }

}